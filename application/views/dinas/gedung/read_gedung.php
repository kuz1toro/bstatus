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
                                <?php echo ''.$header1.' & '.$header4.'';  ?>
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
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active">
                                <a href="#gedung" data-toggle="tab"  ><?php echo $header1;  ?></a></li>
                                <li role="presentation">
                                <a href="#riwayat" data-toggle="tab"><?php echo $header4;  ?></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="gedung">
                                    <table class="table">
                                        <tbody>
                                        <?php
                                            foreach($data_gedung as $row)
                                            {
                                                for($i=0; $i<=12; $i++)
                                                {
                                                    echo '<tr>';
                                                    echo '<td class="col-xs-4">'.$gnames[$i].'</td>';
                                                    echo '<td width="1">:</td>';
                                                    echo '<td>'.$row[$gcontents[$i]].'</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="font-10 align-right m-r-15">
                                        <?php echo 'dibuat oleh : '.$data_gedung[0]['created_by'].' waktu pembuatan : '.$data_gedung[0]['create_at'].' diedit oleh : '.$data_gedung[0]['edit_by'].' waktu edit : '.$data_gedung[0]['edit_at'].'';?>
                                    </div>
                                </div>
                                 <!-- Data Riwayat Kebakaran -->
                                <div role="tabpanel" class="tab-pane fade" id="riwayat">
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
                                                            echo sqlDate2html($row[$col]);
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
                                $j = 1;
                                foreach($data_pemeriksaan as $row)
                                {
                                    $tahun = date('Y', strtotime($row['tgl_berlaku']));
                                    echo '<li role="presentation" class="';
                                    if($active){echo 'active';}
                                    echo '"><a href="#'.$tahun.'-'.$j.'" data-toggle="tab">'.$tahun.'</a></li>';
                                    $active = FALSE;
                                    $j++;
                                } ?>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
                                $active = TRUE;
                                $j = 1;
                                foreach($data_pemeriksaan as $row)
                                    {
                                        $tahun = date('Y', strtotime($row['tgl_berlaku']));
                                        echo '<div role="tabpanel" class="tab-pane fade ';
                                        if($active){echo 'in active';}
                                        echo '" id="'.$tahun.'-'.$j.'">';
                                        $active = FALSE;
                                        echo '<table class="table">';
                                        echo '<tbody>';
                                            for($i=0; $i<=14; $i++)
                                            {
                                                echo '<tr>';
                                                echo '<td class="col-xs-4">'.$pnames[$i].'</td>';
                                                echo '<td width="1">:</td>';
                                                if($i==1 || $i==11 || $i==12){
                                                    echo '<td>'.sqlDate2html($row[$pcontents[$i]]).'</td>';
                                                }elseif($i==13){
                                                    echo '<td>'.htmlspecialchars_decode($row[$pcontents[$i]]).'</td>';
                                                }else{
                                                    echo '<td>'.$row[$pcontents[$i]].'</td>';
                                                }
                                                echo '</tr>';
                                            }
                                        echo '</tbody>
                                        </table></div>';
                                        $j++;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
