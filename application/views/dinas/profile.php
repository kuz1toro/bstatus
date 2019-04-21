<section class="content">
<?php
    //Modal alert
    pesanModal();
    //print_r($data_pemeriksaan);
    //flash messages
    if($this->session->flashdata('flash_message')=='passwordUpdated'){
        echo'<script>
        window.onload = function(){
            $("#passwordUpdated").modal();
        };
        </script>';
        $this->session->set_flashdata('flash_message', '');
    }
    elseif ($this->session->flashdata('flash_message')=='oldpassword')
    {
        echo'<script>
        window.onload = function(){
            $("#oldpassword").modal();
        };
        </script>';
        $this->session->set_flashdata('flash_message', '');
    }
    elseif ($this->session->flashdata('flash_message')=='newpassword')
    {
        echo'<script>
        window.onload = function(){
            $("#newpassword").modal();
        };
        </script>';
        $this->session->set_flashdata('flash_message', '');
    }
    elseif ($this->session->flashdata('flash_message')=='newpasswordLengh')
    {
        echo'<script>
        window.onload = function(){
            $("#newpasswordLengh").modal();
        };
        </script>';
        $this->session->set_flashdata('flash_message', '');
    }
    elseif ($this->session->flashdata('flash_message')=='not_updated')
    {
        echo'<script>
        window.onload = function(){
            $("#not_updated").modal();
        };
        </script>';
        $this->session->set_flashdata('flash_message', '');
    }
    else if(validation_errors() || $this->session->flashdata('flash_message')=='failed')
    { echo'<script>
        window.onload = function(){
            $("#gagal").modal();
        };
        </script>';
    } 
?>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <img src="<?php echo base_url(); ?>upload/damkar.png" alt="AdminBSB - Profile Image" width="220" height="220"/>
                        </div>
                        <div class="content-area">
                            <h3><?php echo "{$user->first_name} {$user->last_name}" ;?></h3>
                            <p><?php echo $user->username ; ?></p>
                            <p><?php echo $user->jabatan ; ?></p>
                        </div>
                    </div>
                    <div class="profile-footer">
                    <ul>
                            <li>
                                <div class="title">
                                    <i class="material-icons">library_books</i>
                                    Pendidikan
                                </div>
                                <div class="content">
                                    <?php echo $user->pendidikan ; ?>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <i class="material-icons">location_on</i>
                                    Lokasi
                                </div>
                                <div class="content">
                                    <?php echo $user->alamat ; ?>
                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <i class="material-icons">notes</i>
                                    Deskripsi
                                </div>
                                <div class="content">
                                    <?php echo $user->deskripsi ; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Rubah Password</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                <?php
                                    $attributes = array('class' => 'form-horizontal');
                                    echo form_open('dinas/edit_user', $attributes);
                                ?>
                                        <div class="form-group">
                                            <label for="first_name" class="col-sm-2 control-label">Nama Awal*</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user->first_name ; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name" class="col-sm-2 control-label">Nama Akhir</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user->last_name ; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">Username*</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username ; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email*</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email ; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="company" class="col-sm-2 control-label">SKPD/ UKPD</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="company" name="company" value="<?php echo $user->company ; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $user->jabatan ; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pendidikan" class="col-sm-2 control-label">Pendidikan</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?php echo $user->pendidikan ; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" ><?php echo $user->alamat ; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" ><?php echo $user->deskripsi ; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">SIMPAN</button>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                <?php
                                    $attributes = array('class' => 'form-horizontal');
                                    echo form_open('dinas/change_password', $attributes);
                                ?>
                                        <div class="form-group">
                                            <label for="OldPassword" class="col-sm-3 control-label">Password Lama*</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="ketik password lama" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPassword" class="col-sm-3 control-label">Password Baru*</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="ketik password baru minimal 8 karakter tanpa spasi" minlength="8" required>
                                                </div>
                                                <div class="help-info">Minimum 8 characters</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPasswordConfirm" class="col-sm-3 control-label">Password Baru (Confirm)*</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="Ketik ulang password baru" minlength="8" required>
                                                </div>
                                                <div class="help-info">Minimum 8 characters</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-danger">SIMPAN</button>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>