<?php

class model_web_service extends CI_Model{
	function __construct() {
	parent::__construct();
}

	function login($request){
		
		
		$table = 'ci_admin';	
		$select_data = "*";
	
		$this->db->select($select_data);
		$this->db->where("(email = '$request->Email' OR username = '$request->Email' )");     
               $this->db->where('Password', md5($request->Password));
	
//		$this->db->where('password', $request->Password);
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	
		if(count($result) > 0){ // user credential is success 
		
			return $result[0];
		
		}
		else{ // user credential failed
			return false;
		}  
	
	}
	function update_device_id($device_id, $user_id){
		$table = 'userdetails';	
		
		$update_data = array(
			'device_id'     => $device_id
		);
		
		$where_data = array(
			'id'            => $user_id,
		);
		
		$this->update_table_where( $update_data, $where_data, $table);
	}
	function authenticate_key($request){
		$table = 'ci_general_settings';	
		$select_data = "serv_secret_key";
	
		$this->db->select($select_data);
		$this->db->where( 'serv_secret_key', $request->secret_key );
    
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	
		if(count($result) > 0){ // user credential is success 
		
			return true;
		
		}
		else{ // user credential failed
			return false;
		}  
	
	}
	
	function social_login(  $request ){
		
		$table = 'ci_admin';	
		$select_data = "*";
	
		$this->db->select($select_data);
		$this->db->where("(email = '$request->Email' OR username = '$request->Email' OR mobile = '$request->Email' )");
    
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	
		if(count($result) > 0){ // user credential is success 
		
			return $result[0];
		
		}
		else{ // user credential failed
			return false;
		}  
	
	}
	
	function fetch_cabs($request){
		
		$table = 'cabdetails';	
		$select_data = "*";
		$this->db->select($select_data);
	        $this->db->where('transfertype', $request->transfertype);
		$this->db->where('timetype', $request->timetype);
           	$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	
		return $result;
		
	}
	function load_trips($request){
		
		$table = 'bookingdetails';	
		$select_data = "id,uneaque_id ,purpose, pickup_area, pickup_date, drop_area, pickup_time, taxi_type, status,distance,amount,item_status,km,timetype,assigned_for,paid_amount,is_paid_advance, (amount -paid_amount) AS due_amount";
	
		$this->db->select($select_data);
		
		$this->db->where('username', $request->token);
		$this->db->order_by("id","desc");
		
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	
		return $result;
		
	}
	function load_all_cabs($request){
		
		$table = 'cabdetails';	
		$select_data = "*";
	
		$this->db->select($select_data);
		
		$this->db->where('transfertype', $request->transfertype );
		
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	
		return $result;
		
	}
	
	function load_settings(){
		
		$table = 'settings';	
		$select_data = "country,places";
	
		$this->db->select($select_data);
		
		$this->db->where('id', 1 );
		
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	
		return $result;
		
	}
	
	function update_pwd($request){
		
		$table = 'userdetails';	
		
		$update_data = array(
			'password'     => md5($request->Password )
		);
		
		$where_data = array(
			'username'            => $request->token,
		);
		
		$this->update_table_where( $update_data, $where_data, $table);
		
	}
	
	
	
	function is_mail_exists($mail){ 
		/* function return
		 ---------------------------------	 
		 'true'   if user exist
		 'false'  if user does not exist
		
		*/
		
		$select_data = "*"; 
		
		$where_data = array(	// ----------------Array for check data exist ot not
			'email'     => $mail
		);
		
		$table = "userdetails";  //------------ Select table
		$result = $this->get_table_where( $select_data, $where_data, $table );
		
		if( count($result) > 0 ){ // check if user exist or not
			
			return true;
		}
		
		return false;
	 }
   
	 function is_username_exists($user_name){ 
			/* function return
			 ---------------------------------	 
			 'true'   if user exist
			 'false'  if user does not exist
			 
			*/
			
			$select_data = "*"; 
			
			$where_data = array(	// ----------------Array for check data exist ot not
				'username'     => $user_name
			);
			
			$table = "userdetails";  //------------ Select table
			$result = $this->get_table_where( $select_data, $where_data, $table );
			
			if( count($result) > 0 ){ // check if user exist or not
				
				return true;
			}
			
			return false;
	 }
   function is_mobile_exists($mobile){ 
			/* function return
			 ---------------------------------	 
			 'true'   if mobile exist
			 'false'  if mobile does not exist
			 
			*/
			
			$select_data = "*"; 
			
			$where_data = array(	// ----------------Array for check data exist ot not
				'mobile'     => $mobile
			);
			
			$table = "userdetails";  //------------ Select table
			$result = $this->get_table_where( $select_data, $where_data, $table );
			
			if( count($result) > 0 ){ // check if user exist or not
				
				return true;
			}
			
			return false;
	 }
   
   function insert_user_details( $request ){
	
			$table = 'userdetails';
			$insert_data = array(
				'username'	  => $request->User_name,
				'mobile'	    => $request->Mobile,
				'email'	      => $request->Email,
				'password'	  => md5 ($request->Password),
				'user_status'	=> "Active",
//				'device_id'	=> $request->device_id,
			);
			
			$this->insert_table($insert_data, $table);
			
										
	 }
   function insert_user_social( $request ){
	
			$table = 'userdetails';
			$insert_data = array(
				'username'	  => $request->Email,
				'user_status'	=> "Active",
				
			);
			
			$this->insert_table($insert_data, $table);
			
										
	 }
   
	 function book_origin( $request ){
	
		  $table = 'bookingdetails';
			
			$insert_data = array(
				'username'	  => $request->token,
				'uneaque_id'	=> $request->uneaque_id,
				'purpose'   	=> "Point to Point Transfer",
				'pickup_date' => $request->book_date,
				'pickup_time' => $request->pickup_time,
				'drop_area'  	=> $request->drop_area,
				'pickup_area' => $request->pickup_area,
				'taxi_type'   => $request->taxi_type,
				'status'		=> "Booking",
				'item_status' => "Completed",
				'assigned_for' => 0,
				'timetype'		=> $request->timetype,
				'amount'		  => $request->amount,
				'km'		=> $request->km
			);
			
			$this->insert_table($insert_data, $table);
			
			$finresult = array( 'status'  => 'success','message' => 'Successfully registered',
											'code'    => 'registered' 
										);
			print json_encode($finresult);								
	 }
    function book($data) { 
        $json = array();
        $data->username=$data->user_name;
		
            /*$sql = "SELECT *, SQRT(POW(69.1 * (dl.latitude - '".$data->pickup_lat."'), 2) + POW(69.1 * ('".$data->pickup_lng."' - dl.longitude) * COS(dl.latitude / 57.3), 2)) AS distance FROM driver_details  dd left JOIN driver_login dl on dd.id=dl.driver_details_id where dd.car_type='". $data->taxi_type."' and dd.wallet_amount >0 and dl.is_online=1 and dl.status=0 HAVING distance < 4 ";
            $results = $this->db->query($sql);
            
            $result_data = $results->row();
            if(!$result_data) {
            $json['success'] = false;
            $json['message'] = "Driver not available.";
            return $json; 
            }*/
            //$query = $this->db->query('SELECT * FROM driver_details dd left JOIN driver_login dl on dd.id=dl.driver_details_id where dl.is_online=1 and status = 0 LIMIT 1');
            //$result_data = $query->row();
            //$data->taxi_type = $result_data->car_type;
            //
            //return $result_data->driver_details_id;
		$current_time = date('H:i a'); //$data_post['shift'];
		$day = "6:00 AM";
		$night = "10:00 PM";
		$date1 = DateTime::createFromFormat('H:i a', $current_time);
		$date2 = DateTime::createFromFormat('H:i a', $day);
		$date3 = DateTime::createFromFormat('H:i a', $night);
		if ($date1 > $date2 && $date1 < $date3)
		{
			$timetype='night';
		}else{
		  $timetype='day';
		}
			/*$this->db->select('*');
			$this->db->from('cabdetails a'); 
			$this->db->where('a.transfertype', $data->transfertype);
			$this->db->where('a.timetype', $timetype);
			$this->db->join('car_categories c', "c.car_type=a.cartype AND c.status = 'Active' and c.id='".$result_data->car_type_id."'");
			
			$car_query = $this->db->get();
			$results_for_car = $car_query->row(); 
			
			$fetch_car_rate=$this->fetch_distance($data);
			//
			  if($fetch_car_rate['distance'] > $results_for_car->intialkm)
			  {
				$val=$fetch_car_rate['distance'] -$results_for_car->intialkm;
				$data['amount']= $val*$results_for_car->standardrate;
				$data['distance']=$fetch_car_rate['distance'];
			 }
			 else {
				 
			   $data['amount'] = $results_for_car->standardrate;
			   $data['distance']= $fetch_car_rate['distance'];
			  // $fetch_cars[$key]['total_rate']='120';
			   // $fetch_cars[$key]['total_dist']='12';
			 }*/
			
		 //
		 
        $data->pickup_date = $data->book_date;
        $data->amount = $data->amount;
        $data->distance= $data->km;
        $data->km= $data->km.'Km';
        //$data->total_rate = $results_for_car->total_rate;
        $data->assigned_for = 0; //$result_data->id; //$this->assigned_for($result_data->car_type,$result_data->latitude,$result_data->longitude);
        
        //$data->item_status='Completed';
        //$data->status='Booking';
        
        $data->item_status='Pending';
        $data->status='Missing';
        
        $data->purpose = $data->transfertype; 
        $mobileno = $data->mobileno;
        unset($data->book_date);
        unset( $data->mobileno); 
	  
        $data->promo_code = '';//$data['promo_status_point']=='1'? $data['point_promo']:'';

 
	    $data_arr = array();
	
	    foreach($data as $k=>$d) {
	        if($k=='transfertype') {
	            $k = 'purpose';
	        }
            $data_arr[$k] = $d;
	    }  
	    unset($data_arr['token']);
	    unset($data_arr['user_name']); 
	
        $lat =  $data_arr['pickup_lat'];
        $lng =  $data_arr['pickup_lng'];
	    $data_arr['latitude']      =   $data_arr['pickup_lat'];
	    $data_arr['longitude']     =   $data_arr['pickup_lng'];
    
        unset($data_arr['pickup_lat']);
	    unset($data_arr['pickup_lng']);
	    $data_arr['date_added']    =   date("Y-m-d H:i:s");
		
		$d =   $this->db->insert('bookingdetails',$data_arr);
		$last_id = $this->db->insert_id();

		if($last_id) {
		   // $this->db->query("UPDATE driver_login SET status=1 where driver_details_id='".$result_data->driver_details_id."'");
		    //return $last_id;
		    $select_cabdetails  = $this->db->query("select * from cabdetails where cartype='".$data->taxi_type."'")->result_array();
		    if(isset($select_cabdetails) && $select_cabdetails!=null){
		        $message = "Thank you for booking Cabs. Driver will be assign you soon. Base Fare:Rs.". $data->amount." For Extra KM : Rs. ".$select_cabdetails[0]['standardrate']."\Km.  We look forward to having you onboard! Call us on 111 111 1111 for any help. ";
		    }
		    if($mobileno && $message){
		       // $this->msg($message,$mobileno);
		    }
		   
            
            $json['pay_online_amount'] = ($data->amount * 0.15); 
            $json['pay_online'] = true;
            $json['taxi_type']  = $data->taxi_type;
            $json['amount']     = $data->amount;
            $json['success']    = true;
            $json['trip_id']    = $last_id;
            $json['data']       = $data_arr;
            $json['message']    = "Trip booked successfully.";
            return $json;
	    } else {
	        $json['success']    = false;
            $json['data']       = $data_arr;
            $json['message']    = "Something went wrong! Please try again later.";
            return $json;
	    }
	 }
	 public function update_payment_status($data = array()){
	    $json =array();
	     
	    $json['success']    = false;
        $json['message']    = "Something went wrong! Please try again later.";
        
        if($data){ 
            $this->db->query("update bookingdetails set item_status='Completed' ,status='Booking', is_paid_advance='1',paid_amount='".round($data->paid_amount)."' where id='".round($data->trip_id)."'");
        
            $select_cabdetails  = $this->db->query("select * from cabdetails where cartype='".$data->taxi_type."'")->result_array();
		   
		    $message = "Thank you for booking Cabs. Driver will be assign you soon.";
		    
		    if(isset($select_cabdetails) && $select_cabdetails!=null){
		        $message = "Thank you for booking Cabs. Driver will be assign you soon. Base Fare:Rs.". $data->amount." For Extra KM : Rs. ".$select_cabdetails[0]['standardrate']."\Km.  We look forward to having you onboard! Call us on 111 111 1111 for any help. ";
		    }
		    
		    if($data->mobileno && $message){
		        $this->msg($message,$data->mobileno);
		    }
		    $json['success']    = true;
            $json['message']    = "Trip booked successfully.";
        } 
        return $json;
	 }
	   
   	//message
   	public function msg($message,$mobile_no){
            /*$message = urlencode($message);
            
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
              return  false; 
            }*/
            return true;
   	}
 
 /* ------------------- COMMON --------------------------------------------------------
 ******************************************************************************************/

/*  WHETHER TABLE EXIST A DATA
===================================================*/
 function is_exists( $data, $table )
 {
	$this->db->where( $data );
	$query = $this->db->get($table);
	
	if ($query->num_rows() > 0){
		return true;
	}
	else{
		return false;
	}
 }

/*	INSERT INTO TABLE 
 *=========================================================================*/
	function insert_table( $insert_data, $table ){	
		$this->db->insert($table, $insert_data);
	}	

/* GET FROM TABLE 
 *=====================================*/
 
   function get_table_where( $select_data, $where_data, $table){
  
		$this->db->select($select_data);
		$this->db->where($where_data);
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
		return $result;	
   }	
/* GET WHERE IN*/   
 function get_table_where_in_Q( $select_data, $where_data, $table){
  
		$this->db->select($select_data);
		$this->db->where_in('Q_id',$where_data);
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
		return $result;	
   }	
/* GET FROM TABLE OR WHERE
*=====================================*/
	
   function get_table_or_where( $select_data, $where_data,$or_where_data, $table ){
  
		$this->db->select($select_data);
		$this->db->where($where_data);
		$this->db->or_where($or_where_data);
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
		return $result;	
   }	
   
/* UPDATE TABLE
===================================*/	
 function update_table_where( $update_data, $where_data, $table){	
	$this->db->where($where_data);
	$this->db->update($table, $update_data);
	
	
 }
 
/* JOIN TABLE
=======================*/
function get_table_join($select_data, $table, $join_table, $join_data, $join_type, $where_data){
	
	$this->db->select($select_data);
	$this->db->from($table);
	$this->db->join($join_table, $join_data, $join_type);
	$this->db->where($where_data);
	$this->db->order_by("sub1_id","asc");
	
	$query = $this->db->get();
	$result = $query->result_array(); 
	return $result;	
}

function delete_roles( $id ){
	
	$table = 'user_role';
	$where_data = array( 'User_Id' => $id );
	
	$this->delete_table($table, $where_data);
}
function delete_instituts( $id ){
	
	$table = 'users_institutions';
	$where_data = array( 'User_Id' => $id );
	
	$this->delete_table($table, $where_data);
} 
function delete_table($table, $where_data){
	$this->db->delete($table, $where_data); 
} 
 
 /* Arun common */
 /*	INSERT INTO TABLE with Return
 *=========================================================================*/
	function insert_table_r( $insert_data, $table ){	
		return $this->db->insert($table, $insert_data);
	}
	
	/*Web services for call my cab driver App ****Edited by shajeer*/
function driver_login($request)
{
       $table = 'driver_details';	
		$select_data = "*";
	
		$this->db->select($select_data);
		$this->db->where("(user_name = '$request->Email' )");
		$this->db->where('password', $request->Password);
		$query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
	 
		if(count($result) > 0){ // user credential is success 
		
			return $result[0];
		
		}
		else{ // user credential failed
			return false;
		}  
}
    function driver_sign_up_model($request)
    {   
        
        
         $table='driver_details';
        	$insert_data = array(
				'user_name'	  => $request->User_name,
				'phone'	      => $request->Mobile,
				//'email'	      => ((isset($request->Email) && $request->Email!=null) ? $request->Email : ''),
				'password'	  => $request->Password,
                'name'        => $request->Name,
                'car_no'      => $request->car_no,
                'car_type_id' => '1',
                'car_type'    =>  $request->car_type,
                'permit_no'       => $request->permit_no,
                'insurance_no'=> $request->insurance_no,
                'license_no'  => $request->license_no
			);
			
			
      
			
			//$message = "Welcome To Paschim Maharashtra Union Cab [Driver] application. You have to recharge monthly '121-RS' into Paytm Wallet for used this application. Otherwise you don't visible to user. for more detail contact http://cab.servsme.in";
		    $message = "Welcome To Paschim Maharashtra Union Cab [Driver] application for more detail contact administrator.";
            if($done = $this->db->insert($table, $insert_data))	{
                $driver_id = $this->db->insert_id();
                
                if(isset($request->licence) && $request->rc_book!=null) 
                    
                    //licence
                    $img_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        	   	   	$image = preg_replace('#^data:image/\w+;base64,#i', '', $request->licence);
                    $image = str_replace(' ', '+', $image);
                    $image = base64_decode($image);
                    $name = "img-".$img_string.".png";
                    $license = $name;
                    file_put_contents('assets/documents/'. $name, $image);
                    //rc book
                     $img_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        	   	  
                    $image = preg_replace('#^data:image/\w+;base64,#i', '', $request->rc_book);
                    $image = str_replace(' ', '+', $image);
                    $image = base64_decode($image);
                    $name = "img-".$img_string.".png";
                    $rc_book = $name;
                    file_put_contents('assets/documents/'. $name, $image);
                    $insert_data=array(
                        array(
                            'driver_id'         =>  $driver_id,
                            'document_type'     =>  "Licence",
                            'document_code'     =>  "licence",
                            'document_image'    =>  $license,
                            'is_verified'       =>  0,
                            'rejected_reason'   => '',
                            'date_added' => date('Y-m-d H:i:s')
                        ),
                        array(
                            'driver_id'         =>  $driver_id,
                            'document_type'     =>  "Rc Book",
                            'document_code'     =>  "rc_book",
                            'document_image'    =>  $rc_book,
                            'is_verified'       =>  0,
                            'rejected_reason'   => '',
                            'date_added' => date('Y-m-d H:i:s')
                        )
                    ); 
            		$this->db->insert_batch('driver_document',$insert_data);
                
                return  $done; 
                /*if(isset( $request->Mobile) &&  $request->Mobile!=null){
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
            			  return  $done; 
            			}
            	}*/
            }else{
                return  false;  
            }	
		//  return $this->db->insert($table, $insert_data);
    }
    function driver_id_exist($user_name)
    {
        $table='driver_details';
        $select_data = "*";
        
        $this->db->select($select_data);
        $this->db->where("(user_name = '$user_name' )");
        $query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
        
        /*$this->db->select($select_data);
        $this->db->where("(user_name = '$email' )");
        $query  = $this->db->get($table);  //--- Table name = User
		$result2 = $query->result_array(); */
        
        if(count($result) > 0 ){
          return 0;  //already exist
        }
        else
        {
            return 1; //Not exist
        }
    }
   /* function driver_id_exist($email,$user_name)
    {
        $table='driver_details';
        $select_data = "*";
        
        $this->db->select($select_data);
        $this->db->where("(user_name = '$user_name' )");
        $query  = $this->db->get($table);  //--- Table name = User
		$result = $query->result_array(); 
        
        $this->db->select($select_data);
        $this->db->where("(user_name = '$email' )");
        $query  = $this->db->get($table);  //--- Table name = User
		$result2 = $query->result_array(); 
        
        if(count($result) > 0 || count($result2) > 0 ){
          return 0;  //already exist
        }
        else
        {
            return 1; //Not exist
        }
    }*/
    
    function driver_bookings($request)
    {
        $table = 'bookingdetails';	
		$select_data = "*";
	
		/*$this->db->select($select_data);
		//$this->db->where("(assigned_for = '$request->driver_id' )");
		$this->db->where('assigned_for', $request->driver_id);
        $this->db->order_by("pickup_date","asc");
		$query  = $this->db->get($table);  //--- Table name = User*/
		$query = $this->db->query("select    bookingdetails.*,(bookingdetails.amount -bookingdetails.paid_amount) AS due_amount , ud.mobile as user_mobile_no from bookingdetails LEFT JOIN userdetails ud ON ud.username = bookingdetails.username where assigned_for='".$request->driver_id."' order by pickup_date ASC");
		$result = $query->result_array(); 
	    
        return $result;
      
		
    }
    
    function update_driver_password($request){
		
		$table = 'driver_details';	

		$select_data = "*";
	
		$this->db->select($select_data);
		$this->db->where("(user_name = '$request->username' )");
		$this->db->where('password', $request->old_pass);
		$query  = $this->db->get($table);  
		$result = $query->result_array(); 
	
		if(count($result) > 0){ // user credential is success 
		
			     $update_data = array(
			            'password'     => $request->Password
		               );
		
		         $where_data = array(
			      'user_name'            => $request->username,
		              );
		
		          $this->update_table_where( $update_data, $where_data, $table);
                           return 1;
		
		}
		else{ 
			return 0;
		}  
	
	}
/*Callmycab driver app webservice ends here */

}//--------------- END Class
?> 