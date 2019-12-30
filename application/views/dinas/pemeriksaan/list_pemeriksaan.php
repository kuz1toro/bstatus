    <section class="content" >
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
                        <i class="material-icons">warning</i>&nbsp Untuk Menghindari duplikasi data pemeriksaan, pastikan bahwa data pemeriksaan yang akan diinput belum terdapat pada database ini, dengan cara mengecek no permohonan atau no gedung
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
                            <div class="display">
                                <table class="table table-bordered table-striped table-hover table-condensed dataTable js-datatable-listPemeriksaan">
                                    <thead>
                                        <tr>
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
                                                echo '<td>'.$row[$id_table].'</td>';
                                                echo '<td><span class="badge bg-blue-grey">'.$row[$dhead_gdg[0]].'</span> || '.$row[$dhead_gdg[3]].'<br/>'.$row[$dhead_gdg[1]].'<br/>'.$row[$dhead_gdg[2]].'</td>';
                                                foreach($dhead as $col)
                                                {
                                                    echo '<td>';
                                                    if ($col == 'tgl_berlaku' || $col == 'tgl_expired'){
                                                        echo msqlDate2html($row[$col]);
                                                    }elseif($col == 'no_permh'){
                                                        echo $row[$col].'<br/>'.msqlDate2html($row['tgl_permh']).'';
                                                    }else{
                                                        echo $row[$col].'</td>';
                                                    }
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

    
