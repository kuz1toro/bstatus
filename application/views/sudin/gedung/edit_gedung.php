    <section class="content" >
		<div class="container-fluid">
            <div class="row clearfix">
                <!-- Content -->
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="breadcrumb breadcrumb-bg-red">
                                <li><a href="<?php echo base_url();?>"><i class="material-icons">home</i> Home</a></li>
                                <li><a href="<?php echo base_url().'dinas/list_gedung';?>"><i class="material-icons">business</i> Data Gedung</a></li>
                                <li><a href="<?php echo base_url().'dinas/read_gedung/'.$this->uri->segment(3);?>"><i class="material-icons">format_align_justify</i> Read Gedung</a></li>
                                <li class="active"><i class="material-icons">mode_edit</i> <?php echo $header;  ?></li>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                                //form data
                                //print_r($data_gedung);
                                //print_r ($testDate);
                                $attributes = array('id' => 'form_validation');
                                echo form_open('dinas/'.$contrl_url.'/'.$this->uri->segment(3).'', $attributes);
                            ?>
                            <div class="row clearfix">
                                <?php
                                    //input no_gedung (hidden)
                                    echo '<input type="hidden" name="'.$dhead[15].'" value="'.$data_gedung[0][$dhead[15]].'"  >';
                                    // nama gedung, alamat
                                    for($i=0; $i<=1; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" name="'.$dhead[$i].'" value="'.$data_gedung[0][$dhead[$i]].'" required >
                                                    <label class="form-label"><span class = "font-bold">'.$thead[$i].'</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    // wilayah, kecamatan, kelurahan
                                    $id = array('Wilayah', 'kecamatan_dropdown', 'kelurahan_dropdown');
                                    $keckel = array('idWil','id_kecamatan', 'id_kelurahan');
                                    $j = 0;
                                    for($i=2; $i<=4; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label font-12"><p class = "font-bold">'.$thead[$i].'</p> </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[$i].'" id="'.$id[$j].'"';
                                                if ($i==2) { echo 'required';} 
                                                echo '>';
                                                if ($i==2){
                                                    echo '<option value="">No Data</option>';
                                                    foreach($list_wil as $row)
                                                    {
                                                        echo '<option value="'.$row['id'].'"';
                                                        if($row['Wilayah']==$data_gedung[0][$dhead[$i]])
                                                        { echo 'selected';}
                                                        echo '>'.$row['Wilayah'].'</option>';
                                                    }
                                                }else{
                                                    echo '<option value="'.$data_gedung[0][$keckel[$j]].'" selected >'.$data_gedung[0][$dhead[$i]].'</option>';
                                                }
                                        echo '
                                                </select>
                                            </div>
                                        </div>';
                                        $j++;
                                        if ($i==3) { echo ' <div class="clearfix"></div>';}
                                    }
                                    // kodepos
                                    echo '
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><p class = "font-bold">'.$thead[5].'</p></label>
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" id="kodepos_dropdown" name="'.$dhead[5].'" value="'.$data_gedung[0][$dhead[5]].'" readonly>
                                                </div>
                                            </div>
                                        </div>';
                                    //fungsi, kepemilikkan
                                    $table = array ($list_fungsi, $list_kepemilikkan);
                                    $id = array ('id_fungsi_gedung', 'id_kepemilikkan_gedung');
                                    $gdg = array ('fungsi', 'kepemilikan');
                                    $name = array ('fungsi_gedung', 'kepemilikkan_gedung');
                                    $j = 0;
                                    for($i=6; $i<=7; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group form-float">
                                                <label class="form-label "><p class = "font-bold">'.$thead[$i].' </p></label> 
                                                <select class="form-control " name="'.$dhead[$i].'" required>';
                                                //echo '<option value="">Pilih '.$thead[$i].'</option>';
                                                foreach($table[$j] as $row)
                                                {
                                                    echo '<option value="'.$row[$id[$j]].'"';
                                                    if($row[$id[$j]]==$data_gedung[0][$gdg[$j]])
                                                    { echo 'selected';}
                                                    echo '>'.$row[$name[$j]].'</option>';
                                                }
                                            echo '</select>
                                            </div>
                                        </div>';
                                        $j++;
                                    }
                                    //jumlah tower, jumlah lantai, jumlah basement, ketinggian
                                    
                                    for($i=8; $i<=11; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group form-float">
                                                <label class="form-label "><p class = "font-bold">'.$thead[$i].'</p></label>
                                                <div class="form-line ">
                                                    <input type="number" class="form-control" name="'.$dhead[$i].'" value="'.$data_gedung[0][$dhead[$i]].'">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    // Catatan
                                    echo '
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group form-float">
                                                <div class="form-line ">
                                                <textarea rows="2" class="form-control no-resize" name="'.$dhead[12].'">'.$data_gedung[0][$dhead[12]].'</textarea>
                                                    <label class="form-label"><p class = "font-bold">'.$thead[12].'</p></label>
                                                </div>
                                            </div>
                                        </div>';
                                    //gmaps
                                    echo '<div class="col-sm-12 col-md-12"> <label class="form-label"><p class = "font-bold">Google Maps</p></label> </div>';
                                    for($i=13; $i<=14; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" name="'.$dhead[$i].'" value="'.$data_gedung[0][$dhead[$i]].'" >
                                                    <label class="form-label"><p class = "font-bold">'.$thead[$i].'</p></label>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                ?>
                                <div class="align-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'dinas/read_gedung/'.$data_gedung[0]['id_gdg_dinas'].''; ?>" class="btn btn-primary waves-effect"><i class="material-icons">cancel</i><span>Cancel</span></a>
                                    <button type="reset" class="btn bg-green waves-effect" id="btnReset">
                                        <i class="material-icons">undo</i>
                                        <span>Reset</span>
                                    </button>
                                    <button type="submit" class="btn bg-orange waves-effect">
                                        <i class="material-icons">save</i>
                                        <span>Simpan</span>
                                    </button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                 <!-- #END# Content -->
            </div>
        </div>
    </section>

    
