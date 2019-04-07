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
            <div class="row clearfix ">
                <!-- Content -->
                 <!-- Data Gedung -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header1;  ?>
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
                                    foreach($data_gedung as $row)
                                    {
                                        for($i=0; $i<=16; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$gnames[$i].'</td>';
                                            echo '<td>: &nbsp'.$row[$gcontents[$i]].'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <!-- Data Pemeriksaan -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header2;  ?>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <?php 
                                $active = TRUE;
                                foreach($data_pemeriksaan as $row)
                                {
                                    $tahun = date('Y', strtotime($row['tgl_berlaku']));
                                    echo '<li role="presentation" class="';
                                    if($active){echo 'active';}
                                    echo '"><a href="#'.$tahun.'" data-toggle="tab">'.$tahun.'</a></li>';
                                    $active = FALSE;
                                } ?>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
                                $active = TRUE;
                                foreach($data_pemeriksaan as $row)
                                    {
                                        $tahun = date('Y', strtotime($row['tgl_berlaku']));
                                        echo '<div role="tabpanel" class="tab-pane fade ';
                                        if($active){echo 'in active';}
                                        echo '" id="'.$tahun.'">';
                                        $active = FALSE;
                                        echo '<table class="table">';
                                        echo '<tbody>';
                                            for($i=0; $i<=9; $i++)
                                            {
                                                echo '<tr>';
                                                echo '<td class="col-xs-4">'.$pnames[$i].'</td>';
                                                echo '<td>: &nbsp'.$row[$pcontents[$i]].'</td>';
                                                echo '</tr>';
                                            }
                                        echo '</tbody>
                                        </table>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
                 <!-- Data FSM -->
            <div class="row clearfix p-l-10">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header3;  ?>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <div class="table-responsive">
                                <?php //print_r($data_fsm); 
                                 //print_r($data_pemeriksaan); ?>
                            </div>
                            <table class="table">
                                <tbody>
                                <?php
                                    if (empty($data_fsm)) {
                                        // list is empty.
                                        for($i=0; $i<=5; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$fsm_names[$i].'</td>';
                                            echo '<td>: &nbsp </td>';
                                            echo '</tr>';
                                        }
                                    }
                                    foreach($data_fsm as $row)
                                    {
                                        for($i=0; $i<=5; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td class="col-xs-4">'.$fsm_names[$i].'</td>';
                                            echo '<td>: &nbsp'.$row[$fsm_contents[$i]].'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Data Riwayat Kebakaran -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header4;  ?>
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <?php foreach($fire_names as $row)
                                                    {
                                                        echo '<th>'.$row.'</th>';
                                                    }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach($fireHist as $row)
                                        {
                                            echo '<tr>';
                                                echo '<td>'.$count.'</td>';
                                                foreach($fire_contents as $col)
                                                {
                                                    echo '<td>';
                                                    if ($col == 'tgl_kejadian'){
                                                        echo msqlDate2html($row[$col]);
                                                    }else{
                                                        echo $row[$col].'</td>';
                                                    }
                                                }
                                                $count++;
                                            echo '</tr>';
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

    
