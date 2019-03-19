    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a >
            Disposisi
          </a> 
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      
      <div class="row">
        <div class="span12 columns">
          <div class="well col-sm-12 col-xs-12">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            echo form_open('disposisi/Add_disposisi_step1', $attributes);
     
             echo '<div class="col-sm-3 col-xs-12" id="" style="" align="right" >
				    <div class="input-group" >
							<input type="text" class="form-control" name="search_string" id="" value="'.set_value($search_string_selected).'" placeholder="kata kunci" >
							<span class="input-group-btn" id=""><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
					</div>
				  </div>';	
			  
			  echo '<div class="col-sm-3 col-xs-12" id="" style="" align="center">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Cari di:</span>
							<select class="form-control" name="search_in" value="'.set_value($search_in_field).'">
								<option value="NamaGedung">Nama Gedung</option>
							<option value="NamaPengelola">Nama Pengelola</option>
							<option value="TipePermhn">Tipe Permohonan</option>
							<option value="NoPermhn">No Permohonan</option>
							<option value="TglPermhn">Tgl Permohonan</option>
							</select>
						</div>
					</div>';

			  echo '<div class="col-sm-6 hidden-xs" id="" style="">
						<div class="form-inline">
						<form class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Pengurutan:</span>
							<select class="form-control" name="order" value="'.set_value($order).'">
								<option value="id">No</option>
								<option value="NamaGedung">Nama Gedung</option>
							</select>
						</div>
						</form>
						<form class="form-group">
							<select class="form-control" name="order_type" value="'.set_value($order_type_selected).'">
								<option value="Asc">terkecil->terbesar</option>
								<option value="Desc">terbesar->terkecil</option>
							</select>
						</form>
						</div>
					</div>';

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">No</th>
                <th class="yellow header headerSortDown">Nama Pengelola</th>
				<th class="yellow header headerSortDown">Nama Gedung</th>
				<th class="yellow header headerSortDown">Tipe Permohonan</th>
				<th class="yellow header headerSortDown hidden-xs">No Permohonan</th>
				<th class="yellow header headerSortDown hidden-xs">Tgl Permohonan</th>
				<th class="yellow header headerSortDown hidden-xs">Tgl Surat Diterima</th>
				<th class="yellow header headerSortDown">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($permohonans as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['NamaPengelola'].'</td>';
				echo '<td>'.$row['Nama_Gedung_Id'].'</td>';
				echo '<td>'.$row['TipePermhn'].'</td>';
				echo '<td class="hidden-xs">'.$row['NoPermhn'].'</td>';
				echo '<td class="hidden-xs">'.sqlDate2html($row['TglPermhn']).'</td>';
				echo '<td class="hidden-xs">'.sqlDate2html($row['TglSuratDiterima']).'</td>';
                echo '<td >
                  <a href="'.site_url("disposisi").'/permohonan/Add_disposisi_step2/'.$row['id'].'" class="btn btn-success" data-toggle="tooltip" title="disposisi"><span class="glyphicon glyphicon-plus-sign"></span></a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <div style="text-align: center;">
				<?php echo $this->pagination->create_links(); ?>
		  </div>

      </div>
    </div>