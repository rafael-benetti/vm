
<?php class Map_model extends CI_Model {
	function __construct()    {
		parent::__construct();
	}
    
	function get_coordinates()    {
		
        $return = array();
        $this->db->select("lat,lng");
		$this->db->from("coords");
		$query = $this->db->get();
        if ($query->num_rows()>0) {
			foreach ($query->result() as $row) {
				array_push($return, $row);            }        }
        return $return;
    } }



?>