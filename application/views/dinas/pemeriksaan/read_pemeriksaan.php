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
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php //echo $header;  ?>
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
                                        echo '<div><h4 >Gedung</h4></div>';
                                        for($i=0; $i<=3; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$gnames[$i].'</td>';
                                            echo '<td width="1">:</td>';
                                            echo '<td>'.$row[$gcontents[$i]].'</td>';
                                            echo '</tr>';
                                        }
                                        echo '</tbody></table><table class="table"><tbody><div><h4>Data Pemeriksaan</h4></div>';
                                        for($i=0; $i<=1; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$pnames[$i].'</td>';
                                            echo '<td width="1">:</td>';
                                            if($i==1){
                                                echo '<td>'.sqlDate2html($row[$pcontents[$i]]).'</td>';
                                            }else{
                                                echo '<td>'.$row[$pcontents[$i]].'</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        echo '<tr>';
                                        echo '<td class="col-xs-4">'.$pnames[2].'</td>';
                                        echo '<td width="1">:</td>';
                                        echo '<td>'.$row[$pcontents[2]].'<br/>'.$row[$pcontents[3]].'<br/>'.$row[$pcontents[4]].'</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td class="col-xs-4">'.$pnames[5].'</td>';
                                        echo '<td width="1">:</td>';
                                        echo '<td>'.$row[$pcontents[5]].'<br/>'.$row[$pcontents[6]].'<br/>'.$row[$pcontents[7]].'</td>';
                                        echo '</tr>';
                                        for($i=8; $i<=14; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$pnames[$i].'</td>';
                                            echo '<td width="1">:</td>';
                                            if($i==11 || $i==12){
                                                echo '<td>'.sqlDate2html($row[$pcontents[$i]]).'</td>';
                                            }elseif($i==13){
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
                    <div class="font-10 align-right m-r-15">
                        <?php echo 'dibuat oleh : '.$data_pemeriksaan[0]['created_byP'].' || waktu pembuatan : '.$data_pemeriksaan[0]['created_atP'].' || diedit oleh : '.$data_pemeriksaan[0]['edit_byP'].' || waktu edit : '.$data_pemeriksaan[0]['edit_atP'].'';?>
                    </div>
                    </div>
                </div>
                <!-- #END# Content -->
            </div>
        </div>
    </section>

    
