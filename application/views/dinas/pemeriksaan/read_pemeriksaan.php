    <section class="content" >
        <script>var page_url = '<?php echo base_url().'dinas/'.$delete_url.'/'; ?>';</script>
        <?php
        //Modal alert
        pesanModal();
        //print_r($data_pemeriksaan);
		//flash messages
		if($this->session->flashdata('flash_message')=='sukses'){
			echo'<script>
			window.onload = function(){
				$("#sukses").modal();
			};
			</script>';
			$this->session->set_flashdata('flash_message', '');
        }
        elseif ($this->session->flashdata('flash_message')=='updated')
        {
			echo'<script>
			window.onload = function(){
				$("#updated").modal();
			};
			</script>';
			$this->session->set_flashdata('flash_message', '');
        }
        elseif ($this->session->flashdata('flash_message')=='deleted')
        {
			echo'<script>
			window.onload = function(){
				$("#deleted").modal();
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
		} ?>
        <div class="container-fluid">
            <div class="row clearfix ">
                <!-- Content -->
                <!-- Data Pemeriksaan -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header;  ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <div class="btn-group js-sweetalert" role="group">
                                        <a href="<?php echo base_url().'dinas/'.$list_url; ?>" class="btn btn-info waves-effect" data-toggle="tooltip" title="Kembali ke halaman sebelumnya"><i class="material-icons">keyboard_backspace</i></a>
                                        <a href="<?php echo base_url().'dinas/'.$edit_url.'/'.$this->uri->segment(3); ?>" class="btn btn-warning waves-effect" data-toggle="tooltip" title="Edit"><i class="material-icons">edit</i></a>
                                        <button type="button" class="btn btn-danger waves-effect" value="<?php echo $this->uri->segment(3); ?>" data-type="confirm_del_settingInput" data-toggle="tooltip" title="Hapus">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <div class="table-responsive">
                                <?php //print_r($data_gedung); 
                                 //print_r($data_pemeriksaan); ?>
                            </div>
                            <table class="table">
                                <tbody>
                                <?php
                                    foreach($data_pemeriksaan as $row)
                                    {
                                        for($i=0; $i<=3; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$gnames[$i].'</td>';
                                            echo '<td width="1">:</td>';
                                            echo '<td>'.$row[$gcontents[$i]].'</td>';
                                            echo '</tr>';
                                        }
                                        for($i=0; $i<=9; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$pnames[$i].'</td>';
                                            echo '<td width="1">:</td>';
                                            if($i==8){
                                                echo '<td>'.htmlspecialchars_decode($row[$pcontents[$i]]).'</td>';
                                            }else{
                                                echo '<td>'.$row[$pcontents[$i]].'</td>';
                                            }
                                            
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- #END# Content -->
            </div>
        </div>
    </section>

    
