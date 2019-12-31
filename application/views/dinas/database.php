    <section class="content">
        <div class="container-fluid" >
            <div class="row clearfix">
                <!-- Line Chart -->
                
<?php
// Inintialize URL to the variable 
$url = 'https://www.google.co.id/maps/place/Pesakih/@-6.1545287,106.7153888,15z/data=!4m2!3m1!1s0x0:0x9f98afbcf2f5ea4b?hl=en&sa=X&ved=0ahUKEwjO4KzqiabVAhXLq48KHQPSDqUQ_BIIjgEwCg'; 
      
// Use parse_url() function to parse the URL  
// and return an associative array which 
// contains its various components 
//$url_components = file_get_contents($url, true); 
//print_r($test);

preg_match('/@(-?[\d]*\.[\d]*),(-?[\d]*\.[\d]*),/', $url, $latitude, PREG_OFFSET_CAPTURE);
d($latitude);

?>
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Migrasi Database <small><?php echo $message; ?></small>
                            </h2>
                        </div>
                        <div class="body">
                            <a href="jalurInfo_operation" type="button" class="btn bg-red waves-effect">jalur info</a>
                            <a href="hasilPemeriksaan_operation" type="button" class="btn bg-red waves-effect">hasil pemeriksaan</a>
                            <a href="statusGedung_operation" type="button" class="btn bg-red waves-effect">status gedung</a>
                            <a type="button" class="btn bg-red waves-effect">next status</a>
                            <a href="tglBerlakuExpired_operation" type="button" class="btn bg-red waves-effect">tgl berlaku & expired</a>
                            <a href="fungsiGedung_operation" type="button" class="btn bg-red waves-effect">Fungsi Gedung</a>
                            <a href="kepemilikkan_operation" type="button" class="btn bg-red waves-effect">Kepemilikkan Gedung</a>
                            <a href="bagi" type="button" class="btn bg-red waves-effect">bagi Gedung</a>
                            <a href="rubahKodeStatusGdg_operation" type="button" class="btn bg-red waves-effect">rubah kode status</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
