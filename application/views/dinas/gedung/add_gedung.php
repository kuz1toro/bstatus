    <section class="content" >
		<div class="container-fluid">
            <div class="row clearfix">
                <!-- Content -->
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header; ?>
                            </h2>
                        </div>
                        <div class="body">
                            <?php
                                //form data
                                //print_r($tes);
                                //print_r ($testDate);
                                $attributes = array('id' => 'form_validation');
                                echo form_open('dinas/'.$contrl_url.'', $attributes);
                            ?>
                            <div class="row clearfix">
                                <?php
                                    // nama gedung, alamat
                                    for($i=0; $i<=1; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" name="'.$dhead[$i].'" required >
                                                    <label class="form-label">'.$thead[$i].'</label>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    // wilayah, kecamatan, kelurahan
                                    $id = array('Wilayah', 'kecamatan_dropdown', 'kelurahan_dropdown');
                                    $j = 0;
                                    for($i=2; $i<=4; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[$i].' </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[$i].'" id="'.$id[$j].'"';
                                                if ($i==2) { echo 'required';} 
                                                echo '>';
                                                if ($i==2){
                                                    echo '<option value="">Pilih Wilayah</option>';
                                                    foreach($list_wil as $row)
                                                    {
                                                        echo '<option value="'.$row['Wilayah'].'"';
                                                        echo '>'.$row['Wilayah'].'</option>';
                                                    }
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
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[5].'</label>
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" id="kodepos_dropdown" name="'.$dhead[5].'" readonly>
                                                </div>
                                            </div>
                                        </div>';
                                    //fungsi, kepemilikkan
                                    $table = array ($list_fungsi, $list_kepemilikkan);
                                    $id = array ('id_fungsi_gedung', 'id_kepemilikkan_gedung');
                                    $name = array ('fungsi_gedung', 'kepemilikkan_gedung');
                                    $j = 0;
                                    for($i=6; $i<=7; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group form-float">
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[$i].' </label> 
                                                <select class="form-control " name="'.$dhead[$i].'" required>';
                                                echo '<option value="">Pilih '.$thead[$i].'</option>';
                                                foreach($table[$j] as $row)
                                                {
                                                    echo '<option value="'.$row[$id[$j]].'"';
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
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[$i].'</label>
                                                <div class="form-line ">
                                                    <input type="number" class="form-control" name="'.$dhead[$i].'" >
                                                    
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
                                                <textarea rows="2" class="form-control no-resize" name="'.$dhead[12].'"></textarea>
                                                    <label class="form-label">'.$thead[12].'</label>
                                                </div>
                                            </div>
                                        </div>';
                                    //gmaps
                                    echo '<div class="col-sm-12 col-md-12"> <label class="form-label">Google Maps</label> </div>';
                                    for($i=13; $i<=14; $i++)
                                    {
                                        echo '
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" name="'.$dhead[$i].'" >
                                                    <label class="form-label">'.$thead[$i].'</label>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                ?>
                                <div class="align-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'dinas/'.$cancel_url.''; ?>" class="btn btn-primary waves-effect"><i class="material-icons">cancel</i><span>Cancel</span></a>
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

    
