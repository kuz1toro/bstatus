    <section class="content" >
        <div class="container-fluid">
        <?php //print_r($dataPemeriksaan); ?>
            <div class="row clearfix">
                <!-- Total gedung -->
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body bg-black">
                            <div class="font-bold m-b--35">DATA GEDUNG KESELURUHAN</div>
                            <ul class="dashboard-stat-list">
                            <?php
                                foreach($dataGdgAll as $row)
                                {
                                    echo '
                                    <li>
                                        '.$row['statGdg'].'
                                        <span class="pull-right"><b>'.$row['hasil'].'</b> <small>Gedung</small></span>
                                    </li>
                                    ' ;
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
               <!-- gedung pemda dki-->
               <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body bg-deep-purple">
                            <div class="font-bold m-b--35">DATA GEDUNG PEMDA DKI</div>
                            <ul class="dashboard-stat-list">
                            <?php
                                foreach($dataGdgPemda as $row)
                                {
                                    echo '
                                    <li>
                                        '.$row['statGdg'].'
                                        <span class="pull-right"><b>'.$row['hasil'].'</b> <small>Gedung</small></span>
                                    </li>
                                    ' ;
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- gedung pemerintah -->
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">DATA GEDUNG PEMERINTAH NON DKI</div>
                            <ul class="dashboard-stat-list">
                            <?php
                                foreach($dataGdgPemerintah as $row)
                                {
                                    echo '
                                    <li>
                                        '.$row['statGdg'].'
                                        <span class="pull-right"><b>'.$row['hasil'].'</b> <small>Gedung</small></span>
                                    </li>
                                    ' ;
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- gedung swasta-->
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body bg-deep-orange">
                            <div class="font-bold m-b--35">DATA GEDUNG SWASTA</div>
                            <ul class="dashboard-stat-list">
                            <?php
                                foreach($dataGdgSwasta as $row)
                                {
                                    echo '
                                    <li>
                                        '.$row['statGdg'].'
                                        <span class="pull-right"><b>'.$row['hasil'].'</b> <small>Gedung</small></span>
                                    </li>
                                    ' ;
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Bar Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>KINERJA POKJA TAHUN <?php echo $year; ?></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                        <?php 
                        $label_name = array('label1', 'label2', 'label3', 'label4', 'label5');
                        $data_name = array('data1', 'data2', 'data3', 'data4', 'data5');
                        $i = 0;
                        foreach($dataPemeriksaan as $row)
                            {
                                echo '
                                    <script>var '.$label_name[$i].' = "'.$row['pokja'].'" </script>
                                    <script>var '.$data_name[$i].' = ['.$row['list_count'].']</script>
                                ';
                                $i++;
                            } ?>
                            <canvas id="bar_chart" height="auto"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>
        </div>
    </section>

    
