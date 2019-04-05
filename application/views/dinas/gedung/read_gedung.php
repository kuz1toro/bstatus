    <section class="content" >
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
                 <!-- Data Gedung -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo $header1;  ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="<?php echo $add_url; ?>" class="btn btn-primary waves-effect"><i class="material-icons">queue</i><span>Tambah</span></a>
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
                                        for($i=0; $i<=17; $i++)
                                        {
                                            echo '<tr>';
                                            echo '<td>'.$gnames[$i].'</td>';
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
                                            for($i=0; $i<=7; $i++)
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$pnames[$i].'</td>';
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
                <!-- #END# Content -->
            </div>
        </div>
    </section>

    
