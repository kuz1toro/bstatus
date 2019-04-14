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
                    <div class="alert bg-blue alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="material-icons">warning</i>&nbsp Untuk Menghindari duplikasi data gedung, pastikan bahwa Gedung yang akan diinput belum terdapat pada database ini, dengan cara mengecek no gedung atau nama gedung
                    </div>
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
                                        $i = 0;
                                        foreach($data as $row)
                                        {
                                            echo '<tr>';
                                                echo '<td class="hidden">'.$row[$id_table].'</td>';
                                                echo '<td>'.$count.'</td>';
                                                echo '<td><span class="badge bg-blue-grey">'.$row[$dhead[0]].'</span><br/>'.$row[$dhead[1]].'</td>';
                                                echo '<td>'.$row[$dhead[2]].'<br/>'.$row[$dhead[3]].',&nbsp '.$row[$dhead[4]].',&nbsp '.$row[$dhead[5]].'</td>';
                                                for($i=6; $i<=7; $i++)
                                                {
                                                    echo '<td>';
                                                    echo $row[$dhead[$i]].'</td>';
                                                }
                                                echo '<td class="js-sweetalert">
                                                    <a href="'.$read_url.'/'.$row[$id_table].'" class="btn bg-green btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" title="lihat"><i class="material-icons">open_in_new</i></a>
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

    
