<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    POTRET BANGUNAN GEDUNG TINGGI
                    <?php //print_r($table); 
                    d($table); ?>
                </header>
                <div class="panel-body">
                    <table width="100%" class="table table-responsive">
                        <col>
                        <colgroup span="2"></colgroup>
                        <colgroup span="2"></colgroup>
                        <thead style="border:1px;">
                            <tr>
                                <th rowspan="3" class="text-center" style="vertical-align: middle;background-color: #E8F5A3;">NO</th> 
                                <th rowspan="3" class="text-center" style="vertical-align: middle;background-color: #E8F5A3;">STATUS BANGUNAN GEDUNG</th> 
                                <th colspan="6" scope="colgroup" class="text-center" style="background-color: #E8F5A3;">KEPEMILIKAN</th>
                                <th colspan="2" rowspan="2" class="text-center" style="vertical-align: middle;background-color: #F7F7F7;">TOTAL</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center" scope="col" style="background-color: #81BD5F;color:#fff;">PEMERINTAH DKI</th>
                                <th colspan="2" class="text-center" scope="col" style="background-color: #CD82AD;color:#fff;">PEMERINTAH NON DKI</th>
                                <th colspan="2" class="text-center" scope="col" style="background-color: #67B7DC;color:#fff;">SWASTA</th>
                            </tr>
                            <tr>
                                <th scope="col" style="background-color: #81BD5F;color:#fff;text-align: center;">ANGKA</th>
                                <th scope="col" style="background-color: #81BD5F;color:#fff;text-align: center;">%</th>
                                <th scope="col" style="background-color: #CD82AD;color:#fff;text-align: center;">ANGKA</th>
                                <th scope="col" style="background-color: #CD82AD;color:#fff;text-align: center;">%</th>
                                <th scope="col" style="background-color: #67B7DC;color:#fff;text-align: center;">ANGKA</th>
                                <th scope="col" style="background-color: #67B7DC;color:#fff;text-align: center;">%</th>
                                <th scope="col" style="background-color: #F7F7F7;text-align: center;">ANGKA</th>
                                <th scope="col" style="background-color: #F7F7F7;text-align: center;">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: #ececec">
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
                                    foreach ($table[0] as $r1) {
                                        echo '<tr>';
                                        foreach ($r1 as $r2) {
                                            if($count % 2 !== 0 && $count > 2){
                                                echo '<td class="textright" style="background-color: #F6F6F7;">';
                                                echo '<a href="#defaultModal" data-toggle="modal">';
                                                echo $r2;
                                                echo '</a>';
                                                echo '</td>';
                                            }else{
                                                echo '<td>';
                                                echo $r2;
                                                echo '</td>';
                                            }
                                            $count++;
                                        }
                                        $count = 1;
                                        echo '</tr>';
                                    }
                                ?>
                                
                            <tr style="background-color: #E1F0F8; font-weight: bold;">
                                <?php
                                    $count = 1;
                                    foreach ($subtable[0][0] as $r2) {
                                        if($count % 2 == 0 && $count > 1){
                                            echo '<td class="textright" >';
                                            echo '<a target="_blank"href="">';
                                            echo $r2;
                                            echo '</a>';
                                            echo '</td>';
                                        }elseif ($count == 1) {
                                            echo '<td colspan="2" class="text-right" style="padding-right: 15px;">';
                                            echo $r2;
                                            echo '</td>';
                                        }else{
                                            echo '<td>';
                                            echo $r2;
                                            echo '</td>';
                                        }
                                        $count++;
                                    }
                                ?>
                            </tr>
                            <tr style="background-color: #ececec">
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
                                    foreach ($table[1] as $r1) {
                                        echo '<tr>';
                                        foreach ($r1 as $r2) {
                                            if($count % 2 !== 0 && $count > 2){
                                                echo '<td class="textright" style="background-color: #F6F6F7;">';
                                                echo '<a target="_blank"href="">';
                                                echo $r2;
                                                echo '</a>';
                                                echo '</td>';
                                            }else{
                                                echo '<td>';
                                                echo $r2;
                                                echo '</td>';
                                            }
                                            $count++;
                                        }
                                        $count = 1;
                                        echo '</tr>';
                                    }
                                ?>
                                
                            <tr style="background-color: #E1F0F8; font-weight: bold;">
                                <?php
                                    $count = 1;
                                    foreach ($subtable[1][1] as $r2) {
                                        if($count % 2 == 0 && $count > 1){
                                            echo '<td class="textright" >';
                                            echo '<a target="_blank"href="">';
                                            echo $r2;
                                            echo '</a>';
                                            echo '</td>';
                                        }elseif ($count == 1) {
                                            echo '<td colspan="2" class="text-right" style="padding-right: 15px;">';
                                            echo $r2;
                                            echo '</td>';
                                        }else{
                                            echo '<td>';
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
                                    foreach ($total as $r2) {
                                        if($count % 2 == 0 && $count > 1){
                                            echo '<td class="textright" >';
                                            echo '<a target="_blank"href="">';
                                            echo $r2;
                                            echo '</a>';
                                            echo '</td>';
                                        }elseif ($count == 1) {
                                            echo '<td colspan="2" class="text-right" style="padding-right: 15px;">';
                                            echo $r2;
                                            echo '</td>';
                                        }else{
                                            echo '<td>';
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
                <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">MODAL - DEFAULT SIZE</button>
                
                <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <iframe src="<?php echo base_url().'pdf/dinas/example_001.pdf#zoom=FitH'; ?>" style="right:0; top:0; bottom:0; width:100%;height:300px;"></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>