<div class="container top">

      <ol class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            Permohonan
          </a> 
        </li>
        <li class="active">
          Confirmation
        </li>
      </ol>

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
	
</div>