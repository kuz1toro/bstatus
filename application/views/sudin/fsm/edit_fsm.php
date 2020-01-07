    <section class="content" >
		<div class="container-fluid">
            <div class="row clearfix">
                <!-- Content -->
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="breadcrumb breadcrumb-bg-red">
                                <li><a href="<?php echo base_url();?>"><i class="material-icons">home</i> Home</a></li>
                                <li><a href="<?php echo base_url().'dinas/list_fsm';?>"><i class="material-icons">pages</i> Data FSM</a></li>
                                <li class="active"><i class="material-icons">queue</i> <?php echo $header;  ?></li>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                                //form data
                                $attributes = array('id' => 'form_validation');
                                echo form_open('dinas/'.$contrl_url.'/'.$this->uri->segment(3).'', $attributes);
                            ?>
                            <div class="row clearfix">
                                <?php 
                                    $count = 0;
                                    foreach($dhead as $col)
                                    {
                                        echo
                                        '<div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">'.$thead[$count].'</label>
                                                <div class="form-line"';
                                                if ($col == 'tgl_sert_berlaku' || $col == 'tgl_sert_expired') {echo 'id="bs_datepicker_container"';}
                                                echo '>';
                                                    if($col == 'tgl_sert_berlaku' || $col == 'tgl_sert_expired'){
                                                        echo '<input type="text" class="form-control" name="'.$col.'" value="'.sqlDate2html($data[$col]).'"';
                                                    }else{
                                                        echo '<input type="text" class="form-control" name="'.$col.'" value="'.$data[$col].'"';
                                                    }
                                        if ($count == 0 || $count == 3) {echo 'required';}
                                       
                                        echo '>
                                                    
                                                </div>
                                            </div>
                                        </div>';
                                        $count++;
                                    }
                                
                                ?>
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

    
