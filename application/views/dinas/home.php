    <section class="content" >
        <div class="container-fluid">
        <?php //print_r($dataPemeriksaan); ?>
            <div class="row clearfix">
                <!-- Total gedung -->
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body bg-black">
                            <div class="font-bold m-b--35">DATA GEDUNG KESELURUHAN</div> 
                            <?php //d($test); ?>
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
                <!-- #table expire gedung -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Gedung Status Tidak Memenuhi Syarat</h2>
                        </div>
                        <div class="body">                            
                            <div class="display">
                                <table class="table table-bordered table-striped table-hover table-condensed dataTable listExpired">
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
                                        foreach($expGedung as $row)
                                        {
                                            echo '<tr>';
                                                echo '<td>'.$count.'</td>';
                                                echo '<td><span class="badge bg-blue-grey">'.$row[$dhead[0]].'</span></td>';
                                                for($i=1; $i<=6; $i++)
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
                 <!-- #END table expire gedung -->
            </div>
        </div>
    </section>

    
