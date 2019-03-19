<div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("disposisi/home"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
<?php
      //flash messages
	  //echo $flash_message;
      if($myflash_message){
            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Sukses mas bro!</strong> udah di simpan datenye.';
          echo '</div>';
		
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>hmm gagal mas bro!</strong> tanya kenapa?.';
          echo '</div>';          
        }
      ?>
	</div>
	
	<div class="form-actions">
            
			<?php echo '<a  href="'.site_url("disposisi").'/validasi"';?> class="btn btn-primary btn-lg" type="submit">Coba Lagi</a>
			<?php echo '<a  href="'.site_url("disposisi").'/home"';?> class="btn btn-primary btn-lg" type="submit">Home</a>
    </div>
</div>