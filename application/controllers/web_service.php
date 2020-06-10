<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

class web_service extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('JWT');
        // $this->load->library('form_validation');
        $this->load->model('model_web_service');
        $this->load->model('admin/auth_model');
        $this->load->database();
        // $this->load->library('session');
        $this->load->library('image_lib');
        // $this->load->helper('cookie');
        $this->load->library('email');
        // $this->load->library('pagination');

        date_default_timezone_set("America/sao_paulo");
        // session_start();
    }

    public function index() {
        // echo "dd";
    }

    public function login() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
         $key_status = $this->model_web_service->authenticate_key($request);

        if ($key_status) {
            $this->do_login($request);
        } else {

            $finresult[] = array('status' => 'failed', 'message' => 'Erro au selecionar apikey', 'code' => 'Login failed',
            );
            print json_encode($finresult);
        }
    }

    function do_login($request) {

        
                $data = array(
                    'username' => $request->Email,
                    'password' => $request->Password
                );

                $result = $this->auth_model->login($data);
      
        
        if ($result) {
            if($result['admin_role_id']=="2"){
            //$this->model_web_service->update_device_id($request->device_id, $result['id']);
            $finresult[] = array('status' => 'success', 'message' => 'Conectado com sucesso', 'code' => 'success',
                'id' => $result['id'],
                'id_admin' => $result['id'],
                'firstname' => $result['firstname'],
                'lastname' => $result['lastname'],
                'username' => $result['username'],
                'email' => $result['email'],
                'mobile_no' => $result['mobile_no'],
                'image' => $result['image'],
                'token' => $this->token_gen($result['username'])
            );
            print json_encode($finresult);
            }else{
                $finresult[] = array('status' => 'failed', 'message' => 'Você esta tentando conectar com usuario que não é operador!', 'code' => 'Login failed');
            print json_encode($finresult);
            }
        } else {
            $finresult[] = array('status' => 'failed', 'message' => 'Não foi possivel conectar, veifique suas credências e tnte novamente!', 'code' => 'Login failed');
            print json_encode($finresult);
        }
    }

    public function social_login() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->model_web_service->social_login($request);

        if ($result) {

            $finresult = array('status' => 'success', 'message' => 'Conectado com sucesso', 'code' => 'success',
                'id' => $result['id'], 'username' => $result['username'],
                'token' => $this->token_gen($result['username'])
            );
            print json_encode($finresult);
        } else {

            $this->model_web_service->insert_user_social($request);

            $finresult = array('status' => 'success', 'message' => 'Cadastro concluido com sucesso', 'code' => 'registered',
                'token' => $this->token_gen($request->Email)
            );
            print json_encode($finresult);
        }
    }

    public function sign_up() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $key_status = $this->model_web_service->authenticate_key($request);

        if ($key_status) {
            $this->do_sign_up($request);
        } else {
            $error_list[] = array(
                'message' => 'Secret key error',
                'code' => 'Secret key miss match'
            );
            $finresult = array(
                'status' => 'failed',
                'error_list' => $error_list
            );
            print json_encode($finresult);
        }
    }

    function do_sign_up($request) {

        $mail_status = $this->model_web_service->is_mail_exists($request->Email);
        $user_status = $this->model_web_service->is_username_exists($request->User_name);
        $mobile_status = $this->model_web_service->is_mobile_exists($request->Mobile);

        if ($mail_status || $user_status || $mobile_status) { //CHECK MAIL ID OR USER NAME EXIST
            //$error_list = array();

            if ($mail_status) {
                $error_list[] = array(
                    'message' => 'E-mail já esta em uso',
                    'code' => 'exists'
                );
            }
            if ($user_status) {
                $error_list[] = array(
                    'message' => 'Usuário já esta em uso',
                    'code' => 'exists'
                );
            }
            if ($mobile_status) {
                $error_list[] = array(
                    'message' => 'Celular já esta m uso',
                    'code' => 'exists'
                );
            }

            $finresult = array(
                'status' => 'failed',
                'error_list' => $error_list
            );

            print json_encode($finresult);
        } else {

            $this->model_web_service->insert_user_details($request);

            $finresult = array('status' => 'success', 'message' => 'Cadastro realizado com sucesso', 'code' => 'success',
                'token' => $this->token_gen($request->User_name)
            );
            print json_encode($finresult);
        }
    }

    public function fetch_cab_details() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $myDate = new DateTime();
        $myDate->setTimestamp(strtotime($request->book_date));

        $time = $myDate->format("H");

        if ($time >= 22 || $time <= 6) {
            $timetype = 'night';
        } else {
            $timetype = 'day';
        }

        $request->timetype = $timetype;

        $result = $this->model_web_service->fetch_cabs($request);
        $json = array();
        $json['success'] = false;
        $json['cabs'] = array();
        if (count($result) > 1) {
            foreach ($result as $res) {
                $json['cabs'][] = $res;
            }
            $json['success'] = true;
        }

        /* $finresult = array( 
          'status'  => 'success',
          'cabs'		=> $result
          ); */
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function load_trips() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $myDate = new DateTime();

        $current_date = $myDate->format("m/d/Y");

        $request->token = $request->user_name; //$this->extract_token( $request->token );

        $result = $this->model_web_service->load_trips($request);

        $success = array();
        $booking = array();
        $Cancelled = array();
        $booking_cancel = array();
        $booking_cancellation = array();
        $merge = array();
        $item_cancel2 = array();
        foreach ($result as $k => $item) {
            $item['pickup_date_formatted'] = date('M d', strtotime($item['pickup_date']));
            if ($item['assigned_for']) {
                $driver = $this->db->query("select * from driver_details where id='" . $item['assigned_for'] . "'");
                $item['driver'] = $driver->result_array();
                $result[$k]['driver'] = $driver->result_array();
            } else {
                $result[$k]['driver'] = array();
            }
            if ($item['status'] == 'Complete') {

                $success[] = $item;
            } else if ($item['status'] == 'Processing' || $item['status'] == 'Booking') {
                $booking[] = $item;
            } else if ($item['status'] == 'Cancelled') {
                $Cancelled[] = $item;
                $booking_cancellation = $this->db->query("select * from booking_cancellation")->result();

                foreach ($booking_cancellation as $item_cancel) {
                    if ($item['id'] == $item_cancel->booking_id) {
                        $booking_cancel[] = $item_cancel;
                        $item_cancel2 = array(
                            'cancel_id' => $item_cancel->cancel_id,
                            'reason' => $item_cancel->reason,
                            'subject' => $item_cancel->subject,
                        );
                        $merge[] = array_merge($item, $item_cancel2);
                    }
                }
            }
        }

        $finresult = array(
            'status' => 'success',
            'all' => $result,
            'booking' => $booking,
            'Cancelled' => $merge,
            'success' => $success,
        );


        print json_encode($finresult);
    }

    public function load_card_rate() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->model_web_service->load_all_cabs($request);

        $day = array();
        $night = array();

        foreach ($result as $item) {
            if ($item['timetype'] == 'day') {
                $day[] = $item;
            } else if ($item['timetype'] == 'night') {
                $night[] = $item;
            }
        }

        $finresult = array(
            'status' => 'success',
            'day' => $day,
            'night' => $night
        );
        print json_encode($finresult);
    }

    public function update_pwd() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $request->token = $this->extract_token($request->token);

        $result = $this->model_web_service->update_pwd($request);

        $finresult = array(
            'status' => 'success',
        );
        print json_encode($finresult);
    }

    public function paymentSuccess() {
        print_r($_POST);
        die();
    }

    public function book_cab() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $request->uneaque_id = 'CMC' . strtotime(date('m/d/Y H:i:s'));
        //	$request->amount = 1;
        //	$request->km = 1;

        header('Content-Type: application/json');
        $myDate = new DateTime();
        $myDate->setTimestamp(strtotime($request->book_date));

        $time = $myDate->format("H");

        if ($time >= 22 || $time <= 6) {
            $request->timetype = 'night';
        } else {
            $request->timetype = 'day';
        }

        $request->book_date = $myDate->format("m/d/Y");
        $request->pickup_time = $myDate->format("h:i a");

        $request->token = ''; //$this->extract_token( $request->token );

        $finresult = $this->model_web_service->book($request);
        header('Content-Type: application/json');
        echo json_encode($finresult);
    }

    public function update_payment_status() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        if (isset($request->paid_amount) && $request->trip_id != null) {

            $finresult = $this->model_web_service->update_payment_status($request);
        }
        header('Content-Type: application/json');
        echo json_encode($finresult);
    }

    function token_gen($item) {

        // $token = array();
        // $token['id'] = 1;
        return JWT::encode($item, APP_SECRET_KEY);
    }

    function extract_token($item) {
        $token = JWT::decode($item, APP_SECRET_KEY);

        return $token;
    }

    public function settings() {
        $result = $this->model_web_service->load_settings();
        print json_encode($result[0]);
    }

    /* Shajeer Callmycab driver app starts here */

    public function driver_login() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->model_web_service->driver_login($request);

        if ($result) {

            $finresult[] = array('status' => 'success', 'message' => 'Conectado com sucessp', 'code' => 'success',
                'id' => $result['id'],
                'mobile' => $result['phone'],
                'username' => $result['user_name'],
                'email' => $result['email'],
                'car_no' => $result['car_no'],
                'wallet_amount' => $result['wallet_amount']
            );
            print json_encode($finresult);
        } else {
            $finresult[] = array('status' => 'failed', 'message' => 'Dados incorreto, por favor tente novamente!', 'code' => 'Login failed',
            );
            print json_encode($finresult);
        }

        //var_dump($request);
    }

    public function driver_sign_up() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $already_exist = $this->model_web_service->driver_id_exist($request->User_name);

        if ($already_exist) {  //new user //check not exist
            $driver_register = $this->model_web_service->driver_sign_up_model($request);
            $success_msg = array('message' => 'Successfully registered',
                'status' => 'success'
            );
            print json_encode($success_msg);
        } else {
            $error_list[] = array(
                'message' => 'Usuario ou email já existe',
                'code' => 'User Name or Email id Already exists'
            );
            $finresult = array(
                'status' => 'failed',
                'error_list' => $error_list
            );
            print json_encode($finresult);
        }
    }

    /* public function driver_sign_up()
      {
      $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);

      $already_exist=$this->model_web_service->driver_id_exist($request->Email,$request->User_name);

      if( $already_exist ){  //new user //check not exist
      $driver_register=$this->model_web_service->driver_sign_up_model($request);
      $success_msg=array( 'message' => 'Successfully registered',
      'status'  => 'success'
      );
      print json_encode($success_msg);
      }else{
      $error_list[] = array(
      'message' => 'User Name or Email id Already exists',
      'code'    => 'User Name or Email id Allready exists'
      );
      $finresult = array(
      'status'  => 'failed',
      'error_list' => $error_list
      );
      print json_encode($finresult);
      }
      }
     */

    public function driver_bookings() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->model_web_service->driver_bookings($request);
        $new_rade = array();
        $complete = array();
        $Cancelled = array();
        $Booking_cancel = array();
        $merge = array();

        $temp = array();
        //var_dump($result);
        $booking_cancellation = $this->db->query("select * from booking_cancellation where driver_id='" . $request->driver_id . "'")->result();

        foreach ($result as $item) {
            if ($item['status'] == 'Processing') {
                $new_rade[] = $item;
            } else if ($item['status'] == 'Complete') {
                $complete[] = $item;
            } else if ($item['status'] == 'Cancelled') {
                $Cancelled[] = $item;
                foreach ($booking_cancellation as $item_cancel) {
                    if ($item['id'] == $item_cancel->booking_id) {
                        $booking_cancel[] = $item_cancel;
                        $item_cancel2 = array(
                            'cancel_id' => $item_cancel->cancel_id,
                            'reason' => $item_cancel->reason,
                            'subject' => $item_cancel->subject,
                        );
                        $merge[] = array_merge($item, $item_cancel2);
                    }
                }
            }
        }
        //	$merge[] = array_merge($Cancelled,$booking_cancel);

        $settings_table = 'settings';
        $select_data = "measurements,currency";

        $this->db->select($select_data);

        $this->db->where('id', 1);

        $query = $this->db->get($settings_table);
        $settings_result = $query->result_array();
        $booking_cancellation = array();



        $finresult = array(
            'status' => 'success',
            'all' => $result,
            'new_rade' => $new_rade,
            'complete' => $complete,
            'Cancelled' => $merge,
            'settings' => $settings_result
        );
        print json_encode($finresult);

        //var_dump($result);
    }

    /* Fetch data ride rate 
      sends JSON as Post data, which holds the entire row data of current booking
     */

    public function getRide_rate() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $booking_id = $request->uneaque_id;

        $purpose = $request->purpose;
        $taxi_type = $request->taxi_type;
        $package = $request->package;
        $transfer = $request->transfer;
        $timetype = $request->timetype;

        $table = 'cabdetails';
        $select_data = "";
        // echo $transfer;

        if ($purpose == "Ponto a ponto") {
            $select_data = "intialkm,intailrate,standardrate";
        }

        if ($purpose == "Aeroporto") {

            if ($transfer == "going") {
                $select_data = "intialkm,intailrate,standardrate";
            }

            if ($transfer == "coming") {
                $select_data = "fromintialkm,fromintailrate,fromstandardrate";
            }
        }

        if ($purpose == "Valor por hora") {

            if ($transfer == "oneway") {
                $select_data = "standardrate";
            }

            if ($transfer == "round") {
                $select_data = "fromstandardrate";
            }
        }

        if ($purpose == "Agendamento") {
            $select_data = "standardrate";
        }

        $where_con = array();

        if ($purpose != "") {
            $where_con = array_merge($where_con, array('transfertype' => $purpose));
        }
        if ($taxi_type != "") {
            $where_con = array_merge($where_con, array('cartype' => $taxi_type));
        }
        if ($taxi_type != "") {
            $where_con = array_merge($where_con, array('cartype' => $taxi_type));
        }
        if ($package != "") {
            $where_con = array_merge($where_con, array('package' => $package));
        }
        if ($timetype != "") {
            $where_con = array_merge($where_con, array('timetype' => $timetype));
        }

        $this->db->select($select_data);
        $this->db->where($where_con);
        $query = $this->db->get($table);
        $result = $query->result_array();
        if (count($result) > 0) {
            $final_result = array(
                'status' => "success",
                'purpose' => $purpose,
                'transfer_tyepe' => $transfer,
                'booking_id' => $booking_id,
                'raw_data' => $result
            );
        } else {
            $final_result = array(
                'status' => "failed",
                'message' => "Não existem campos"
            );
        }

        print json_encode($final_result);
    }

    public function update_driver_pwd() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        //$request->token = $this->extract_token( $request->token );

        $result = $this->model_web_service->update_driver_password($request);

        if ($result == 1) {
            $finresult = array('status' => 'success',);
        } else {
            $finresult = array('status' => 'fail',);
        }


        print json_encode($finresult);
    }

    public function set_ride_as_complete() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $json = array();
        $json['success'] = false;
        $json['message'] = "Algo deu errado.";

        $table = "bookingdetails";
        $data = array(
            'status' => 'Complete'
        );

        $this->db->where('uneaque_id', $request->current_ride_id);
        $result = $this->db->update($table, $data);
        if ($result) {
            $book_detail = $this->db->query("Select * from bookingdetails where uneaque_id='" . $request->current_ride_id . "'")->row();
            $this->db->query("update driver_login set status ='0' where driver_details_id='" . $book_detail->assigned_for . "'");
            $message = "Esperamos que você tenha uma experiência incrível com esta viagem. valor total para " . $request->current_ride_id . " é . " . $book_detail->amount . "Aproveite os pacotes por hora a preços econômicos. Obrigado!";
            $this->sendSmg($message, $request->user_mobile_no);
            $json['success'] = true;
            $json['message'] = "Viagem concluída.";
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function fetchDriverAppLanguage() {

        $this->db->select('language_meta');
        $this->db->where('status', '1');
        $query = $this->db->get('app_languages');
        $result = $query->row();
        if (count($result)) {
            echo $result->language_meta;
            return;
        } else {
            echo "No data";
        }
    }

    public function fetchUserAppLanguage() {
        $this->db->select('language_meta');
        $this->db->where('status', '1');
        $query = $this->db->get('user_app_language');
        $result = $query->row();
        if (count($result)) {
            echo $result->language_meta;
        } else {
            echo "No data";
        }
    }

    public function get_driver_info() {
        $result = array();
        if ($_GET['longitude'] != '' && $_GET['latitude'] != '' && $_GET['taxi_type'] != '') {
            $where = array(
                'status' => 'Active',
            );
            $result['data'] = array();
            //"select * from car_categories cc LEFT JOIN driver_details dd on cc.id=dd.car_type_id where  "
            $sql = "SELECT *, SQRT(POW(69.1 * (dl.latitude - '" . $_GET['latitude'] . "'), 2) + POW(69.1 * ('" . $_GET['longitude'] . "' - dl.longitude) * COS(dl.latitude / 57.3), 2)) AS distance FROM driver_details  dd left JOIN driver_login dl on dd.id=dl.driver_details_id where dd.car_type='" . $_GET['taxi_type'] . "' and dl.is_online=1 and  dd.wallet_amount > 0 and  dl.status=0 HAVING distance < 500 ";
            //echo $sql; die();
            $drivers_data = $this->db->query($sql)->result_array();

            //	$drivers_data = $this->db->query("SELECT * FROM driver_details dd left JOIN driver_login dl on dd.id=dl.driver_details_id where dl.is_online=1 and dl.status=0")->result_array();
            if ($drivers_data) {
                $result['success'] = true;
                foreach ($drivers_data as $row) {
                    $car_info = array();
                    $car_info = $this->db->query("SELECT * FROM `car_categories` where id='" . $row['car_type_id'] . "'")->row();
                    $result['data'][] = array(
                        "driver_id" => $row['id'],
                        "name" => $row['name'],
                        "phone" => $row['phone'],
                        "email" => $row['email'],
                        "license_no" => $row['license_no'],
                        "car_type" => $row['car_type'],
                        "car_type_id" => $row['car_type_id'],
                        "car_no" => $row['car_no'],
                        "gender" => $row['gender'],
                        "driver_login_id" => $row['driver_login_id'],
                        "is_online" => $row['is_online'],
                        "is_bussy" => $row['status'],
                        "latitude" => $row['latitude'],
                        "longitude" => $row['longitude'],
                    );
                }
            }
        }
        if (empty($result['data'])) {
            $result['message'] = 'Dados não existe';
            $result['success'] = false;
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function track_driver() {
        $result = array();
        $result['message'] = 'Dados não existe';
        $result['success'] = false;
        //  $postdata = file_get_contents("php://input");
        //	$request = json_decode($postdata);


        $data = json_decode(file_get_contents('php://input'), true);
        //echo  $data['driver_id'];  die();

        if ($data['longitude'] != '' && $data['latitude'] != '' && $data['driver_id'] != '') {
            $detail = $this->db->query("select * from driver_login where driver_details_id='" . $data['driver_id'] . "' and is_online='1'");
            if ($detail->num_rows > 0) {
                $where = array(
                    'driver_details_id' => $data['driver_id']
                );
                $this->db->query("Update driver_login set longitude='" . $data['longitude'] . "', latitude='" . $data['latitude'] . "', last_location_update=now() where driver_details_id='" . $data['driver_id'] . "' and is_online='1' ");
            } else {
                $this->db->query("insert into driver_login (driver_details_id,is_online,status,latitude,longitude,last_location_update,date_added) values ('" . $data['driver_id'] . "',1,0,'" . $data['latitude'] . "','" . $data['longitude'] . "',now(),now())");
            }
            $result['message'] = 'Gravação realizada com sucesso';
            $result['success'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function get_driver_lat_lng() {
        $result = array();
        $result['message'] = 'Dados não existe';
        $result['success'] = false;
        $data = json_decode(file_get_contents('php://input'), true);
        // print_r($data["driver_id"]);  die();
        //	echo $request; die();
        if ($data["driver_id"]) {
            $data = $this->db->query("select * from driver_login where driver_details_id='" . $data["driver_id"] . "' and is_online='1' ");
            $data = $data->result_array();
            if (count($data) > 0) {
                $result['data'] = $data;
                $result['message'] = '';
                $result['success'] = true;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function send_message() {
        $result = array();
        $result['message'] = 'Record not found';
        $result['success'] = false;
        $message = '';
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data["driver_id"]) && $data["driver_id"] != null) {
            $driver = $this->db->query("select phone,name,car_no from driver_details where id='" . $data["driver_id"] . "' ")->row();
            $booking = $this->db->query("select * from bookingdetails where id='" . $data["booking_id"] . "' ")->row();


            $pin = rand(1000, 9999);

            if (isset($data["user_id"]) && $data["user_id"] != null) {
                $user = $this->db->query("select * from userdetails where username='" . $data["user_id"] . "' ")->row();

                if (isset($user->mobile) && $user->mobile != null) {

                    $message = "Obrigado por reservar. Atribuímos o motorista:" . $driver->name . ", Celular: " . $driver->phone . ",Código de reserva:" . $pin . " para seu agendamento " . $booking->uneaque_id . ". Você será buscado na hora:" . $booking->pickup_time . ". Data:" . $booking->pickup_date . ".Estamos ansiosos para tê-lo a bordo!";

                    /* $message = urlencode($message);
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => "",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "GET",
                      CURLOPT_SSL_VERIFYHOST => 0,
                      CURLOPT_SSL_VERIFYPEER => 0,
                      ));
                      $response = curl_exec($curl);
                      $err = curl_error($curl);
                      curl_close($curl);
                      if ($err) {
                      $result['success'] = false;
                      $result['message'] ='Something went wrong! Please try again later.';
                      } else {
                      $result['success'] = true;
                      $result['message'] ='';
                      } */
                    $insert = array(
                        "driver_id" => $data["driver_id"],
                        "username" => $data["user_id"],
                        "pin" => $pin,
                        "booking_id" => $data["booking_id"],
                        "is_used" => 0,
                        "date_added" => date("Y-m-d h:i:s"),
                        "date_modified" => date("Y-m-d h:i:s"),
                    );
                    $this->db->insert('booking_pin', $insert);
                    $result['m'] = $message;
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function start() {
        $result = array();
        $result['message'] = 'Dados não encontrado';
        $result['success'] = false;
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data["driver_id"]) && $data["username"] != null && $data["pin"] != null) {
            $is_found = $this->db->query("select * from booking_pin where driver_id='" . $data["driver_id"] . "' and username='" . $data["username"] . "' and pin='" . $data["pin"] . "' and is_used=0")->row();
            if (count($is_found) != "0") {
                $result['success'] = true;
                $result['message'] = 'Gravações realizadas com sucesso.';
                $this->db->query("UPDATE  booking_pin SET is_used=1 where driver_id='" . $data["driver_id"] . "' and username='" . $data["username"] . "' ");
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function transaction() {
        $result = array();
        $result['message'] = 'Dados não encontrado';
        $result['success'] = false;
        $result['wallet_amount'] = 0;
        $result['transactions'] = array();
        $data = $_GET; //json_decode(file_get_contents('php://input'), true);
        $transactions = array();
        if (isset($data["driver_id"]) && $data["driver_id"] != null) {
            $driver_data = $this->db->query("select * from driver_details where id='" . $data['driver_id'] . "'")->row();
            $result['wallet_amount'] = $driver_data->wallet_amount;
            $transactions = $this->db->query("select * from wallet_transaction where driver_id='" . $data["driver_id"] . "' and status='TXN_SUCCESS'")->result();
        } else if (isset($data["user_id"]) && $data["user_id"] != null) {
            $driver_data = $this->db->query("select * from userdetails where id='" . $data['user_id'] . "'")->row();
            $result['wallet_amount'] = $driver_data->wallet_amount;
            $transactions = $this->db->query("select * from wallet_transaction where user_id='" . $data["user_id"] . "' and status='TXN_SUCCESS'")->result();
        }
        if ($transactions) {
            $result['success'] = true;
            $result['message'] = '';
            foreach ($transactions as $transaction) {
                $result['transactions'][] = array(
                    "wallet_id" => $transaction->wallet_id,
                    "driver_id" => $transaction->driver_id,
                    "cr_dr" => $transaction->cr_dr,
                    "balance" => $transaction->balance,
                    "mid" => $transaction->mid,
                    "txn_id" => $transaction->txn_id,
                    "txn_amount" => $transaction->txn_amount,
                    "payment_mode" => $transaction->payment_mode,
                    "currency" => $transaction->currency,
                    "txn_date" => $transaction->txn_date,
                    "status" => $transaction->status,
                    "respcode" => $transaction->respcode,
                    "respmsg" => $transaction->respmsg,
                    "gateway_name" => $transaction->gateway_name,
                    "bank_txn_id" => $transaction->bank_txn_id,
                    "bank_name" => $transaction->bank_name,
                    "checksumhash" => $transaction->checksumhash,
                    "date_added" => $transaction->date_added,
                    "date_modified" => $transaction->date_modified
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /* Shajeer Callmycab driver app ends here */

    public function payment_success() {
        $json = array();

        $json['success'] = false;
        $json['message'] = 'Invalid request.';
        if (isset($_POST) && count($_POST) > 0) {
            $driver = explode('-', $_POST['ORDERID']);
            $driver_id = $driver[1];
            $insert_data = array(
                'driver_id' => $driver_id,
                'cr_dr' => 1,
                'mid' => $_POST['MID'],
                'txn_id' => $_POST['TXNID'],
                'txn_amount' => $_POST['TXNAMOUNT'],
                'payment_mode' => $_POST['PAYMENTMODE'],
                'currency' => $_POST['CURRENCY'],
                'txn_date' => $_POST['TXNDATE'],
                'status' => $_POST['STATUS'],
                'respcode' => $_POST['RESPCODE'],
                'respmsg' => $_POST['RESPMSG'],
                'gateway_name' => $_POST['GATEWAYNAME'],
                'bank_txn_id' => $_POST['BANKTXNID'],
                'bank_name' => $_POST['BANKNAME'],
                'checksumhash' => $_POST['CHECKSUMHASH'],
                'date_added' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s')
            );
            $this->db->insert('wallet_transaction', $insert_data);

            if ($_POST['STATUS'] == "TXN_SUCCESS") {
                $json['success'] = true;
                $json['message'] = 'Your money added successfully to your wallet..';
                $this->db->query("UPDATE driver_details SET wallet_amount=wallet_amount+'" . $_POST['TXNAMOUNT'] . "' where id='" . $driver_id . "'");
            } else {
                $json['success'] = false;
                $json['message'] = 'Something went wrong! Please try again later.';
            }
        }
        $this->load->view('payment_success', $json);
    }

    public function send_otp_recover_password() {
        $json = array();
        $json['success'] = false;
        $json['message'] = "Something went wrong!!! Please try again later.";
        $otp = rand(1, 999999);


        $message = "This SMS is sent to you by CAB in response to your request to recover your password. Your OTP is " . $otp . ". For help, please contact us on 111 111 1111. ";

        $err = $this->send_otp2($message, $_POST['mobile_no'], $otp);
        if ($err) {
            $json['success'] = false;
            $json['message'] = "Something went wrong!!! Please try again later.";
        } else {

            $json['success'] = true;
            $json['messages'] = $message;
            $json['message'] = "SMS sent to your mobile number.";
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function new_user_send_otp() {
        $json = array();
        $json['success'] = false;
        $json['message'] = "Something went wrong!!! Please try again later.";


        $user_data = $this->db->query("select * from userdetails where mobile='" . $_POST['mobile_no'] . "'")->row();
        if (count($user_data) >= 0) {
            $json['message'] = "Valid mobile number.";
            $otp = rand(1, 999999);
            $message = "This SMS is sent to you by CAB in response to your request for New Account. Your OTP is " . $otp . ". For help, please contact us on 7227 80 10 80. ";
            $err = $this->send_otp2($message, $_POST['mobile_no'], $otp);
            if ($err) {
                $json['success'] = false;
                $json['message'] = "Something went wrong!!! Please try again later.";
            } else {
                $json['success'] = true;
                $json['message'] = "SMS sent to your mobile number.";
            }


            $json['success'] = true;
        } else {
            $json['message'] = "Mobile number already registered.";
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function send_otp2($message, $mobileno, $otp) {
        return true;
        $message = urlencode($message);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return true;
        } else {
            return false;
        }
    }

    public function send_otp() {
        $json['message'] = "Erro para enviar verificação do celular.";
        $json['success'] = true;
        header('Content-Type: application/json');
        echo json_encode($json);
        return true;
        /* $otp =  rand (1,999999);   
          $mobileno = $_POST['mobile_no'];
          $message="Your OTP for Website Booking is :".$otp;
          $json =array();

          $json['success'] = false;
          $json['message'] = "Please enter mobile no.";
          if(isset($_POST['mobile_no']) && $_POST['mobile_no']!=null){

          $json['message'] = "Something went wrong";
          $message = urlencode($message);
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          $json['message'] = "OTP Sent.";
          $json['success'] = true;

          }


          header('Content-Type: application/json');
          echo json_encode($json); */
    }

    public function verify_otp() {
        $json['message'] = "Erro ao enviar código, tente novamente mais tarde.";
        $json['success'] = true;
        header('Content-Type: application/json');
        echo json_encode($json);
        return true;
        /* $otp = $_POST['verify_otp'];
          $curl = curl_init();

          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://control.msg91.com/api/verifyRequestOTP.php?authkey=178868AblxwY3xIzJ59de235a&mobile=91".$_POST['mobile_no']."&otp=".$otp,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded"
          ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
          $json['success'] = false;
          $json['message'] = $err; //"Invalid OTP.";
          } else {
          $response = json_decode($response,true);
          if($response['type'] != 'error') {
          $json['success'] = true;
          $json['message'] = "OTP verified!.";
          } else {
          $json['success'] = false;
          $json['message'] = $response['message'];//"Invalid OTP.";

          }
          }
          header('Content-Type: application/json');
          echo json_encode($json); */
    }

    public function getCartType() {
        $json = array();
        $json['success'] = false;
        $json['message'] = 'Record not found.';
        $json['cartypes'] = array();
        $cartypes = $this->db->query("select *  from car_categories where status ='Active'")->result();
        if (!empty($cartypes) && $cartypes != null) {
            $json['success'] = true;
            $json['message'] = 'Record found successfully.';
            foreach ($cartypes as $cartype) {
                $json['cartypes'][] = array(
                    'car_type_id' => $cartype->id,
                    'name' => $cartype->car_type,
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function cancellation_list() {
        $json = array();
        $json['success'] = false;
        $json['message'] = 'Record not found.';
        $json['data'] = array();
        $cancellation_subject = $this->db->query("select *  from cancellation_subject where status ='1'")->result();
        if (!empty($cancellation_subject) && $cancellation_subject != null) {
            $json['success'] = true;
            $json['message'] = 'Record found successfully.';
            foreach ($cancellation_subject as $row) {
                $json['data'][] = array(
                    'id' => $row->id,
                    'title' => $row->title,
                    'status' => $row->status,
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function driverBookingCancellation() {

        $json = array();
        $json['success'] = false;
        $json['message'] = 'Record not found.';
        $data = json_decode(file_get_contents('php://input'), true);
        ; //$_GET
        $amount = 0;
        $setting = array();
        $setting = $this->db->query("SELECT cancellation_charges FROM `settings` ")->row();

        if ($data['booking_id'] != null && $data['driver_id'] != null && $data['reason'] != null && $data['subject'] != null) {

            $driver_data = $this->db->query("select * from driver_details where id='" . $data['driver_id'] . "'")->row();
            $booking_data = $this->db->query("select * from bookingdetails where id='" . $data['booking_id'] . "'")->row();

            if (!empty($driver_data) && $driver_data->wallet_amount < $setting->cancellation_charges) {

                $json['success'] = false;
                $json['message'] = "Insufficient balance. <br>Please add balanc to your wallet";
            } else {
                $amount = $driver_data->wallet_amount - $setting->cancellation_charges;
                $this->db->query("Update driver_details set wallet_amount='" . $amount . "'  where id='" . $data['driver_id'] . "'");
                $this->db->query("Update driver_login set status='0'  where driver_details_id='" . $data['driver_id'] . "'");
                $history = array(
                    "driver_id" => $data['driver_id'],
                    "booking_id" => $data['booking_id'],
                    "cr_dr" => -1,
                    "Note" => $data['reason'],
                    "date_added" => date("Y-m-d H:i:s"),
                    "date_modified" => date("Y-m-d H:i:s"),
                );
                $this->db->insert("wallet_transaction", $history);
                $booking_cancellation = array(
                    "driver_id" => $data['driver_id'],
                    "booking_id" => $data['booking_id'],
                    "user_id" => 0,
                    'subject' => $data['subject'],
                    "reason" => $data['reason'],
                    "date_added" => date("Y-m-d H:i:s"),
                );

                $this->db->query("Update bookingdetails set status='Cancelled'  where id='" . $data['booking_id'] . "'");
                $this->db->insert("booking_cancellation", $booking_cancellation);

                $user_data = $this->db->query("select * from userdetails where username='" . $booking_data->username . "'")->row();

                $message = "Your booking " . $data['booking_id'] . " has been cancelled by driver. Call us on 111 111 1111 for any help. ";
                $this->sendSmg($message, $user_data->mobile);


                $json['success'] = true;
                $json['message'] = 'Booking cancelled successfully.';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function userBookingCancellation() {

        $json = array();
        $json['success'] = false;
        $json['message'] = 'Record not found.';
        $data = json_decode(file_get_contents('php://input'), true);
        ; //$_GET
        $amount = 0;
        $setting = array();
        $setting = $this->db->query("SELECT cancellation_charges FROM `settings` ")->row();
        if ($data['booking_id'] != null && $data['user_id'] != null && $data['reason'] != null) {

            $booking_data = $this->db->query("select * from bookingdetails where id='" . $data['booking_id'] . "'")->row();

            if (empty($booking_data)) {
                $json['success'] = false;
                $json['message'] = "Booking details not found!";
            } else {
                $this->db->query("Update driver_login set status='0'  where driver_details_id='" . $booking_data->assigned_for . "'");
                $booking_cancellation = array(
                    "user_id" => $data['user_id'],
                    "booking_id" => $data['booking_id'],
                    "driver_id" => 0,
                    'subject' => $data['subject'],
                    "reason" => $data['reason'],
                    "date_added" => date("Y-m-d H:i:s"),
                );
                $this->db->query("Update bookingdetails set status='Cancelled'  where id='" . $data['booking_id'] . "'");
                $this->db->insert("booking_cancellation", $booking_cancellation);

                $message = "Your booking " . $data['booking_id'] . " has been cancelled as per your request. Call us on 111 111 1111 for any help. ";
                $this->sendSmg($message, $data['mobileno']);

                $driver_data = $this->db->query("select * from driver_details where id='" . $booking_data->assigned_for . "'")->row();

                if (isset($driver_data) && $driver_data != null) {
                    $message = "User has cancelled your booking " . $data['booking_id'] . ".";
                    $this->sendSmg($message, $driver_data->phone);
                }
                $json['success'] = true;
                $json['message'] = 'Booking cancelled successfully.';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function sendSmg($message, $mobile) {
        return true;
        $message = urlencode($message);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if (!$err) {
            return false;
        } else {

            return true;
        }
    }

    public function getMindicator() {
        $json = array();
        $json['success'] = false;
        $json['message'] = 'Record not found.';

        $json['data'] = array();

        $result = $this->db->query("SELECT * FROM m_indicator WHERE status='1'")->result();
        //  echo "<pre>"; print_r($result); die();

        foreach ($result as $row) {
            $json['data'][] = array(
                'id' => $row->id,
                'km' => $row->km,
                'car_type' => $row->car_type,
                'charges' => $row->charges,
                'car_name' => $row->car_name,
                'status' => $row->status,
                'date_modified' => $row->date_modified,
                'date_added' => $row->date_added
            );
        }
        //echo "<pre>"; print_r($json); die();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function autoasign() {
        $json['success'] = false;
        $json['message'] = 'Record not found.';
        $i = 0;
        $json['totalUpdated'] = 0;
        $sql = "SELECT * FROM bookingdetails WHERE status='Pending' AND date_added < date_sub(now(), interval 1 minute) ";
        $bookingdetails = $this->db->query($sql)->result();
        if ($bookingdetails != null && !empty($bookingdetails)) {
            foreach ($bookingdetails as $row) {

                $json['totalFound'] = count($bookingdetails);
                $driver_info = array();
                $sql_q = "SELECT *, SQRT(POW(69.1 * (dl.latitude - '" . $row->latitude . "'), 2) + POW(69.1 * ('" . $row->longitude . "' - dl.longitude) * COS(dl.latitude / 57.3), 2)) AS distance FROM driver_details  dd left JOIN driver_login dl on dd.id=dl.driver_details_id where dd.car_type='" . $row->taxi_type . "' and dl.is_online=1 and dl.status=0 HAVING distance < 4 ";
                $driver_info = $this->db->query($sql_q)->row();
                if (!empty($driver_info) && $driver_info != null) {
                    if ($this->db->query("update bookingdetails set assigned_for='" . $driver_info->driver_details_id . "', status='Processing' where id='" . $row->id . "'")) {
                        if ($this->db->query("UPDATE driver_login SET status=1 where driver_details_id='" . $driver_info->driver_details_id . "'")) {

                            $json['totalUpdated'] = $json['totalUpdated'] + 1;
                            ;
                            $json['success'] = true;
                            $json['message'] = 'Record updated successfully.';
                        }
                    }
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function get_userbalance() {
        $json['success'] = false;

        $data = json_decode(file_get_contents('php://input'), true);  //$_GET


        if ($data['driver_id'] != null && $data['driver_id'] != null) {

            $user_data = $this->db->query("select * from driver_details where id='" . $data['driver_id'] . "'")->row();

            if (!empty($user_data) && $user_data != null) {
                $json['balance'] = $user_data->wallet_amount;
                $json['success'] = true;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function alert_subscription() {
        $json = array();
        $json['success'] = false;
        $json['message'] = 'Record not found.';

        $month_end = date('Y-m-d', strtotime('last day of this month', time()));

        $json['driver_info'] = array();

        $subscription_alert = date('Y-m-d', strtotime('-9 days', strtotime($month_end)));

        if (date("Y-m-d") == $subscription_alert) {
            $driver_list = $this->db->query("SELECT * FROM driver_details")->result();

            foreach ($driver_list as $driver) {
                $json['driver_info'][] = array(
                    'phone' => $driver->phone,
                    'name' => $driver->name,
                );
            }

            $json['success'] = true;

            $json['message'] = 'Record  found.';
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function export() {
        $driver = $this->db->query("Select * from driver_details")->result();
        $export = array();
        $export[] = array(
            'Id',
            'Name',
            'Username',
            'Password',
            'MobileNo',
            'Email',
            'Vehicle Number',
            'License Number',
            'Vehicle Rc Number',
            'Vehicle Insurance Number',
            'Car Type',
        );
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=cabservices" . time() . ".csv");
        header("Content-Transfer-Encoding: binary");

        $df = fopen("php://output", 'w');
        /* 	array_walk($driver, function($row) use ($df) {
          fputcsv($df, $row);
          }); */

        $i = 1;
        foreach ($driver as $row) {


            $export[] = array(
                'id' => $i,
                'name' => $row->name,
                'username' => $row->username,
                'password' => $row->password,
                'phone' => $row->phone,
                'email' => $row->email,
                'car_no' => $row->car_no,
                'license_no' => $row->license_no,
                'permit_no' => $row->permit_no,
                'insurance_no' => $row->insurance_no,
                'cartype' => $row->car_type,
            );
            $i++;
        }

        array_walk($export, function($rows) use ($df) {
            fputcsv($df, $rows);
        });
        fclose($df);
    }

    public function userResetPassword() {
        $json['message'] = "Something went wrog!!! Please try again later.";
        $json['success'] = false;

        //$data = json_decode(file_get_contents('php://input'), true);  //$_GET


        if ($_GET['user_id'] != null && $_GET['password'] != null) {

            $this->db->query("UPDATE userdetails SET password='" . md5($_GET['password']) . "' where id='" . $_GET['user_id'] . "'");

            $json['message'] = "Password reseted successfully.";
            $json['success'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function driverResetPassword() {
        $json['message'] = "Something went wrog!!! Please try again later.";
        $json['success'] = false;

        if ($_GET['driver_id'] != null && $_GET['password'] != null) {

            $this->db->query("UPDATE driver_details SET password='" . $_GET['password'] . "' where id='" . $_GET['driver_id'] . "'");

            $json['message'] = "Password reseted successfully.";
            $json['success'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function checkUserExists() {
        $json['message'] = "Mobile number does not exists.";
        $json['success'] = false;

        $data = json_decode(file_get_contents('php://input'), true);  //$_GET

        $user_data = $this->db->query("select * from userdetails where mobile='" . $data['mobile'] . "'")->row();
        if (count($user_data) > 0) {
            $json['user_id'] = $user_data->id;
            $json['message'] = "Valid mobile number.";
            $json['success'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function checkDriverExists() {
        $json['message'] = "Mobile number does not exists.";
        $json['success'] = false;

        $data = json_decode(file_get_contents('php://input'), true);  //$_GET

        $user_data = $this->db->query("select * from driver_details where phone='" . $data['mobile'] . "'")->row();
        if (count($user_data) > 0) {
            $json['driver_id'] = $user_data->id;
            $json['message'] = "Valid mobile number.";
            $json['success'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function feedback() {
        $json = array();
        $json['message'] = "Something went wrong! Please try again later.";
        $json['success'] = false;

        $data = json_decode(file_get_contents('php://input'), true);  //$_GET

        $from = 'parin@gnhub.com';
        $to = 'parin@gnhub.com';
        $sub = 'Feddback from Cab Service';
        $name = 'Cab Service';
        $msg = '';
        $msg = "Email: " . $data['your_email'] . "\n";
        $msg .= "Message: " . $data['message'] . "\n";
        $res_mail = $this->Model_cab->send_mail($from, $to, $name, $sub, $msg);
        if ($res_mail) {
            $json['message'] = "Your feedback submitted successfully. We will contact you soon.";
            $json['success'] = true;
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    function send_mail($from, $to, $name, $sub, $msg) {

        //$data = '{"name":"Adarsh","email":"adarsh.techware@gmail.com","message" :"Hi Team"}';
        //$data = json_decode($data);
        $this->db->order_by("id", "desc");
        $row = $this->db->get('settings')->row();
        $this->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $row->smtp_host, //'',
            'smtp_port' => 587,
            'smtp_user' => $row->smtp_username, //'', // change it to yours
            'smtp_pass' => $row->smtp_password, //'', // change it to yours
            'smtp_timeout' => 20,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->email->initialize($config); // add this line

        $subject = $sub;
        //$mailTemplate=$data->message;
        //$this->email->set_newline("\r\n");
        $this->email->from($row->smtp_username, $name);
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);
        if ($this->email->send()) {

            return "success";
        } else {
            return 1;
        }
    }

    public function getDocumentsByDriver() {
        $json = array();
        $json['message'] = "No ducuments uploaded yet.";
        $json['success'] = false;
        $json['driver_id'] = $_GET['driver_id'];

        $data = json_decode(file_get_contents('php://input'), true);  //$_GET

        $user_data = $this->db->query("select * from driver_document where driver_id='" . $_GET['driver_id'] . "'")->result_array();
        if (count($user_data) > 0) {
            foreach ($user_data as $document) {
                $json['data'][] = array(
                    'driver_document_id' => $document['driver_document_id'],
                    'driver_id' => $document['driver_id'],
                    'admin_id' => $document['admin_id'],
                    'document_type' => $document['document_type'],
                    'document_code' => $document['document_code'],
                    'document_image' => base_url() . 'assets/documents/' . $document['document_image'],
                    'is_verified' => $document['is_verified'],
                    'rejected_reason' => $document['rejected_reason'],
                    'date_modified' => $document['date_modified'],
                    'date_added' => $document['date_added']
                );
            }
            //$json['data'] = $user_data;
            $json['message'] = "";
            $json['success'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function uploadDocuments() {

        $data = json_decode(file_get_contents('php://input'), true);  //$_GET
        $images = array();
        foreach ($_POST as $key => $post_data) {
            if ($key != 'driver_id') {
                $images[] = $_POST[$key];
                $img_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);

                $image = preg_replace('#^data:image/\w+;base64,#i', '', $_POST[$key]);
                $image = str_replace(' ', '+', $image);
                $image = base64_decode($image);
                $name = "img-" . $img_string . ".png";
                $result['image_name'] = $name;
                file_put_contents('assets/documents/' . $name, $image);
                if ($key == 'licence') {
                    $document_type = 'Licence';
                } else if ($key == 'rc_book') {
                    $document_type = 'Rc Book';
                } else if ($key == 'cab_insurance') {
                    $document_type = 'Cab Insurance';
                } else if ($key == 'puc') {
                    $document_type = 'PUC';
                } else if ($key == 'cab_permit') {
                    $document_type = 'Cab Permit';
                } else if ($key == 'fitness_certificate') {
                    $document_type = 'Fitness Certificate';
                } else if ($key == 'owner_aadhar_card') {
                    $document_type = 'Owner Aadhar Card';
                } else if ($key == 'driver_photo') {
                    $document_type = 'Driver Photo';
                } else if ($key == 'driver_pcc') {
                    $document_type = 'Driver PCC';
                } else if ($key == 'bank_details') {
                    $document_type = 'Bank Details';
                }
                $this->db->query("delete from driver_document where document_code='" . $key . "'");
                $insert_data = array(
                    'driver_id' => $_POST['driver_id'],
                    'document_type' => $document_type,
                    'document_code' => $key,
                    'document_image' => $result['image_name'],
                    'is_verified' => 0,
                    'rejected_reason' => '',
                    'date_added' => date('Y-m-d H:i:s')
                );
                $this->db->insert('driver_document', $insert_data);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($images);
        return;
        /* $img_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);

          $image = preg_replace('#^data:image/\w+;base64,#i', '', $data['user_photo']);
          $image = str_replace(' ', '+', $image);
          $image = base64_decode($image);
          $name = "img-".$img_string.".png";
          $result['image_name'] = $name;
          file_put_contents('images/user/'. $name, $image); */
    }

    public function driverStatusChange() {

        $data = json_decode(file_get_contents('php://input'), true);  //$_GET
        $result = array();
        $this->db->query("update driver_login SET is_online='" . $data['status'] . "', status='" . $data['status'] . "' where driver_details_id='" . $_GET['driver_id'] . "'");
        $result['success'] = true;
        $result['success2'] = $data;
        $result['message'] = "Status alterado com sucesso";
        header('Content-Type: application/json');
        echo json_encode($result);
    }

}
