<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function find_status_gedung($key) {
        
        $sql = "SELECT g.no_gedung,g.nama_gedung,g.alamat_gedung,g.link_location,p.hasil_pemeriksaan,p.status_gedung 
                FROM `dk_data_pemeriksaan` p
                join dk_data_gedung g on p.no_gedung = g.no_gedung
                WHERE g.nama_gedung like '%".$key."%' or g.alamat_gedung like '%".$key."%'";
        
        $query = $this->db->query($sql); // Produces: SELECT * FROM mytable
        $row = $query->result();
        $num = $query->num_rows();
        
        $query->free_result(); // The $query2 result object will no longer be available
        
        return array("rows" =>$row,"rownum" => $num);
    }
    
}
?>