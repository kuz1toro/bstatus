    <section class="content" >
        <div class="container-fluid">
        <?php //print_r($dataPemeriksaan); ?>
            <div class="row clearfix">
                <!-- Total gedung -->
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body bg-black">
                            <div class="font-bold m-b--35">DATA GEDUNG KESELURUHAN</div> 
                            <?php //d($kus); ?>
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
                            <h2>Chart Pemeriksaan Gedung</h2>
                        </div>
                        <div class="body">                            
                            <div id="allPemeriksaan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>
        </div>
    </section>

    
