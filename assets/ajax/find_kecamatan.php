<?php
/**class Kecamatan extends CI_Controller {
//$kecamatan_id=intval($_GET['wilayah_id']);
$kecamatan_id=$this->input->post('Wilayah');
$this->load->model('permohonan_model');
$this->db->select('*');
$this->db->from('tabel_kecamatan');
$this->db->where('id', $kecamatan_id);
$query = $this->db->get();
$result = $query->result_array(); 
$kecamatan_id=intval($_GET['wilayah_id']);
$con = mysql_connect('localhost', 'root', '');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('bidang_pencegahan');
$query="SELECT id, Kecamatan FROM tabel_kecamatan WHERE id='$kecamatan_id'";
$result=mysql_query($query);
print_r($kecamatan_id); 

$mysqli = new mysqli("localhost", "root", "", "tabel_kecamatan");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " .            $mysqli->connect_error;
     }
    // END OF LOGIN TO DB SCRIPT
    //include DATABASE CONFIGURATION;
    $query="SELECT * FROM tabel_kecamatan WHERE id='$kecamatan_id'";
    $result = $mysqli->query($query); 
	
	$kecamatan_id=intval($_GET['wilayah_id']);
	$con = mysqli_connect ("localhost", "root", "", "bidang_pencegahan");
	if (!$con) {
		die('Could not connect: ' . mysqli_error());
	}
	
	mysqli_select_db($con,"tabel_kecamatan");
	$query="SELECT * FROM tabel_kecamatan WHERE id='".$kecamatan_id."'";
	$result=mysqli_query($con,$query); */
	
	$kecamatan_id=intval($_GET['wilayah_id']);
	$wilayah = dropdown_kecamatan($kecamatan_id);

?>

<select name="kec" onchange="getCity(<?php echo $country?>,this.value)">
<option>Pilih Kecamatan</option>
<?php
		foreach ($wilayah as $array)
		{ ?>
		<option value="<?php echo $array['id']?>"><?php echo $array['Kecamatan']?></option>
	<?php }
	?>
</select>