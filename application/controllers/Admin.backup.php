<?php
class Admin extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('gedung_model');
        $this->load->library(array('ion_auth','form_validation'));
        $this->config->load('pagination', TRUE);
        $this->load->helper('site_helper');
        $this->load->helper('kint');
        ini_set('max_execution_time', 300);

        if ( ! $this->ion_auth->in_group('admin'))
        {
            redirect('auth/logout');
        }
    }

    public function import(){
        $path = 'xml/tes1.html';
        //$files = glob('xml/*.{html}', GLOB_BRACE);
        $imported_arr = $this->import_from_word($path);
        $key_val_arr = $imported_arr['key_val_array1'] ;
        $result_arr = $imported_arr['result_arr'] ;
        $result_ujicoba_arr = $imported_arr['result_ujicoba'] ;
        $main_result_arr = $this->main_data_imported($result_arr, $result_ujicoba_arr);

        //$data['data'] = $imported_arr['result_arr'];
        $data['data'] = $main_result_arr;
        $data['main_content'] = 'admin/import_from_msword';
        $this->load->view('admin/includes/template', $data);
    }

    public function save_imported()
    {
        $files = glob('xhtml/*.{xhtml}', GLOB_BRACE);
        $keys = array('nama bangunan', 'pengelola', 'alamat', 'klasifikasi bangunan', 'tinggi bangunan', 'luas bangunan', 'luas total', 'penggunaan bangunan', 'imb', 'sertifikat keselamatan kebakaran', 'klasifikasi sistem', 'tanggal', 'mkkg', 'sistem pipa tegak dan slang kebakaran', 'sistem springkler', 'sistem deteksi', 'komunikasi darurat', 'pencahayaan darurat', 'kipas penekan asap', 'lif kebakaran', 'kepala dinas');
        $save_log = array();
        foreach($files as $file) {
            $imported_arr = $this->import_from_word($file);
            $key_val_arr = $imported_arr['key_val_array1'] ;
            $result_arr = $imported_arr['result_arr'] ;
            $result_ujicoba_arr = $imported_arr['result_ujicoba'] ;
            $main_result_arr = $this->main_data_imported($result_arr, $result_ujicoba_arr);

            foreach ($keys as $key) {
                if (!isset($main_result_arr[$key])) {
                    $main_result_arr[$key] = '' ;
                }
            }
            
            $data_to_store = array(
                'nama_bangunan' => $main_result_arr['nama bangunan'],
                'pengelola' => $main_result_arr['pengelola'],
                'alamat' => $main_result_arr['alamat'],
                'klasif_bang' => $main_result_arr['klasifikasi bangunan'],
                'tinggi_bang' => $main_result_arr['tinggi bangunan'],
                'luas_bang' => $main_result_arr['luas bangunan'],
                'luas_total' => $main_result_arr['luas total'],
                'penggunaan' => $main_result_arr['penggunaan bangunan'],
                'no_imb' => $main_result_arr['imb'],
                'no_sertikat' => $main_result_arr['sertifikat keselamatan kebakaran'],
                'klasif_sistem' => $main_result_arr['klasifikasi sistem'],
                'tanggal' => $main_result_arr['tanggal'],
                'mkkg' => $main_result_arr['mkkg'],
                'sis_pipa_tegak' => $main_result_arr['sistem pipa tegak dan slang kebakaran'],
                'sis_springkler' => $main_result_arr['sistem springkler'],
                'sis_deteksi' => $main_result_arr['sistem deteksi'],
                'komunikasi' => $main_result_arr['komunikasi darurat'],
                'pencahayaan' => $main_result_arr['pencahayaan darurat'],
                'press_fan' => $main_result_arr['kipas penekan asap'],
                'lift_fire' => $main_result_arr['lif kebakaran'],
                'kadis' => $main_result_arr['kepala dinas'],

                'key_val_arr' => json_encode($key_val_arr),
                'result_arr' => json_encode($result_arr),
                'result_ujicoba_arr' => json_encode($result_ujicoba_arr)
            );
            if($this->admin_model->store_imported_data($data_to_store)){
                $message = $file.' => Sukses di simpan' ;
                array_push($save_log, $message);
            }else{
                $message = $file.' => Gagal di simpan' ;
                array_push($save_log, $message);
            }

        }

        $data['data'] = $save_log;
        $data['main_content'] = 'admin/import_from_msword';
        $this->load->view('admin/includes/template', $data);

    }

    public function import_from_word($path)
    {
        $xmlReader = new XMLReader();
        $xmlReader->open($path);
        $lap_ins = array();
        $ori = array();
        $ori1 = array();
        $i=0;
        $temp = 'kuswantoro';
        $temp2= 'dsdsadadwede';
        while($xmlReader->read()) {
            if($xmlReader->nodeType == XMLReader::ELEMENT) {
                if($xmlReader->localName == 'span') {
                    $xmlReader->read();
                    //delete spasi
                    $first = preg_replace('/\s+/u', ' ', $xmlReader->value);
                    $output = preg_replace('/^\W*/iu', '', $first);
                    //$output = preg_replace('/^\s+/u', '', $output);
                    $output = preg_replace('/\s*$/u', '', $output);
                    $output = preg_replace('/^\-+/u', '', $output);
                    $output = preg_replace('/[:;.(]$/u', '', $output);
                    $output = preg_replace('/\W{3,}$/u', '', $output);
                    $output = preg_replace('/^[a-z]{2}\.\w\.\w\W+|^[a-z]{3}\.\W*|^[a-z]{2}\.\W*|^\w\.(?!\d)|^\=\s/iu', '', $output);
                    $output = preg_replace('/^ii|^iii|^iv|^vi|^vii|^viii/iu', '', $output);
                    $output1 = preg_replace('/^\w\s+/iu', '', $output);
                    //filter empty element
                    $ori1[$i] =$output1;
                    if(!empty($output1) && !is_null($output1) && strlen($output1)>1 ){
                        //filter duplicate element
                        $comp1 = preg_replace('/\W/u', '', $output1);
                        $temp1 = preg_replace('/\W/u', '', $temp);
                        if (preg_match('/^\W*'.$temp1.'\s*\W*/iu', $comp1)){
                            if (strlen($comp1)==strlen($temp1)) {
                                $not_d = FALSE;
                            }
                        }else {
                            $not_d = TRUE;
                        }
                        if($not_d){
                            $lap_ins[$i]['span'] = $output1;
                            $temp = $output1;
                        }
                    }
                    if(!empty($first) && !is_null($first) && strlen($first)>1 ){
                        //filter duplicate element
                        $comp1 = preg_replace('/\W/u', '', $first);
                        $temp1 = preg_replace('/\W/u', '', $temp2);
                        if (stripos($comp1, $temp1) !== false) {
                            $not_d = FALSE;
                        }else {
                            $not_d = TRUE;
                        }
                        if($not_d){
                            $ori[$i] = $first;
                            $temp2 = $first;
                        }
                    }
                }
                $i++;
            }
        }
        //d($lap_ins);
        //!d($ori1);
        //console_log(count($lap_ins));
        //$val_array = $lap_ins;
        //remove key from val_array
        $myRegex = array( 'sambungan dinas pemadam kebakaran', 'data bangunan', 'nama bangunan', 'pengelola', 'klasifikasi bangunan', 'tinggi bangunan', 'luas bangunan', 'luas total', 'penggunaan bangunan', 'konstruksi bangunan', 'sistem pasokan daya listrik', 'sistem pasokan daya darurat', 'nomor imb', 'imb', 'ipb', 'rekomendasi dinas', 'kmb', 'slf', 'sertifikat keselamatan kebakaran', 'sistem proteksi kebakaran', 'sistem pipa tegak dan slang Kebakaran serta Hidran Kebakaran', 'sistem pipa tegak', 'data air', 'data pompa', 'operasi pompa', 'diameter perpipaan', 'hidran gedung', 'kopling pasukan dinas pemadam kebakaran', 'hidran halaman', 'sambungan dinas', 'siamesse connection', 'sistem springkler otomatis', 'klasifikasi sistem', 'diameter perpipaan', 'katup kendali utama', 'kepala springkler','flow switch & kran pengetesan' ,'sistem deteksi dan alarm kebakaran' ,'panel kontrol' ,'detektor' ,'detektor panas' , 'detektor asap', 'titik panggil' ,'komunikasi darurat' ,'alat pemadam api ringan' ,'sarana penyelamatan jiwa' ,'tangga kebakaran' ,'sistem pengendali asap' ,'kipas penekan asap' ,'kipas penghisap udara' ,'penunjuk arah darurat' ,'exit sign' ,'pencahayaan darurat' ,'lif kebakaran' ,'manajemen keselamatan kebakaran gedung' ,'akses pemadam kebakaran' ,'hasil uji coba' ,'sistem pipa tegak dan slang kebakaran' ,'sistem springkler' ,'sistem deteksi' ,'komunikasi darurat' ,'pencahayaan darurat' ,'kipas penekan asap' ,'lif kebakaran' ,'catatan' ,'kepala dinas');
        $sub_regex = array('kerangka', 'dinding', 'atap', 'sumber air', 'volume reservoir', 'merk\/tipe', 'kapasitas', 'total head', 'penggerak', 'sistem pengisapan', 'penempatan', 'tekanan statis', 'stand by tekanan', 'hidup', 'mati', 'pipa hisap', 'pipa penyalur', 'pipa tegak', 'jumlah titik', 'ketahanan api', 'diameter keluaran', 'pompa pacu', 'pompa utama', 'pompa cadangan', 'kelengkapan', 'jarak antar titik', 'temperatur kerja', 'jenis kopling', 'diameter masukan', 'pipa pembagi', 'pipa cabang', 'diameter', 'sistem hisap', 'volume ruangan', 'temperatur', 'jarak antar', 'tekanan', 'daya listrik', 'warna', 'sumber daya', 'jumlah akses', 'lebar akses', 'jumlah zone', 'jumlah nozzle', 'muara tangga', 'tinggi anak tangga', 'lebar anak tangga', 'tinggi railing', 'ukuran tangga', 'pintu tangga', 'penerangan tangga', 'kondisi tangga', 'area perkerasan', 'tinggi', 'lebar jalan', 'stand by', 'radius putaran', 'perkerasan', 'kopling', 'jarak', 'putaran', 'Merk \/ Type', 'merk\/ tipe', 'merk \/tipe', 'merk \/ tipe', 'main control valve', 'saklar aliran air', 'flow switch', 'merk', 'lebar', 'head', 'jumlah', 'start', 'stop', 'volume', 'ukuran', 'pintu', 'penerangan', 'kondisi', 'penggunaan', 'genset');
        $allRegex = array_merge($myRegex, $sub_regex);
        $val_array = array();
        $key_val_array = array();
        $k = 1;
        foreach($lap_ins as $row){
            foreach($myRegex as $row1){
                $val_array [$k]= $row['span'];
                $key_val_array [$k]= $row['span'];
                if (preg_match('/^\W*'.$row1.'\s*\W*/iu', $row['span'])){
                    $val_array [$k]= preg_replace( '/^\W*'.$row1.'\s*\W*/iu' , '', $row['span']);
                    break;
                }
                                
            }
            $k++;
        }
        //save nama jalan
        $val_array1 = array();
        $key_val_array1 = array();
        $j=1;
        for ($i=1; $i <=count($key_val_array) ; $i++) {
            if (array_key_exists($j, $key_val_array)) {
                if (preg_match('/^\W*jln\s*|^\W*jalan\s*/iu', $key_val_array[$j])){
                    $nama_jln = $key_val_array[$j];
                    $j++;
                        //unset($key_val_array[$i]);
                        //unset($val_array[$i]);
                        //break;
                }
                if (preg_match('/^\W*Landing Valve\s*/iu', $key_val_array[$j])){
                    $j++;
                }
                if (preg_match('/(2012|2013|2014|2015|2016|2017)\W*$/iu', $key_val_array[$j])){
                    $tanggal = $key_val_array[$j];
                    $j++;
                }
                $val_array1 [$i]= $val_array[$j];
                $key_val_array1 [$i]= $key_val_array[$j];
            }
            $j++;
        }
        //echo '<br><br>';
        //print_r($key_val_array);
        //echo count($val_array);
        //echo $nama_jln;
        //echo $tanggal;

        // build array
        $result_arr = array();
        $key = 0;
        $result_arr = array($key =>array());
        $trash_arr = array();
        $jml_regexs = count($myRegex);
        $jml_subregexs = count($sub_regex);
        $a = 1;
        for ($i=1; $i <=count($key_val_array1) ; $i++) {
            $key_val = $key_val_array1[$i];
            $val = $val_array1[$i];
            $tambah = TRUE;
            //echo "loop $i,";
            for ($j=0; $j <= $jml_regexs ; $j++){
                if (array_key_exists($j, $myRegex)) {
                    //echo "array_key_exists,";
                    //$current_regex = current($myRegex);
                    if (preg_match('/^\W*'.$myRegex[$j].'\s*\W*/iu', $key_val)) {
                        //$next_regex = next($myRegex);
                        $key = $myRegex[$j];
                        $key1 = $myRegex[$j].'.1';
                        $key2 = $myRegex[$j].'.2';
                        $key3 = $myRegex[$j].'.3';
                        if (array_key_exists($key2, $result_arr)) {
                            $key = $key3;
                            $result_arr[$key] = array();
                        }else if (array_key_exists($key1, $result_arr)) {
                            $key = $key2;
                            $result_arr[$key] = array();
                        }else if (array_key_exists($myRegex[$j], $result_arr)) {
                            $key = $myRegex[$j].'.1';
                            $result_arr[$key] = array();
                        }else{
                            $result_arr[$key] = array();
                        }
                        unset($myRegex[$j]);
                        if (strlen($val)>1) {
                            //echo 'strlen,';
                            $tambah1 = TRUE;
                            for ($k=0; $k <= $jml_subregexs ; $k++){
                                if (array_key_exists($k, $sub_regex)) {
                                    if (preg_match('/^\W*'.$sub_regex[$k].'\s*\W*/iu', $val)) {
                                        $sub_key = $sub_regex[$k];
                                        $sub_key1 = $sub_key.'.1';
                                        $sub_key2 = $sub_key.'.2';
                                        $sub_key3 = $sub_key.'.3';
                                        if( array_key_exists($sub_key2, $result_arr[$key]) ){
                                            $result_arr[$key][$sub_key3] = $val;
                                        }else if( array_key_exists($sub_key1, $result_arr[$key]) ){
                                            $result_arr[$key][$sub_key2] = $val;
                                        }else if (array_key_exists($sub_key, $result_arr[$key])) {
                                            $result_arr[$key][$sub_key.'.1'] = $val;
                                        }else{
                                            $result_arr[$key][$sub_key] = $val;
                                        }
                                        $tambah1 = FALSE;
                                        break;
                                    }
                                }
                            }
                            if ($tambah1) {
                                array_push($result_arr[$key], $val);
                            }
                            $tambah = FALSE;
                            break;
                        }
                        break;
                    }
                }
                //echo "for loop,";
            }
            if ($tambah) {
                for ($k=0; $k <= $jml_subregexs ; $k++){
                    if (array_key_exists($k, $sub_regex)) {
                        if (preg_match('/^\W*'.$sub_regex[$k].'\s*\W*/iu', $key_val)) {
                            $sub_key = $sub_regex[$k];
                            $sub_key1 = $sub_key.'.1';
                            $sub_key2 = $sub_key.'.2';
                            $sub_key3 = $sub_key.'.3';
                            if( array_key_exists($sub_key2, $result_arr[$key]) ){
                                $result_arr[$key][$sub_key3] = $val;
                            }else if( array_key_exists($sub_key1, $result_arr[$key]) ){
                                $result_arr[$key][$sub_key2] = $val;
                            }else if (array_key_exists($sub_key, $result_arr[$key])) {
                                $result_arr[$key][$sub_key.'.1'] = $val;
                            }else{
                                $result_arr[$key][$sub_key] = $val;
                            }
                            $tambah = FALSE;
                            break;
                        }
                    }
                }
            }
            if ($tambah) {
                if (strlen($val)>1) {
                        array_push($result_arr[$key], $val);
                }
            }else{
                $trash_arr[$i] = $key_val;
            }
        }
        if (isset($nama_jln)){
            $result_arr['nama jalan'][0] = $nama_jln;
            //echo $nama_jln;
        }
        if (isset($tanggal)){
            $result_arr['tanggal'][0] = $tanggal;
            //echo $tanggal;
        }
        //save hasil uji coba
        $ujicoba_regex = array('hasil uji coba' ,'sistem pipa tegak dan slang kebakaran' ,'sistem springkler' ,'sistem deteksi' ,'komunikasi darurat' ,'pencahayaan darurat' ,'kipas penekan asap' ,'lif kebakaran' ,'catatan' ,'kepala dinas', 'sistem pipa tegak');
        $jml_ujicoba_regex = count($ujicoba_regex);
        $result_ujicoba = array();
        $key = 0;
        $result_ujicoba[$key]='';
        $loop_on = FALSE;
        for ($i=1; $i <=count($key_val_array1) ; $i++) {
            $key_val = $key_val_array1[$i];
            $val = $val_array1[$i];
            $tambah = TRUE;
            //echo "loop $i,";
            if (preg_match('/^\W*hasil uji coba\s*\W*/iu', $key_val) || $loop_on) {
                $loop_on = TRUE;
                for ($j=0; $j <= $jml_ujicoba_regex ; $j++){
                    if (array_key_exists($j, $ujicoba_regex)) {
                        if (preg_match('/^\W*'.$ujicoba_regex[$j].'\s*\W*/iu', $key_val)) {
                            $key = $ujicoba_regex[$j];
                            $result_ujicoba[$key] = '';
                            unset($ujicoba_regex[$j]);
                            $tambah = FALSE;
                            break;
                        }
                    }
                }
                if ($tambah) {
                    $result_ujicoba[$key] = $result_ujicoba[$key].' '.$val;
                }
            }
        }
        $return_arr['key_val_array1'] = $key_val_array1;
        $return_arr['result_arr'] = $result_arr;
        $return_arr['result_ujicoba'] = $result_ujicoba;
        return $return_arr ;
        
    }

    public function main_data_imported($result_arr, $result_ujicoba)
    {
        // data utama
        $main_result = array();
        $main_result['nama bangunan'] = '';
        $main_result['pengelola'] = '';
        $main_result['mkkg'] = '';
        if (isset($result_arr['nama bangunan'][0])) {
            for ($i=0; $i < (count($result_arr['nama bangunan'])-1) ; $i++) { 
                if ($i==0) {
                    $main_result['nama bangunan'] .= $result_arr['nama bangunan'][$i] ;
                }else if(isset($result_arr['nama bangunan'][$i])) {
                    $main_result['nama bangunan'] = $main_result['nama bangunan'].' '.$result_arr['nama bangunan'][$i] ;
                }
            }
            if(isset($result_arr['nama bangunan'][count($result_arr['nama bangunan'])-1])) {
                $main_result['alamat'] = $result_arr['nama bangunan'][count($result_arr['nama bangunan'])-1] ;
            }
        }
        if (isset($result_arr['pengelola'][0])) {
            for ($i=0; $i < count($result_arr['pengelola']) ; $i++) { 
                if ($i==0) {
                    $main_result['pengelola'] .= $result_arr['pengelola'][$i] ;
                }else if(isset($result_arr['pengelola'][$i])) {
                    $main_result['pengelola'] = $main_result['pengelola'].' '.$result_arr['pengelola'][$i] ;
                }
            }
        }
        if (isset($result_arr['klasifikasi bangunan'][0])) {
            $main_result['klasifikasi bangunan'] = $result_arr['klasifikasi bangunan'][0] ;
        }
        if (isset($result_arr['tinggi bangunan'][0])) {
            if (preg_match('/\d+/iu', $result_arr['tinggi bangunan'][0])) {
                $main_result['tinggi bangunan'] = $result_arr['tinggi bangunan'][0] ;
            }else{
                $main_result['tinggi bangunan'] = '';
            }
        }
        if (isset($result_arr['luas bangunan'][0])) {
            if (preg_match('/\d+/iu', $result_arr['luas bangunan'][0])) {
                $main_result['luas bangunan'] = $result_arr['luas bangunan'][0] ;
            }else{
                $main_result['luas bangunan'] = '';
            }
        }
        if (isset($result_arr['luas total'][0])) {
            if (preg_match('/\d+/iu', $result_arr['luas total'][0])) {
                $main_result['luas total'] = $result_arr['luas total'][0] ;
            }else{
                $main_result['luas total'] = '';
            }
        }
        if (isset($result_arr['penggunaan bangunan'][0])) {
            $main_result['penggunaan bangunan'] = $result_arr['penggunaan bangunan'][0] ;
        }else{
            $main_result['penggunaan bangunan'] = '';
        }
        if (isset($result_arr['imb'][0])) {
            $main_result['imb'] = $result_arr['imb'][0] ;
        }else{
            $main_result['imb'] = '';
        }
        if (isset($result_arr['sertifikat keselamatan kebakaran'][0])) {
            $main_result['sertifikat keselamatan kebakaran'] = $result_arr['sertifikat keselamatan kebakaran'][0] ;
        }else{
            $main_result['sertifikat keselamatan kebakaran'] = '';
        }
        if (isset($result_arr['klasifikasi sistem'])) {
            if (count($result_arr['klasifikasi sistem']) > 1) {
                $main_result['klasifikasi sistem'] = $result_arr['klasifikasi sistem'][0].' '.$result_arr['klasifikasi sistem'][1] ;
            }else{
                $main_result['klasifikasi sistem'] = $result_arr['klasifikasi sistem'][0] ;
            }
            
        }else{
            $main_result['klasifikasi sistem'] = '';
        }
        if (isset($result_arr['manajemen keselamatan kebakaran gedung'][0])) {
            for ($i=0; $i < count($result_arr['manajemen keselamatan kebakaran gedung']) ; $i++) { 
                if ($i==0) {
                    $main_result['mkkg'] .= $result_arr['manajemen keselamatan kebakaran gedung'][$i] ;
                }else if(isset($result_arr['manajemen keselamatan kebakaran gedung'][$i])) {
                    $main_result['mkkg'] = $main_result['mkkg'].' '.$result_arr['manajemen keselamatan kebakaran gedung'][$i] ;
                }
            }
        }
        if (isset($result_arr['tanggal'][0])) {
            $main_result['tanggal'] = $result_arr['tanggal'][0];
        }else{
            $main_result['tanggal'] = '';
        }
        if (isset($result_ujicoba['catatan'])) {
            if (preg_match('/belum dapat|tidak dapat/iu', $result_ujicoba['catatan'])){
                $main_result['kesimpulan'] = 'Belum dapat diberikan Sertifikat Keselamatan Kebakaran';
            }else{
                $main_result['kesimpulan'] = 'Dapat diberikan Sertifikat Keselamatan Kebakaran';
            }
        }
        //merge result
        $main_result = array_merge($main_result, $result_ujicoba);
        return $main_result;
    }

    

}