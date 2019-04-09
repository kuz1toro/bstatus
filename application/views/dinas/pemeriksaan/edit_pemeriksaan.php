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
                                //print_r($data_pemeriksaan);
                                //print_r ($testDate);
                                $attributes = array('id' => 'form_validation');
                                echo form_open('dinas/'.$contrl_url.'/'.$this->uri->segment(3).'', $attributes);
                            ?>
                            <div class="row clearfix">
                                <?php
                                    // no gedung, nama gedung
                                    echo '
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <label class="form-label font-12 font-normal col-grey">'.$thead[0].' </label> 
                                            <select class="form-control selectpicker" name="'.$dhead[0].'" data-live-search="true" required>
                                                ';
                                                foreach($list_gedung as $row)
                                                    {
                                                        echo '<option value="'.$row['no_gedung'].'"';
                                                        if($row['no_gedung']==$data_pemeriksaan[0][$dhead[0]])
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                        echo 'data-content="'.$row['no_gedung'].' || <span class=\'badge bg-blue-grey\'>'.$row['nama_gedung'].'</span>  || '.$row['alamat_gedung'].'"></option>';
                                                    }
                                    echo '
                                            </select>
                                        </div>
                                    </div>';
                                    // nama, alamat dan no telp pengelola
                                    for($i=1; $i<=3; $i++)
                                    {
                                        echo '
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" name="'.$dhead[$i].'" value="'.$data_pemeriksaan[0][$dhead[$i]].'" >
                                                    <label class="form-label">'.$thead[$i].'</label>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    // Jalur info, hasil pemeriksaan
                                    $list = array($list_jalurInfo, $list_hslPemeriksaan);
                                    $id = array('id_kolom_jalurInfo', 'id_kolom_hslPemeriksaan');
                                    $name = array('nama_kolom_jalurInfo', 'nama_kolom_hslPemeriksaan');
                                    $j = 0;
                                    for($i=4; $i<=5; $i++)
                                    {
                                        echo '
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[$i].' </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[$i].'"';
                                                if ($i==5) { echo 'id="hslPeriksa" required';} 
                                                echo '>';
                                                    foreach($list[$j] as $row)
                                                        {
                                                            echo '<option value="'.$row[$id[$j]].'"';
                                                            if($row[$id[$j]]==$data_pemeriksaan[0][$dhead[$i]])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                            echo '>'.$row[$name[$j]].'</option>';
                                                        }
                                        echo '
                                                </select>
                                            </div>
                                        </div>';
                                        $j++;
                                    }
                                    //status gedung
                                    echo '
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[6].' </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[6].'" id="statGdg" required >';
                                    echo '
                                                    <option value="'.$data_pemeriksaan[0][$dhead[6]].'">'.$data_pemeriksaan[0]['nama_kolom_statusGedung'].'</option>
                                                </select>
                                            </div>
                                        </div>';
                                    //catatan
                                    echo '
                                    <div class="col-sm-12 col-lg-9">
                                        <label class="form-label">'.$thead[7].'</label>
                                        <div class="form-group form-float">
                                            <div class="form-line ">
                                                <textarea rows="2" class="form-control no-resize" name="'.$dhead[7].'" id="ckeditor">
                                                '.$data_pemeriksaan[0][$dhead[7]].'
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>';
                                    //tanggal berlaku dan pokja
                                    echo '
                                        <div class="col-lg-3 col-sm-12">
                                                <div class="form-group form-float">
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[8].'</label>
                                                <div class="form-line " id="bs_datepicker_container">
                                                    <input type="text" class="form-control" name="'.$dhead[8].'" value="'.sqlDate2html($data_pemeriksaan[0][$dhead[8]]).'" required>
                                                </div>
                                            </div>
                                        </div>';
                                    echo '
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label font-12 font-normal col-grey">'.$thead[9].' </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[9].'">';
                                                    foreach($list_pokja as $row)
                                                        {
                                                            echo '<option value="'.$row['id_pokja'].'"';
                                                            if($row['id_pokja']==$data_pemeriksaan[0][$dhead[9]])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                            echo '>'.$row['nama_pokja'].'</option>';
                                                        }
                                    echo '
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="clearfix"></div>';

                                ?>
                                <div class="align-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'dinas/'.$cancel_url.'/'.$this->uri->segment(3).''; ?>" class="btn btn-primary waves-effect"><i class="material-icons">cancel</i><span>Cancel</span></a>
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

    
