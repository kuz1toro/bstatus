    <section class="content" >
		<div class="container-fluid">
            <div class="row clearfix">
                <!-- Content -->
                <div class="col-lg-6 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header; ?>
                            </h2>
                        </div>
                        <div class="body">
                        <?php
                            //form data
                            $attributes = array('id' => 'form_validation');
                            echo form_open('dinas/'.$contrl_url.'/'.$this->uri->segment(3).'', $attributes);
                        ?>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="<?php echo $dhead[0]; ?>" value= "<?php if(!empty($data_jalurInfo)){echo $data_jalurInfo[$dhead[0]];} ?>" required>
                                            <label class="form-label"><?php echo $thead[0]; ?> </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="<?php echo $dhead[1]; ?>" value= "<?php if(!empty($data_jalurInfo)){echo $data_jalurInfo[$dhead[1]];} ?>" >
                                            <label class="form-label"><?php echo $thead[1]; ?> </label>
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

    
