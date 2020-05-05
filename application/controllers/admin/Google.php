<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Google extends MY_Controller {
 
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('admin/Google_model', 'google');
        $this->load->helper(array('url','html','form'));
    }    
 
    public function index() {
        $users = $this->google->get_list();
 
        $markers = [];
        $infowindow = [];
 
        foreach($users as $value) {
          $markers[] = [
            $value->location_name, $value->latitude, $value->longitude, $value->maq_serial
          ];          
          $infowindow[] = [
           "<div class=info_content style='line-height: 0.7'><p><b>".$value->location_name."</b></p><p>Nsº ".$value->maq_serial."</p><p>".$value->location_info."</p></div>"
          ];
        }
        $location['markers'] = json_encode($markers);
        $location['infowindow'] = json_encode($infowindow);
     
        $this->load->view('admin/google/map_marker',$location);
    }
     
}
?>