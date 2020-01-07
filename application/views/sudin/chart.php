<section class="content" >
    <div class="container-fluid">
            <?php //print_r($dataPemeriksaan); ?>
            <div class="row clearfix">
                <section class="panel" >
                    
                        <div class="col-md-12" style="background-color:blue;color:white;">
                            <h2 style="text-align: center;">Dinas Penanggulangan Kebakaran dan Penyelamatan</h2>
                            <h2 style="text-align: center;">Provinsi DKI Jakarta</h2>
                        </div>
                    
                    <div class="col-md-12">
                        <h3 style="text-align: center;">Rekap Status Keselamatan Kebakaran Gedung</h3>
                    </div>
                        <?php //print_r($test); 
                        //d($pdfKey);
                        //d($pdfFile);
                        //d($test);
                        //d($pdfKey);
                        //d(array($bench1, $bench2, $bench3)) ?>
                    <div class="panel-body">
                        <button type="button" class="btn btn-warning waves-effect m-r-20" data-toggle="modal" data-target="#rekapModal">PDF</button>
                        <table width="100%" class="table">
                            <thead style="background-color: #85c1e9;">
                                <tr>
                                    <th rowspan="3" style="vertical-align: middle;text-align: center;border:2px solid;">NO</th> 
                                    <th rowspan="3" style="vertical-align: middle;text-align: center;border:2px solid;">STATUS BANGUNAN GEDUNG</th> 
                                    <th colspan="6" scope="colgroup"  style="text-align: center;border:2px solid;">KEPEMILIKAN</th>
                                    <th colspan="2" rowspan="2"  style="vertical-align: middle;text-align: center;border:2px solid;">TOTAL</th>
                                </tr>
                                <tr>
                                    <th colspan="2"  scope="col" style="text-align: center;border:2px solid;">PEMERINTAH DKI</th>
                                    <th colspan="2"  scope="col" style="text-align: center;border:2px solid;">PEMERINTAH NON DKI</th>
                                    <th colspan="2"  scope="col" style="text-align: center;border:2px solid;">SWASTA</th>
                                </tr>
                                <tr>
                                    <th scope="col" style="text-align: center;border:2px solid;">ANGKA</th>
                                    <th scope="col" style="text-align: center;border:2px solid;">%</th>
                                    <th scope="col" style="text-align: center;border:2px solid;">ANGKA</th>
                                    <th scope="col" style="text-align: center;border:2px solid;">%</th>
                                    <th scope="col" style="text-align: center;border:2px solid;">ANGKA</th>
                                    <th scope="col" style="text-align: center;border:2px solid;">%</th>
                                    <th scope="col" style="text-align: center;border:2px solid;">ANGKA</th>
                                    <th scope="col" style="text-align: center;border:2px solid;">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #ececec;border:2px solid;">
                                    <td>#</td>
                                    <td>Memenuhi Syarat Keselamatan Kebakaran</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                
                                    <?php
                                        $count = 1;
                                        $i = 0;
                                        $j = 0;
                                        $colList = array('A','B','C','D');
                                        foreach ($table[0] as $r1) {
                                            echo '<tr>';
                                            foreach ($r1 as $r2) {
                                                if($count==1){
                                                    echo '<td style="background-color: #F6F6F7;text-align:center;border:2px solid;">';
                                                    echo $r2;
                                                    echo '</td>';
                                                }
                                                elseif($count==2){
                                                    echo '<td style="background-color: #F6F6F7;text-align:left;border:2px solid;">';
                                                    echo $r2;
                                                    echo '</td>';
                                                }
                                                elseif($count % 2 !== 0 && $count > 2){
                                                    echo '<td style="background-color: #F6F6F7;text-align:right;border:2px solid;">';
                                                    echo '<a target="_blank" rel="noopener noreferrer" href="'.site_url().'dinas/chart/'.$colList[$i].$j.'" >';
                                                    echo $r2;
                                                    echo '</a>';
                                                    echo '</td>';
                                                    $i++;
                                                }
                                                else{
                                                    echo '<td style="background-color: #F6F6F7;text-align:right;border:2px solid;">';
                                                    echo $r2;
                                                    echo '</td>';
                                                }
                                                $count++;
                                            }
                                            $count = 1;
                                            $i = 0;
                                            $j++;
                                            echo '</tr>';
                                        }
                                    ?>
                                    
                                <tr style="background-color: #E1F0F8; font-weight: bold;">
                                    <?php
                                        $count = 1;
                                        $i = 0;
                                        $j = 3;
                                        $colList = array('O','P','Q','R');
                                        foreach ($subtable[0][0] as $r2) {
                                            if($count % 2 == 0 && $count > 1){
                                                echo '<td style="text-align:right;border:2px solid;" >';
                                                echo '<a target="_blank" rel="noopener noreferrer" href="'.site_url().'dinas/chart/'.$colList[$i].$j.'" >';
                                                echo $r2;
                                                echo '</a>';
                                                echo '</td>';
                                                $i++;
                                            }elseif ($count == 1) {
                                                echo '<td colspan="2" class="text-right" style="padding-right: 15px;border:2px solid;">';
                                                echo $r2;
                                                echo '</td>';
                                            }else{
                                                echo '<td style="text-align:right;border:2px solid;">';
                                                echo $r2;
                                                echo '</td>';
                                            }
                                            $count++;
                                        }
                                    ?>
                                </tr>
                                <tr style="background-color: #ececec;border:2px solid;">
                                    <td>#</td>
                                    <td>Tidak Memenuhi Syarat Keselamatan Kebakaran</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php
                                        $count = 1;
                                        $i = 0;
                                        $j = 4;
                                        $colList = array('A','B','C','D');
                                        foreach ($table[1] as $r1) {
                                            echo '<tr>';
                                            foreach ($r1 as $r2) {
                                                if($count==1){
                                                    echo '<td style="background-color: #F6F6F7;text-align:center;border:2px solid;">';
                                                    echo $r2;
                                                    echo '</td>';
                                                }
                                                elseif($count==2){
                                                    echo '<td style="background-color: #F6F6F7;text-align:left;border:2px solid;">';
                                                    echo $r2;
                                                    echo '</td>';
                                                }
                                                elseif($count % 2 !== 0 && $count > 2){
                                                    echo '<td style="background-color: #F6F6F7;text-align:right;border:2px solid;">';
                                                    echo '<a target="_blank" rel="noopener noreferrer" href="'.site_url().'dinas/chart/'.$colList[$i].$j.'" >';
                                                    echo $r2;
                                                    echo '</a>';
                                                    echo '</td>';
                                                    $i++;
                                                }else{
                                                    echo '<td style="text-align:right;border:2px solid;">';
                                                    echo $r2;
                                                    echo '</td>';
                                                }
                                                $count++;
                                            }
                                            $count = 1;
                                            $i = 0;
                                            $j++;
                                            echo '</tr>';
                                        }
                                    ?>
                                    
                                <tr style="background-color: #E1F0F8; font-weight: bold;">
                                    <?php
                                        $count = 1;
                                        $i = 0;
                                        $j = 12;
                                        $colList = array('O','P','Q','R');
                                        foreach ($subtable[1][1] as $r2) {
                                            if($count % 2 == 0 && $count > 1){
                                                echo '<td style="text-align:right;border:2px solid;" >';
                                                echo '<a target="_blank" rel="noopener noreferrer" href="'.site_url().'dinas/chart/'.$colList[$i].$j.'" >';
                                                echo $r2;
                                                echo '</a>';
                                                echo '</td>';
                                                $i++;
                                            }elseif ($count == 1) {
                                                echo '<td colspan="2" style="padding-right: 15px;text-align:right;border:2px solid;">';
                                                echo $r2;
                                                echo '</td>';
                                            }else{
                                                echo '<td style="text-align:right;border:2px solid;">';
                                                echo $r2;
                                                echo '</td>';
                                            }
                                            $count++;
                                        }
                                    ?>
                                </tr>
                                <tr style="background-color: #E1F0F8; font-weight: bold;">
                                <?php
                                        $count = 1;
                                        $i = 0;
                                        $j = 0;
                                        $colList = array('W','X','Y','Z');
                                        foreach ($total as $r2) {
                                            if($count % 2 == 0 && $count > 1){
                                                echo '<td style="text-align:right;border:2px solid;" >';
                                                echo '<a target="_blank" rel="noopener noreferrer" href="'.site_url().'dinas/chart/'.$colList[$i].$j.'" >';
                                                echo $r2;
                                                echo '</a>';
                                                echo '</td>';
                                                $i++;
                                            }elseif ($count == 1) {
                                                echo '<td colspan="2" style="padding-right: 15px;text-align:right;border:2px solid;">';
                                                echo $r2;
                                                echo '</td>';
                                            }else{
                                                echo '<td style="text-align:right;border:2px solid;">';
                                                echo $r2;
                                                echo '</td>';
                                            }
                                            $count++;
                                        }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- modal pdf -->
                    <div class="modal fade" id="rekapModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <iframe src="<?php echo base_url().'pdf/dinas/rekap.pdf#zoom=FitH'; ?>" style="right:0; top:0; bottom:0; width:100%;height:300px;"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="panel" >
                    <div class="card">
                        <div class="header">
                            <h2>
                            Report Data Pemeriksaan Sistem Keselamatan Kebakaran Gedung
                            </h2>
                        </div>
                        <div class="body">
                            <form>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line" id="bs_datepicker_container">
                                                <input type="text" name="tglStart"  id="tglStart" class="form-control" placeholder="Tanggal awal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line" id="bs_datepicker_container">
                                                <input type="text" name="tglEnd" id="tglEnd" class="form-control" placeholder="Tanggal akhir">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button type="button" id="report_button" class="btn btn-primary btn-lg m-l-15 waves-effect">
                                            <i class="material-icons">send</i>
                                            <span>Buat Laporan</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="display">
                                <table class="table table-bordered table-striped table-hover table-condensed dataTable example">
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>