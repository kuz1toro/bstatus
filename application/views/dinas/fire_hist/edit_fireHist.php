    <section class="content" >
		<div class="container-fluid">
            <div class="row clearfix">
                <!-- Content -->
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="breadcrumb breadcrumb-bg-red">
                                <li><a href="<?php echo base_url();?>"><i class="material-icons">home</i> Home</a></li>
                                <li><a href="<?php echo base_url().'dinas/list_fireHist';?>"><i class="material-icons">history</i> Data Riwayat Kebakaran</a></li>
                                <li class="active"><i class="material-icons">mode_edit</i> <?php echo $header;  ?></li>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                                //form data
                                //print_r($dhead);
                                //print_r ($testDate);
                                $attributes = array('id' => 'form_validation');
                                echo form_open('dinas/'.$contrl_url.'/'.$this->uri->segment(3).'', $attributes);
                            ?>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label class="form-label "><span class = "font-bold"><?php echo $thead[0]; ?></span></label> 
                                        <select class="form-control show-tick" name="<?php echo $dhead[0]; ?>" data-live-search="true" required>
                                            <?php 
                                                foreach($list_gedung as $row)
                                                {
                                                    echo '<option value="'.$row['no_gedung'].'"';
                                                    if($row['no_gedung']==$data[$dhead[0]]){echo 'selected';}
                                                    echo '>'.$row['nama_gedung'].'</option>';
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12"> <!-- tgl kejadian -->
                                    <div class="form-group form-float">
                                        <div class="form-line " id="bs_datepicker_container">
                                            <input type="text" class="form-control" name="<?php echo $dhead[1]; ?>" value="<?php echo sqlDate2html($data[$dhead[1]]); ?>" placeholder="<?php echo $thead[1]; ?>" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12"> <!-- waktu kejadian -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="timepicker form-control" name="<?php echo $dhead[2]; ?>" value="<?php echo $data[$dhead[2]]; ?>" placeholder="<?php echo $thead[2]; ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label class="form-label "><span class = "font-bold"><?php echo $thead[3]; ?></span></label> 
                                        <select class="form-control show-tick" name="<?php echo $dhead[3]; ?>" required>
                                            <option value="">Silahkan Pilih Penyebab Kebakaran</option>
                                            <?php 
                                                foreach($list_penyebab as $row)
                                                {
                                                    echo '<option value="'.$row['id_penyebabFire'].'"';
                                                    if($row['id_penyebabFire']==$data[$dhead[3]]){echo 'selected';}
                                                    echo '>'.$row['penyebab'].'</option>';
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="<?php echo $dhead[4]; ?>" value="<?php echo $data[$dhead[4]]; ?>">
                                            <label class="form-label"><span class = "font-bold"><?php echo $thead[4]; ?></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="<?php echo $dhead[5]; ?>" ><?php echo $data[$dhead[5]]; ?></textarea>
                                            <label class="form-label"><span class = "font-bold"><?php echo $thead[5]; ?></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    
