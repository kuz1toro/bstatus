﻿    <section class="content" >
        <script>var page_url = '<?php echo base_url().'dinas/'.$delete_url.'/'; ?>';</script>
        <?php
        //Modal alert
        pesanModal();
        //print_r($data);
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
            <div class="row clearfix">
                <!-- Content -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header;  ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="<?php echo $add_url; ?>" class="btn btn-primary waves-effect"><i class="material-icons">queue</i><span>Tambah</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover table-condensed dataTable js-basic-example">
                                    <thead>
                                        <tr>
                                            <th class="hidden">id</th>
                                            <?php foreach($thead as $row)
                                                    {
                                                        echo '<th>'.$row.'</th>';
                                                    }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach($data as $row)
                                        {
                                            echo '<tr>';
                                                echo '<td class="hidden">'.$row[$id_table].'</td>';
                                                echo '<td>'.$count.'</td>';
                                                foreach($dhead as $col)
                                                {
                                                    echo '<td>';
                                                    if ($col == 'tgl_kejadian'){
                                                        echo msqlDate2html($row[$col]);
                                                    }else{
                                                        echo $row[$col].'</td>';
                                                    }
                                                }
                                                echo '<td class="js-sweetalert col-lg-1">
                                                    <a href="'.$read_url.'/'.$row[$id_table].'" class="btn bg-green btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" title="lihat"><i class="material-icons">remove_red_eye</i></a>
                                                    <a href="'.$edit_url.'/'.$row[$id_table].'" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" title="Edit"><i class="material-icons">edit</i></a>
                                                    <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" value="'.$row[$id_table].'" data-toggle="tooltip" title="Hapus" data-type="confirm_del_settingInput">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </td>';
                                                $count++;
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- #END# Content -->
            </div>
        </div>
    </section>

    
