﻿    <section class="content" >
		<div class="container-fluid">
            <div class="row clearfix">
                <!-- Content -->
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="breadcrumb breadcrumb-bg-red">
                                <li><a href="<?php echo base_url();?>"><i class="material-icons">home</i> Home</a></li>
                                <li><a href="<?php echo base_url().'dinas/list_pemeriksaan';?>"><i class="material-icons">assessment</i> Data Pemeriksaan</a></li>
                                <li><a href="<?php echo base_url().'dinas/read_pemeriksaan/'.$this->uri->segment(3);?>"><i class="material-icons">format_align_justify</i> Read Pemeriksaan</a></li>
                                <li class="active"><i class="material-icons">mode_edit</i> <?php echo $header;  ?></li>
                            </div>
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
                                            <label class="form-label "><span class = "font-bold">'.$thead[0].' </span></label> 
                                            <select class="form-control selectpicker" name="'.$dhead[0].'" data-live-search="true" required>
                                            <option value="">No Data</option>';
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
                                    // No Permh, tgl permh dan fsm
                                    for($i=1; $i<=3; $i++)
                                    {
                                        echo '
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label "><span class = "font-bold">'.$thead[$i].'</span></label>';
                                                if($i==2){
                                                    echo '
                                                    <div class="form-line" id="bs_datepicker_container">
                                                        <input type="text" class="form-control" name="'.$dhead[$i].'" value="'.sqlDate2html($data_pemeriksaan[0][$dhead[$i]]).'">
                                                    </div>';
                                                }elseif($i==3){
                                                    echo '<select class="form-control selectpicker" name="'.$dhead[$i].'" data-live-search="true">
                                                        <option value="">No Data</option>';
                                                    foreach($list_fsm as $row)
                                                    {
                                                        echo '<option value="'.$row['id_FSM'].'"';
                                                        if($row['id_FSM']==$data_pemeriksaan[0][$dhead[$i]])
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                        echo '>'.$row['nama_FSM'].'</option>';
                                                    }
                                                    echo ' </select>';
                                                }else{
                                                    echo '
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="'.$dhead[$i].'" value="'.$data_pemeriksaan[0][$dhead[$i]].'">
                                                    </div>';
                                                }
                                        echo '    
                                            </div>
                                        </div>
                                        '; 
                                    }
                                    echo '<div class="clearfix"></div>';
                                    // nama, alamat dan no telp pengelola
                                    for($i=4; $i<=6; $i++)
                                    {
                                        echo '
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line ">
                                                    <input type="text" class="form-control" name="'.$dhead[$i].'" value="'.$data_pemeriksaan[0][$dhead[$i]].'" >
                                                    <label class="form-label"><span class = "font-bold">'.$thead[$i].'</span></label>
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
                                    for($i=7; $i<=8; $i++)
                                    {
                                        echo '
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label "><span class = "font-bold">'.$thead[$i].'</span> </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[$i].'"';
                                                if ($i==8) { echo 'id="hslPeriksa" required';} 
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
                                                <label class="form-label "><span class = "font-bold">'.$thead[9].'</span> </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[9].'" id="statGdg" required >';
                                    echo '
                                                    <option value="'.$data_pemeriksaan[0][$dhead[9]].'">'.$data_pemeriksaan[0]['nama_kolom_statusGedung'].'</option>
                                                </select>
                                            </div>
                                        </div>';
                                    //catatan
                                    echo '
                                    <div class="col-sm-12 col-lg-9">
                                        <label class="form-label"><span class = "font-bold">'.$thead[10].'</span></label>
                                        <div class="form-group form-float">
                                            <div class="form-line ">
                                                <textarea rows="2" class="form-control no-resize" name="'.$dhead[10].'" id="ckeditor">
                                                '.$data_pemeriksaan[0][$dhead[10]].'
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
                                                <label class="form-label "><span class = "font-bold">'.$thead[11].'</span></label>
                                                <div class="form-line " id="bs_datepicker_container">
                                                    <input type="text" class="form-control" name="'.$dhead[11].'" value="'.sqlDate2html($data_pemeriksaan[0][$dhead[11]]).'" required>
                                                </div>
                                            </div>
                                        </div>';
                                    echo '
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label "><span class = "font-bold">'.$thead[12].'</span> </label> 
                                                <select class="form-control selectpicker" name="'.$dhead[12].'">
                                                <option value="">No Data</option>';
                                                    foreach($list_pokja as $row)
                                                        {
                                                            echo '<option value="'.$row['id_pokja'].'"';
                                                            if($row['id_pokja']==$data_pemeriksaan[0][$dhead[12]])
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

    
