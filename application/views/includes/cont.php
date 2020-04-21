<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
        parent::__construct();

       		$this->load->helper('url');
       		$this->load->model('Dashboard_model');
       		$this->load->model('User_track_model');
       		$this->load->library('session');
       		$this->load->library('pdf');


    }






    public function tool_box()
    {
        $notification_list = $this->Dashboard_model->getnNotifications();
        $toolboxs = $this->Dashboard_model->gettoolbox();

        $send_data = array(

            "notifications" => $notification_list,
            "toolboxs" => $toolboxs
        );
        //$data['home_view']= $this->load->view('Dashboard/notification',$send_data,true);
        
        $data['home_view']=$this->load->view('Dashboard/toolbox',$send_data,true);
        $this->load->view('Dashboard/main_template',$data);
    }





    public function add_income(){
        if($_POST){
            $date = $this->input->post('date');
            $date = date("Y-m-d", strtotime($date));
            $details = $this->input->post('details');
            $amount = $this->input->post('amount');
            $others = $this->input->post('others');

            $insert_array = array(
                "date" => $date,
                "details" => $details,
                "amount" => $amount,
                "others" =>  $others
            );
            $this->db->insert('income',$insert_array);
            redirect('dashboard/income_list');
        }
        $data['home_view']= $this->load->view('Dashboard/income_form',array(),true);
        $this->load->view('Dashboard/main_template',$data);

    }

    public function add_expense(){
        if($_POST){
            $date = $this->input->post('date');
            $date = date("Y-m-d", strtotime($date));
            $details = $this->input->post('details');
            $amount = $this->input->post('amount');
            $others = $this->input->post('others');

            $insert_array = array(
                "date" => $date,
                "details" => $details,
                "amount" => $amount,
                "others" =>  $others
            );
            $this->db->insert('expense',$insert_array);
            redirect('dashboard/expense_list');
        }
        $data['home_view']= $this->load->view('Dashboard/expense_form',array(),true);
        $this->load->view('Dashboard/main_template',$data);
    }

    public function income_list(){

        $this->db->select('*');
        $this->db->from('income');
        $this->db->order_by('id', 'Desc');
        $p_h = $this->db->get();
         
        $result = $p_h->result_array();
        $send_data = array(
            "income_list" => $result
        );

        $data['home_view']= $this->load->view('Dashboard/income_list',$send_data,true);
        $this->load->view('Dashboard/main_template',$data);

    }

    public function expense_list(){
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->order_by('id', 'Desc');
        $p_h = $this->db->get();
         
        $result = $p_h->result_array();
        $send_data = array(
            "expense_list" => $result
        );

        $data['home_view']= $this->load->view('Dashboard/expense_list',$send_data,true);
        $this->load->view('Dashboard/main_template',$data);

    }

    public function add_monthly_place(){
        if($_POST){
            $name = $this->input->post('name');
            $location = $this->input->post('location');
            $customer_mobile = $this->input->post('customer_mobile');
            $space = $this->input->post('space');
            $price = $this->input->post('price');
            $time = $this->input->post('time');

            $insert_array = array(
                "name" => $name,
                "location" => $location,
                "customer_mobile" => $customer_mobile,
                "our_mobile" =>  "01788584258",
                "space" =>$space,
                "price"=>$price,
                "time" =>$time 
            );
            $this->db->insert('tbl_monthly_places',$insert_array);
            redirect('dashboard/monthly_place_list');
        }
        $data['home_view']= $this->load->view('Dashboard/monthly_place_add_form',array(),true);
        $this->load->view('Dashboard/main_template',$data);
    }


    public function approve_monthly_place($id){

        $data = array(
                "status" => 1
                );

        $this->db->where('id', $id);
        $this->db->update('tbl_monthly_places', $data);
        redirect("dashboard/monthly_place_list");
    }

    public function disapprove_monthly_place($id){

        $data = array(
                "status" => 0
                );
        
        $this->db->where('id', $id);
        $this->db->update('tbl_monthly_places', $data);
        redirect("dashboard/monthly_place_list");
    }

    public function delete_monthly_place($id){
        $data = array(
                    'id' =>$id,
                );

        $this->db->delete('tbl_monthly_places', $data);
        redirect('dashboard/monthly_place_list');
    }

    public function searchParkingCount(){
    	if($_POST){
    		$start_date = $this->input->post("start");
    		$end_date = $this->input->post("end");

    		$start_date = date("Y-m-d", strtotime($start_date));
    		$end_date = date("Y-m-d", strtotime($end_date));


    		$sql = "SELECT count('id') as total_user FROM `users` WHERE time >= '$start_date' AND time <= '$end_date'";

    		$total_user = $this->db->query($sql);
	        $total_user = $total_user->result_array();

    		echo json_encode($total_user);
    	}
    }

    public function monthly_place_list(){
        $sql = "SELECT * FROM  tbl_monthly_places ORDER BY id DESC";

        $monthly_places = $this->db->query($sql);
        $monthly_places = $monthly_places->result_array();

        $send_data = array(
            "monthly_places" => $monthly_places
        );

        $data['home_view'] = $this->load->view('Dashboard/monthly_place_list',$send_data,true);
        $this->load->view('Dashboard/main_template',$data);
    }


    public function add_sanmar_parking(){

    	$insert_data[0]["user_id"] = "018139523350";
    	$insert_data[0]["user_name"] ="Tarek"; 
    	$insert_data[0]["place_id"] = 8;
    	$insert_data[0]["place_name"] = "Sanmar Ocean City";
    	$insert_data[0]["date"] = date("Y-m-d");
    	$insert_data[0]["start_time"] = "600";
    	$insert_data[0]["end_time"] = "1200";
    	$insert_data[0]["valid"] =0;
    	$insert_data[0]["car_no"] ="160075";
    	$insert_data[0]["type"] ="Bike";
    	$insert_data[0]["price"] =0;
    	$insert_data[0]["discount"] =0;

    	$insert_data[1]["user_id"] = "01873899818";
    	$insert_data[1]["user_name"] ="Ariful Alam"; 
    	$insert_data[1]["place_id"] = 8;
    	$insert_data[1]["place_name"] = "Sanmar Ocean City";
    	$insert_data[1]["date"] = date("Y-m-d");
    	$insert_data[1]["start_time"] = "600";
    	$insert_data[1]["end_time"] = "1200";
    	$insert_data[1]["valid"] =0;
    	$insert_data[1]["car_no"] ="170468";
    	$insert_data[1]["type"] ="Bike";
    	$insert_data[1]["price"] =0;
    	$insert_data[1]["discount"] =0;

    	$insert_data[2]["user_id"] = "01843975513";
    	$insert_data[2]["user_name"] ="Kazi Asif"; 
    	$insert_data[2]["place_id"] = 8;
    	$insert_data[2]["place_name"] = "Sanmar Ocean City";
    	$insert_data[2]["date"] = date("Y-m-d");
    	$insert_data[2]["start_time"] = "600";
    	$insert_data[2]["end_time"] = "1200";
    	$insert_data[2]["valid"] =0;
    	$insert_data[2]["car_no"] ="000000";
    	$insert_data[2]["type"] ="Bike";
    	$insert_data[2]["price"] =0;
    	$insert_data[2]["discount"] =0;

    	$insert_data[3]["user_id"] = "018407474749";
    	$insert_data[3]["user_name"] ="MD.Abdul Mabud"; 
    	$insert_data[3]["place_id"] = 8;
    	$insert_data[3]["place_name"] = "Sanmar Ocean City";
    	$insert_data[3]["date"] = date("Y-m-d");
    	$insert_data[3]["start_time"] = "600";
    	$insert_data[3]["end_time"] = "1200";
    	$insert_data[3]["valid"] =0;
    	$insert_data[3]["car_no"] ="158811";
    	$insert_data[3]["type"] ="Bike";
    	$insert_data[3]["price"] =0;
    	$insert_data[3]["discount"] =0;

    	$insert_data[4]["user_id"] = "018407474749";
    	$insert_data[4]["user_name"] ="MD.Abdul Mabud"; 
    	$insert_data[4]["place_id"] = 8;
    	$insert_data[4]["place_name"] = "Sanmar Ocean City";
    	$insert_data[4]["date"] = date("Y-m-d");
    	$insert_data[4]["start_time"] = "600";
    	$insert_data[4]["end_time"] = "1200";
    	$insert_data[4]["valid"] =0;
    	$insert_data[4]["car_no"] ="158811";
    	$insert_data[4]["type"] ="Bike";
    	$insert_data[4]["price"] =0;
    	$insert_data[4]["discount"] =0;


    	$insert_data[5]["user_id"] = "01616178787";
    	$insert_data[5]["user_name"] ="Wahidul Islam"; 
    	$insert_data[5]["place_id"] = 8;
    	$insert_data[5]["place_name"] = "Sanmar Ocean City";
    	$insert_data[5]["date"] = date("Y-m-d");
    	$insert_data[5]["start_time"] = "600";
    	$insert_data[5]["end_time"] = "1200";
    	$insert_data[5]["valid"] =0;
    	$insert_data[5]["car_no"] ="142081 ";
    	$insert_data[5]["type"] ="Bike";
    	$insert_data[5]["price"] =0;
    	$insert_data[5]["discount"] =0;

    	$insert_data[6]["user_id"] = "01816608982";
    	$insert_data[6]["user_name"] ="Sumon"; 
    	$insert_data[6]["place_id"] = 8;
    	$insert_data[6]["place_name"] = "Sanmar Ocean City";
    	$insert_data[6]["date"] = date("Y-m-d");
    	$insert_data[6]["start_time"] = "600";
    	$insert_data[6]["end_time"] = "1200";
    	$insert_data[6]["valid"] =0;
    	$insert_data[6]["car_no"] ="130000";
    	$insert_data[6]["type"] ="Bike";
    	$insert_data[6]["price"] =0;
    	$insert_data[6]["discount"] =0;

    	$insert_data[7]["user_id"] = "01863284848";
    	$insert_data[7]["user_name"] ="Robin"; 
    	$insert_data[7]["place_id"] = 8;
    	$insert_data[7]["place_name"] = "Sanmar Ocean City";
    	$insert_data[7]["date"] = date("Y-m-d");
    	$insert_data[7]["start_time"] = "600";
    	$insert_data[7]["end_time"] = "1200";
    	$insert_data[7]["valid"] =0;
    	$insert_data[7]["car_no"] ="OnTest Runner";
    	$insert_data[7]["type"] ="Bike";
    	$insert_data[7]["price"] =0;
    	$insert_data[7]["discount"] =0;

    	$insert_data[8]["user_id"] = "01714345551";
    	$insert_data[8]["user_name"] ="Azim"; 
    	$insert_data[8]["place_id"] = 8;
    	$insert_data[8]["place_name"] = "Sanmar Ocean City";
    	$insert_data[8]["date"] = date("Y-m-d");
    	$insert_data[8]["start_time"] = "600";
    	$insert_data[8]["end_time"] = "268521";
    	$insert_data[8]["valid"] =0;
    	$insert_data[8]["car_no"] ="158811";
    	$insert_data[8]["type"] ="Bike";
    	$insert_data[8]["price"] =0;
    	$insert_data[8]["discount"] =0;

    	$insert_data[9]["user_id"] = "01840307358";
    	$insert_data[9]["user_name"] ="Osman"; 
    	$insert_data[9]["place_id"] = 8;
    	$insert_data[9]["place_name"] = "Sanmar Ocean City";
    	$insert_data[9]["date"] = date("Y-m-d");
    	$insert_data[9]["start_time"] = "600";
    	$insert_data[9]["end_time"] = "1200";
    	$insert_data[9]["valid"] =0;
    	$insert_data[9]["car_no"] ="173740";
    	$insert_data[9]["type"] ="Bike";
    	$insert_data[9]["price"] =0;
    	$insert_data[9]["discount"] =0;

    	$insert_data[10]["user_id"] = "01823227351";
    	$insert_data[10]["user_name"] ="Hridoy"; 
    	$insert_data[10]["place_id"] = 8;
    	$insert_data[10]["place_name"] = "Sanmar Ocean City";
    	$insert_data[10]["date"] = date("Y-m-d");
    	$insert_data[10]["start_time"] = "600";
    	$insert_data[10]["end_time"] = "1200";
    	$insert_data[10]["valid"] =0;
    	$insert_data[10]["car_no"] ="141821";
    	$insert_data[10]["type"] ="Bike";
    	$insert_data[10]["price"] =0;
    	$insert_data[10]["discount"] =0;

    	$insert_data[11]["user_id"] = "01812576809";
    	$insert_data[11]["user_name"] ="Kowshik"; 
    	$insert_data[11]["place_id"] = 8;
    	$insert_data[11]["place_name"] = "Sanmar Ocean City";
    	$insert_data[11]["date"] = date("Y-m-d");
    	$insert_data[11]["start_time"] = "600";
    	$insert_data[11]["end_time"] = "1200";
    	$insert_data[11]["valid"] =0;
    	$insert_data[11]["car_no"] ="136953";
    	$insert_data[11]["type"] ="Bike";
    	$insert_data[11]["price"] =0;
    	$insert_data[11]["discount"] =0;

    	$insert_data[12]["user_id"] = "01883330524";
    	$insert_data[12]["user_name"] ="Toiyab Ali"; 
    	$insert_data[12]["place_id"] = 8;
    	$insert_data[12]["place_name"] = "Sanmar Ocean City";
    	$insert_data[12]["date"] = date("Y-m-d");
    	$insert_data[12]["start_time"] = "600";
    	$insert_data[12]["end_time"] = "1200";
    	$insert_data[12]["valid"] =0;
    	$insert_data[12]["car_no"] ="165966";
    	$insert_data[12]["type"] ="Bike";
    	$insert_data[12]["price"] =0;
    	$insert_data[12]["discount"] =0;

    	$insert_data[13]["user_id"] = "01820428290";
    	$insert_data[13]["user_name"] ="Shaju Dey"; 
    	$insert_data[13]["place_id"] = 8;
    	$insert_data[13]["place_name"] = "Sanmar Ocean City";
    	$insert_data[13]["date"] = date("Y-m-d");
    	$insert_data[13]["start_time"] = "600";
    	$insert_data[13]["end_time"] = "1200";
    	$insert_data[13]["valid"] =0;
    	$insert_data[13]["car_no"] ="139827";
    	$insert_data[13]["type"] ="Bike";
    	$insert_data[13]["price"] =0;
    	$insert_data[13]["discount"] =0;

    	$insert_data[14]["user_id"] = "0185320200";
    	$insert_data[14]["user_name"] ="Abdur Rahman"; 
    	$insert_data[14]["place_id"] = 8;
    	$insert_data[14]["place_name"] = "Sanmar Ocean City";
    	$insert_data[14]["date"] = date("Y-m-d");
    	$insert_data[14]["start_time"] = "600";
    	$insert_data[14]["end_time"] = "1200";
    	$insert_data[14]["valid"] =0;
    	$insert_data[14]["car_no"] ="OnTest";
    	$insert_data[14]["type"] ="Bike";
    	$insert_data[14]["price"] =0;
    	$insert_data[14]["discount"] =0;

    	$insert_data[15]["user_id"] = "01861308386";
    	$insert_data[15]["user_name"] ="Md. Yeasin"; 
    	$insert_data[15]["place_id"] = 8;
    	$insert_data[15]["place_name"] = "Sanmar Ocean City";
    	$insert_data[15]["date"] = date("Y-m-d");
    	$insert_data[15]["start_time"] = "600";
    	$insert_data[15]["end_time"] = "1200";
    	$insert_data[15]["valid"] =0;
    	$insert_data[15]["car_no"] ="OnTest";
    	$insert_data[15]["type"] ="Bike";
    	$insert_data[15]["price"] =0;
    	$insert_data[15]["discount"] =0;

    	$insert_data[16]["user_id"] = "01852872854";
    	$insert_data[16]["user_name"] ="Saidul Islam Onu"; 
    	$insert_data[16]["place_id"] = 8;
    	$insert_data[16]["place_name"] = "Sanmar Ocean City";
    	$insert_data[16]["date"] = date("Y-m-d");
    	$insert_data[16]["start_time"] = "600";
    	$insert_data[16]["end_time"] = "1200";
    	$insert_data[16]["valid"] =0;
    	$insert_data[16]["car_no"] ="146263";
    	$insert_data[16]["type"] ="Bike";
    	$insert_data[16]["price"] =0;
    	$insert_data[16]["discount"] =0;

    	$insert_data[17]["user_id"] = "01673000217";
    	$insert_data[17]["user_name"] ="Rasel"; 
    	$insert_data[17]["place_id"] = 8;
    	$insert_data[17]["place_name"] = "Sanmar Ocean City";
    	$insert_data[17]["date"] = date("Y-m-d");
    	$insert_data[17]["start_time"] = "600";
    	$insert_data[17]["end_time"] = "1200";
    	$insert_data[17]["valid"] =0;
    	$insert_data[17]["car_no"] ="127936";
    	$insert_data[17]["type"] ="Bike";
    	$insert_data[17]["price"] =0;
    	$insert_data[17]["discount"] =0;

    	$insert_data[18]["user_id"] = "0184011995";
    	$insert_data[18]["user_name"] ="Abu Foyez"; 
    	$insert_data[18]["place_id"] = 8;
    	$insert_data[18]["place_name"] = "Sanmar Ocean City";
    	$insert_data[18]["date"] = date("Y-m-d");
    	$insert_data[18]["start_time"] = "600";
    	$insert_data[18]["end_time"] = "1200";
    	$insert_data[18]["valid"] =0;
    	$insert_data[18]["car_no"] ="143809";
    	$insert_data[18]["type"] ="Bike";
    	$insert_data[18]["price"] =0;
    	$insert_data[18]["discount"] =0;

    	$insert_data[19]["user_id"] = "01878344464";
    	$insert_data[19]["user_name"] ="MD. Sharif Chy"; 
    	$insert_data[19]["place_id"] = 8;
    	$insert_data[19]["place_name"] = "Sanmar Ocean City";
    	$insert_data[19]["date"] = date("Y-m-d");
    	$insert_data[19]["start_time"] = "600";
    	$insert_data[19]["end_time"] = "1200";
    	$insert_data[19]["valid"] =0;
    	$insert_data[19]["car_no"] ="147753";
    	$insert_data[19]["type"] ="Bike";
    	$insert_data[19]["price"] =0;
    	$insert_data[19]["discount"] =0;

    	$insert_data[20]["user_id"] = "01819643555";
    	$insert_data[20]["user_name"] ="Lokman"; 
    	$insert_data[20]["place_id"] = 8;
    	$insert_data[20]["place_name"] = "Sanmar Ocean City";
    	$insert_data[20]["date"] = date("Y-m-d");
    	$insert_data[20]["start_time"] = "600";
    	$insert_data[20]["end_time"] = "1200";
    	$insert_data[20]["valid"] =0;
    	$insert_data[20]["car_no"] ="144722";
    	$insert_data[20]["type"] ="Bike";
    	$insert_data[20]["price"] =0;
    	$insert_data[20]["discount"] =0;

    	$insert_data[21]["user_id"] = "01731886555";
    	$insert_data[21]["user_name"] ="Prakash"; 
    	$insert_data[21]["place_id"] = 8;
    	$insert_data[21]["place_name"] = "Sanmar Ocean City";
    	$insert_data[21]["date"] = date("Y-m-d");
    	$insert_data[21]["start_time"] = "600";
    	$insert_data[21]["end_time"] = "1200";
    	$insert_data[21]["valid"] =0;
    	$insert_data[21]["car_no"] ="110500";
    	$insert_data[21]["type"] ="Bike";
    	$insert_data[21]["price"] =0;
    	$insert_data[21]["discount"] =0;

    	$insert_data[22]["user_id"] = "01619525050";
    	$insert_data[22]["user_name"] ="Akbor"; 
    	$insert_data[22]["place_id"] = 8;
    	$insert_data[22]["place_name"] = "Sanmar Ocean City";
    	$insert_data[22]["date"] = date("Y-m-d");
    	$insert_data[22]["start_time"] = "600";
    	$insert_data[22]["end_time"] = "1200";
    	$insert_data[22]["valid"] =0;
    	$insert_data[22]["car_no"] ="157232";
    	$insert_data[22]["type"] ="Bike";
    	$insert_data[22]["price"] =0;
    	$insert_data[22]["discount"] =0;

    	$insert_data[23]["user_id"] = "01812377683";
    	$insert_data[23]["user_name"] ="Saifuddin"; 
    	$insert_data[23]["place_id"] = 8;
    	$insert_data[23]["place_name"] = "Sanmar Ocean City";
    	$insert_data[23]["date"] = date("Y-m-d");
    	$insert_data[23]["start_time"] = "600";
    	$insert_data[23]["end_time"] = "1200";
    	$insert_data[23]["valid"] =0;
    	$insert_data[23]["car_no"] ="OnTest FZ";
    	$insert_data[23]["type"] ="Bike";
    	$insert_data[23]["price"] =0;
    	$insert_data[23]["discount"] =0;

    	$insert_data[24]["user_id"] = "01817714217";
    	$insert_data[24]["user_name"] ="Milton"; 
    	$insert_data[24]["place_id"] = 8;
    	$insert_data[24]["place_name"] = "Sanmar Ocean City";
    	$insert_data[24]["date"] = date("Y-m-d");
    	$insert_data[24]["start_time"] = "600";
    	$insert_data[24]["end_time"] = "1200";
    	$insert_data[24]["valid"] =0;
    	$insert_data[24]["car_no"] ="153063";
    	$insert_data[24]["type"] ="Bike";
    	$insert_data[24]["price"] =0;
    	$insert_data[24]["discount"] =0;

    	$insert_data[25]["user_id"] = "01812518137";
    	$insert_data[25]["user_name"] ="Jilhaj"; 
    	$insert_data[25]["place_id"] = 8;
    	$insert_data[25]["place_name"] = "Sanmar Ocean City";
    	$insert_data[25]["date"] = date("Y-m-d");
    	$insert_data[25]["start_time"] = "600";
    	$insert_data[25]["end_time"] = "1200";
    	$insert_data[25]["valid"] =0;
    	$insert_data[25]["car_no"] ="120439";
    	$insert_data[25]["type"] ="Bike";
    	$insert_data[25]["price"] =0;
    	$insert_data[25]["discount"] =0;

    	

    	foreach ($insert_data as $insert) {
    		$this->db->insert('end_live_parking',$insert);
    	}

        echo "success!";
    	
        // $this->db->insert('end_live_parking',$insert_data);
    }

    public function add_ha_parking(){

        $insert_data[0]["user_id"] = "8801798876616";
        $insert_data[0]["user_name"] ="Speectrum Advertising Limited"; 
        $insert_data[0]["place_id"] = 6;
        $insert_data[0]["place_name"] = "Happy Arcade";
        $insert_data[0]["date"] = date("Y-m-d");
        $insert_data[0]["start_time"] = "600";
        $insert_data[0]["end_time"] = "1200";
        $insert_data[0]["valid"] =0;
        $insert_data[0]["car_no"] ="37-8966";
        $insert_data[0]["type"] ="Car";
        $insert_data[0]["price"] =0;
        $insert_data[0]["discount"] =0;

        $insert_data[1]["user_id"] = "8801798876616";
        $insert_data[1]["user_name"] ="Speectrum Advertising Limited"; 
        $insert_data[1]["place_id"] = 6;
        $insert_data[1]["place_name"] = "Happy Arcade";
        $insert_data[1]["date"] = date("Y-m-d");
        $insert_data[1]["start_time"] = "600";
        $insert_data[1]["end_time"] = "1200";
        $insert_data[1]["valid"] =0;
        $insert_data[1]["car_no"] ="37-8965";
        $insert_data[1]["type"] ="Car";
        $insert_data[1]["price"] =0;
        $insert_data[1]["discount"] =0;

        $insert_data[2]["user_id"] = "8801798876616";
        $insert_data[2]["user_name"] ="Speectrum Advertising Limited"; 
        $insert_data[2]["place_id"] = 6;
        $insert_data[2]["place_name"] = "Happy Arcade";
        $insert_data[2]["date"] = date("Y-m-d");
        $insert_data[2]["start_time"] = "600";
        $insert_data[2]["end_time"] = "1200";
        $insert_data[2]["valid"] =0;
        $insert_data[2]["car_no"] ="39-2028";
        $insert_data[2]["type"] ="Car";
        $insert_data[2]["price"] =0;
        $insert_data[2]["discount"] =0;

        $insert_data[3]["user_id"] = "8801798876616";
        $insert_data[3]["user_name"] ="Speectrum Advertising Limited"; 
        $insert_data[3]["place_id"] = 6;
        $insert_data[3]["place_name"] = "Happy Arcade";
        $insert_data[3]["date"] = date("Y-m-d");
        $insert_data[3]["start_time"] = "600";
        $insert_data[3]["end_time"] = "1200";
        $insert_data[3]["valid"] =0;
        $insert_data[3]["car_no"] ="13-2291";
        $insert_data[3]["type"] ="Car";
        $insert_data[3]["price"] =0;
        $insert_data[3]["discount"] =0;

        $insert_data[4]["user_id"] = "8801798876616";
        $insert_data[4]["user_name"] ="Speectrum Advertising Limited"; 
        $insert_data[4]["place_id"] = 6;
        $insert_data[4]["place_name"] = "Happy Arcade";
        $insert_data[4]["date"] = date("Y-m-d");
        $insert_data[4]["start_time"] = "600";
        $insert_data[4]["end_time"] = "1200";
        $insert_data[4]["valid"] =0;
        $insert_data[4]["car_no"] ="13-2432";
        $insert_data[4]["type"] ="Car";
        $insert_data[4]["price"] =0;
        $insert_data[4]["discount"] =0;

        $insert_data[5]["user_id"] = "8801798876616";
        $insert_data[5]["user_name"] ="Speectrum Advertising Limited"; 
        $insert_data[5]["place_id"] = 6;
        $insert_data[5]["place_name"] = "Happy Arcade";
        $insert_data[5]["date"] = date("Y-m-d");
        $insert_data[5]["start_time"] = "600";
        $insert_data[5]["end_time"] = "1200";
        $insert_data[5]["valid"] =0;
        $insert_data[5]["car_no"] ="15-4724";
        $insert_data[5]["type"] ="Car";
        $insert_data[5]["price"] =0;
        $insert_data[5]["discount"] =0;

        

        foreach ($insert_data as $insert) {
            $this->db->insert('end_live_parking',$insert);
        }

        echo "success!";
        
        // $this->db->insert('end_live_parking',$insert_data);
    }

    public function add_bti_parking(){

        $carno = 1000;
        for ($i=0; $i < 70 ; $i++) { 
            $carno++;
        

    	$insert_data[$i]["user_id"] = "880711365717";
    	$insert_data[$i]["user_name"] ="tafajjal Ali"; 
    	$insert_data[$i]["place_id"] = 7;
    	$insert_data[$i]["place_name"] = "BTI Premier shopping mall";
    	$insert_data[$i]["date"] = date("Y-m-d");
    	$insert_data[$i]["start_time"] = "600";
    	$insert_data[$i]["end_time"] = "1200";
    	$insert_data[$i]["valid"] =0;
    	$insert_data[$i]["car_no"] ="Honda-".$carno;
    	$insert_data[$i]["type"] ="Car";
    	$insert_data[$i]["price"] =0;
    	$insert_data[$i]["discount"] =0;

        }

        
    	foreach ($insert_data as $insert) {
    		$this->db->insert('end_live_parking',$insert);
    	}

        echo "success";
    	
        // $this->db->insert('end_live_parking',$insert_data);
    }

    public function add_banani_01_parking(){
    	$insert_data[0]["user_id"] = "8801730787844";
        $insert_data[0]["user_name"] ="Bangla cat"; 
        $insert_data[0]["place_id"] = 351;
        $insert_data[0]["place_name"] = "Banani-85";
        $insert_data[0]["date"] = date("Y-m-d");
        $insert_data[0]["start_time"] = "600";
        $insert_data[0]["end_time"] = "1200";
        $insert_data[0]["valid"] =0;
        $insert_data[0]["car_no"] ="2557";
        $insert_data[0]["type"] ="Car";
        $insert_data[0]["price"] =0;
        $insert_data[0]["discount"] =0;

        $insert_data[1]["user_id"] = "8801730787844";
        $insert_data[1]["user_name"] ="Bangla cat"; 
        $insert_data[1]["place_id"] = 351;
        $insert_data[1]["place_name"] = "Banani-85";
        $insert_data[1]["date"] = date("Y-m-d");
        $insert_data[1]["start_time"] = "600";
        $insert_data[1]["end_time"] = "1200";
        $insert_data[1]["valid"] =0;
        $insert_data[1]["car_no"] ="4482";
        $insert_data[1]["type"] ="Car";
        $insert_data[1]["price"] =0;
        $insert_data[1]["discount"] =0;

        $insert_data[2]["user_id"] = "8801730787844";
        $insert_data[2]["user_name"] ="Bangla cat"; 
        $insert_data[2]["place_id"] = 351;
        $insert_data[2]["place_name"] = "Banani-85";
        $insert_data[2]["date"] = date("Y-m-d");
        $insert_data[2]["start_time"] = "600";
        $insert_data[2]["end_time"] = "1200";
        $insert_data[2]["valid"] =0;
        $insert_data[2]["car_no"] ="5559";
        $insert_data[2]["type"] ="Car";
        $insert_data[2]["price"] =0;
        $insert_data[2]["discount"] =0;

        $insert_data[3]["user_id"] = "8801730787844";
        $insert_data[3]["user_name"] ="Bangla cat"; 
        $insert_data[3]["place_id"] = 351;
        $insert_data[3]["place_name"] = "Banani-85";
        $insert_data[3]["date"] = date("Y-m-d");
        $insert_data[3]["start_time"] = "600";
        $insert_data[3]["end_time"] = "1200";
        $insert_data[3]["valid"] =0;
        $insert_data[3]["car_no"] ="5570";
        $insert_data[3]["type"] ="Car";
        $insert_data[3]["price"] =0;
        $insert_data[3]["discount"] =0;

        $insert_data[4]["user_id"] = "8801730787844";
        $insert_data[4]["user_name"] ="Bangla cat"; 
        $insert_data[4]["place_id"] = 351;
        $insert_data[4]["place_name"] = "Banani-85";
        $insert_data[4]["date"] = date("Y-m-d");
        $insert_data[4]["start_time"] = "600";
        $insert_data[4]["end_time"] = "1200";
        $insert_data[4]["valid"] =0;
        $insert_data[4]["car_no"] ="7764";
        $insert_data[4]["type"] ="Car";
        $insert_data[4]["price"] =0;
        $insert_data[4]["discount"] =0;

        $insert_data[5]["user_id"] = "8801730787844";
        $insert_data[5]["user_name"] ="Bangla cat"; 
        $insert_data[5]["place_id"] = 351;
        $insert_data[5]["place_name"] = "Banani-85";
        $insert_data[5]["date"] = date("Y-m-d");
        $insert_data[5]["start_time"] = "600";
        $insert_data[5]["end_time"] = "1200";
        $insert_data[5]["valid"] =0;
        $insert_data[5]["car_no"] ="0432";
        $insert_data[5]["type"] ="Car";
        $insert_data[5]["price"] =0;
        $insert_data[5]["discount"] =0;

        $insert_data[6]["user_id"] = "8801730787844";
        $insert_data[6]["user_name"] ="Bangla cat"; 
        $insert_data[6]["place_id"] = 351;
        $insert_data[6]["place_name"] = "Banani-85";
        $insert_data[6]["date"] = date("Y-m-d");
        $insert_data[6]["start_time"] = "600";
        $insert_data[6]["end_time"] = "1200";
        $insert_data[6]["valid"] =0;
        $insert_data[6]["car_no"] ="0512";
        $insert_data[6]["type"] ="Car";
        $insert_data[6]["price"] =0;
        $insert_data[6]["discount"] =0;

        $insert_data[7]["user_id"] = "8801730787844";
        $insert_data[7]["user_name"] ="Bangla cat"; 
        $insert_data[7]["place_id"] = 351;
        $insert_data[7]["place_name"] = "Banani-85";
        $insert_data[7]["date"] = date("Y-m-d");
        $insert_data[7]["start_time"] = "600";
        $insert_data[7]["end_time"] = "1200";
        $insert_data[7]["valid"] =0;
        $insert_data[7]["car_no"] ="1557";
        $insert_data[7]["type"] ="Car";
        $insert_data[7]["price"] =0;
        $insert_data[7]["discount"] =0;

        $insert_data[8]["user_id"] = "8801730787844";
        $insert_data[8]["user_name"] ="Bangla cat"; 
        $insert_data[8]["place_id"] = 351;
        $insert_data[8]["place_name"] = "Banani-85";
        $insert_data[8]["date"] = date("Y-m-d");
        $insert_data[8]["start_time"] = "600";
        $insert_data[8]["end_time"] = "1200";
        $insert_data[8]["valid"] =0;
        $insert_data[8]["car_no"] ="5621";
        $insert_data[8]["type"] ="Car";
        $insert_data[8]["price"] =0;
        $insert_data[8]["discount"] =0;

        $insert_data[9]["user_id"] = "8801730787844";
        $insert_data[9]["user_name"] ="Bangla cat"; 
        $insert_data[9]["place_id"] = 351;
        $insert_data[9]["place_name"] = "Banani-85";
        $insert_data[9]["date"] = date("Y-m-d");
        $insert_data[9]["start_time"] = "600";
        $insert_data[9]["end_time"] = "1200";
        $insert_data[9]["valid"] =0;
        $insert_data[9]["car_no"] ="5489";
        $insert_data[9]["type"] ="Car";
        $insert_data[9]["price"] =0;
        $insert_data[9]["discount"] =0;


        $insert_data[10]["user_id"] = "8801730787844";
        $insert_data[10]["user_name"] ="Bangla cat"; 
        $insert_data[10]["place_id"] = 351;
        $insert_data[10]["place_name"] = "Banani-85";
        $insert_data[10]["date"] = date("Y-m-d");
        $insert_data[10]["start_time"] = "600";
        $insert_data[10]["end_time"] = "1200";
        $insert_data[10]["valid"] =0;
        $insert_data[10]["car_no"] ="5298";
        $insert_data[10]["type"] ="Car";
        $insert_data[10]["price"] =0;
        $insert_data[10]["discount"] =0;

        $insert_data[11]["user_id"] = "8801730787844";
        $insert_data[11]["user_name"] ="Bangla cat"; 
        $insert_data[11]["place_id"] = 351;
        $insert_data[11]["place_name"] = "Banani-85";
        $insert_data[11]["date"] = date("Y-m-d");
        $insert_data[11]["start_time"] = "600";
        $insert_data[11]["end_time"] = "1200";
        $insert_data[11]["valid"] =0;
        $insert_data[11]["car_no"] ="1522";
        $insert_data[11]["type"] ="Car";
        $insert_data[11]["price"] =0;
        $insert_data[11]["discount"] =0;

        $insert_data[12]["user_id"] = "8801730787844";
        $insert_data[12]["user_name"] ="Bangla cat"; 
        $insert_data[12]["place_id"] = 351;
        $insert_data[12]["place_name"] = "Banani-85";
        $insert_data[12]["date"] = date("Y-m-d");
        $insert_data[12]["start_time"] = "600";
        $insert_data[12]["end_time"] = "1200";
        $insert_data[12]["valid"] =0;
        $insert_data[12]["car_no"] ="4822";
        $insert_data[12]["type"] ="Car";
        $insert_data[12]["price"] =0;
        $insert_data[12]["discount"] =0;

        $insert_data[13]["user_id"] = "8801730787844";
        $insert_data[13]["user_name"] ="Bangla cat"; 
        $insert_data[13]["place_id"] = 351;
        $insert_data[13]["place_name"] = "Banani-85";
        $insert_data[13]["date"] = date("Y-m-d");
        $insert_data[13]["start_time"] = "600";
        $insert_data[13]["end_time"] = "1200";
        $insert_data[13]["valid"] =0;
        $insert_data[13]["car_no"] ="6013";
        $insert_data[13]["type"] ="Car";
        $insert_data[13]["price"] =0;
        $insert_data[13]["discount"] =0;

        $insert_data[14]["user_id"] = "8801730787844";
        $insert_data[14]["user_name"] ="Bangla cat"; 
        $insert_data[14]["place_id"] = 351;
        $insert_data[14]["place_name"] = "Banani-85";
        $insert_data[14]["date"] = date("Y-m-d");
        $insert_data[14]["start_time"] = "600";
        $insert_data[14]["end_time"] = "1200";
        $insert_data[14]["valid"] =0;
        $insert_data[14]["car_no"] ="4892";
        $insert_data[14]["type"] ="Car";
        $insert_data[14]["price"] =0;
        $insert_data[14]["discount"] =0;

        $insert_data[15]["user_id"] = "8801730787844";
        $insert_data[15]["user_name"] ="Bangla cat"; 
        $insert_data[15]["place_id"] = 351;
        $insert_data[15]["place_name"] = "Banani-85";
        $insert_data[15]["date"] = date("Y-m-d");
        $insert_data[15]["start_time"] = "600";
        $insert_data[15]["end_time"] = "1200";
        $insert_data[15]["valid"] =0;
        $insert_data[15]["car_no"] ="3286";
        $insert_data[15]["type"] ="Car";
        $insert_data[15]["price"] =0;
        $insert_data[15]["discount"] =0;

        $insert_data[16]["user_id"] = "8801730787844";
        $insert_data[16]["user_name"] ="Bangla cat"; 
        $insert_data[16]["place_id"] = 351;
        $insert_data[16]["place_name"] = "Banani-85";
        $insert_data[16]["date"] = date("Y-m-d");
        $insert_data[16]["start_time"] = "600";
        $insert_data[16]["end_time"] = "1200";
        $insert_data[16]["valid"] =0;
        $insert_data[16]["car_no"] ="4696";
        $insert_data[16]["type"] ="Car";
        $insert_data[16]["price"] =0;
        $insert_data[16]["discount"] =0;

        $insert_data[17]["user_id"] = "8801730787844";
        $insert_data[17]["user_name"] ="Bangla cat"; 
        $insert_data[17]["place_id"] = 351;
        $insert_data[17]["place_name"] = "Banani-85";
        $insert_data[17]["date"] = date("Y-m-d");
        $insert_data[17]["start_time"] = "600";
        $insert_data[17]["end_time"] = "1200";
        $insert_data[17]["valid"] =0;
        $insert_data[17]["car_no"] ="1593";
        $insert_data[17]["type"] ="Car";
        $insert_data[17]["price"] =0;
        $insert_data[17]["discount"] =0;

        $insert_data[18]["user_id"] = "8801730787844";
        $insert_data[18]["user_name"] ="Bangla cat"; 
        $insert_data[18]["place_id"] = 351;
        $insert_data[18]["place_name"] = "Banani-85";
        $insert_data[18]["date"] = date("Y-m-d");
        $insert_data[18]["start_time"] = "600";
        $insert_data[18]["end_time"] = "1200";
        $insert_data[18]["valid"] =0;
        $insert_data[18]["car_no"] ="4179";
        $insert_data[18]["type"] ="Car";
        $insert_data[18]["price"] =0;
        $insert_data[18]["discount"] =0;

        $insert_data[19]["user_id"] = "8801730787844";
        $insert_data[19]["user_name"] ="Bangla cat"; 
        $insert_data[19]["place_id"] = 351;
        $insert_data[19]["place_name"] = "Banani-85";
        $insert_data[19]["date"] = date("Y-m-d");
        $insert_data[19]["start_time"] = "600";
        $insert_data[19]["end_time"] = "1200";
        $insert_data[19]["valid"] =0;
        $insert_data[19]["car_no"] ="4695";
        $insert_data[19]["type"] ="Car";
        $insert_data[19]["price"] =0;
        $insert_data[19]["discount"] =0;

        $insert_data[20]["user_id"] = "8801730787844";
        $insert_data[20]["user_name"] ="Bangla cat"; 
        $insert_data[20]["place_id"] = 351;
        $insert_data[20]["place_name"] = "Banani-85";
        $insert_data[20]["date"] = date("Y-m-d");
        $insert_data[20]["start_time"] = "600";
        $insert_data[20]["end_time"] = "1200";
        $insert_data[20]["valid"] =0;
        $insert_data[20]["car_no"] ="7821";
        $insert_data[20]["type"] ="Car";
        $insert_data[20]["price"] =0;
        $insert_data[20]["discount"] =0;

        $insert_data[21]["user_id"] = "8801730787844";
        $insert_data[21]["user_name"] ="Bangla cat"; 
        $insert_data[21]["place_id"] = 351;
        $insert_data[21]["place_name"] = "Banani-85";
        $insert_data[21]["date"] = date("Y-m-d");
        $insert_data[21]["start_time"] = "600";
        $insert_data[21]["end_time"] = "1200";
        $insert_data[21]["valid"] =0;
        $insert_data[21]["car_no"] ="0396";
        $insert_data[21]["type"] ="Car";
        $insert_data[21]["price"] =0;
        $insert_data[21]["discount"] =0;

        $insert_data[22]["user_id"] = "8801730787844";
        $insert_data[22]["user_name"] ="Bangla cat"; 
        $insert_data[22]["place_id"] = 351;
        $insert_data[22]["place_name"] = "Banani-85";
        $insert_data[22]["date"] = date("Y-m-d");
        $insert_data[22]["start_time"] = "600";
        $insert_data[22]["end_time"] = "1200";
        $insert_data[22]["valid"] =0;
        $insert_data[22]["car_no"] ="4487";
        $insert_data[22]["type"] ="Car";
        $insert_data[22]["price"] =0;
        $insert_data[22]["discount"] =0;

       

        

        foreach ($insert_data as $insert) {
            $this->db->insert('end_live_parking',$insert);
        }

        echo "success!";
    }



    public function add_banani_02_parking(){
    	$insert_data[0]["user_id"] = "01713443255";
    	$insert_data[0]["user_name"] ="wartsila bangladesh ltd"; 
    	$insert_data[0]["place_id"] = 9;
    	$insert_data[0]["place_name"] = "Banani-95/A";
    	$insert_data[0]["date"] = date("Y-m-d");
    	$insert_data[0]["start_time"] = "600";
    	$insert_data[0]["end_time"] = "1200";
    	$insert_data[0]["valid"] =0;
    	$insert_data[0]["car_no"] ="519901";
    	$insert_data[0]["type"] ="Car";
    	$insert_data[0]["price"] =0;
    	$insert_data[0]["discount"] =0;

    	$insert_data[1]["user_id"] = "01713443255";
    	$insert_data[1]["user_name"] ="wartsila bangladesh ltd"; 
    	$insert_data[1]["place_id"] = 9;
    	$insert_data[1]["place_name"] = "Banani-95/A";
    	$insert_data[1]["date"] = date("Y-m-d");
    	$insert_data[1]["start_time"] = "600";
    	$insert_data[1]["end_time"] = "1200";
    	$insert_data[1]["valid"] =0;
    	$insert_data[1]["car_no"] ="314131";
    	$insert_data[1]["type"] ="Car";
    	$insert_data[1]["price"] =0;
    	$insert_data[1]["discount"] =0;

    	$insert_data[2]["user_id"] = "01713443255";
    	$insert_data[2]["user_name"] ="wartsila bangladesh ltd"; 
    	$insert_data[2]["place_id"] = 9;
    	$insert_data[2]["place_name"] = "Banani-95/A";
    	$insert_data[2]["date"] = date("Y-m-d");
    	$insert_data[2]["start_time"] = "600";
    	$insert_data[2]["end_time"] = "1200";
    	$insert_data[2]["valid"] =0;
    	$insert_data[2]["car_no"] ="517172";
    	$insert_data[2]["type"] ="Car";
    	$insert_data[2]["price"] =0;
    	$insert_data[2]["discount"] =0;

    	$insert_data[3]["user_id"] = "01713443255";
    	$insert_data[3]["user_name"] ="wartsila bangladesh ltd"; 
    	$insert_data[3]["place_id"] = 9;
    	$insert_data[3]["place_name"] = "Banani-95/A";
    	$insert_data[3]["date"] = date("Y-m-d");
    	$insert_data[3]["start_time"] = "600";
    	$insert_data[3]["end_time"] = "1200";
    	$insert_data[3]["valid"] =0;
    	$insert_data[3]["car_no"] ="389502";
    	$insert_data[3]["type"] ="Car";
    	$insert_data[3]["price"] =0;
    	$insert_data[3]["discount"] =0;


    	$insert_data[4]["user_id"] = "01713443255";
    	$insert_data[4]["user_name"] ="wartsila bangladesh ltd"; 
    	$insert_data[4]["place_id"] = 9;
    	$insert_data[4]["place_name"] = "Banani-95/A";
    	$insert_data[4]["date"] = date("Y-m-d");
    	$insert_data[4]["start_time"] = "600";
    	$insert_data[4]["end_time"] = "1200";
    	$insert_data[4]["valid"] =0;
    	$insert_data[4]["car_no"] ="372080";
    	$insert_data[4]["type"] ="Car";
    	$insert_data[4]["price"] =0;
    	$insert_data[4]["discount"] =0;


    	$insert_data[5]["user_id"] = "01709635291";
    	$insert_data[5]["user_name"] ="Confidence Power Holdings LTD"; 
    	$insert_data[5]["place_id"] = 9;
    	$insert_data[5]["place_name"] = "Banani-95/A";
    	$insert_data[5]["date"] = date("Y-m-d");
    	$insert_data[5]["start_time"] = "600";
    	$insert_data[5]["end_time"] = "1200";
    	$insert_data[5]["valid"] =0;
    	$insert_data[5]["car_no"] ="518541";
    	$insert_data[5]["type"] ="Car";
    	$insert_data[5]["price"] =0;
    	$insert_data[5]["discount"] =0;


    	$insert_data[6]["user_id"] = "01709635291";
    	$insert_data[6]["user_name"] ="Confidence Power Holdings LTD"; 
    	$insert_data[6]["place_id"] = 9;
    	$insert_data[6]["place_name"] = "Banani-95/A";
    	$insert_data[6]["date"] = date("Y-m-d");
    	$insert_data[6]["start_time"] = "600";
    	$insert_data[6]["end_time"] = "1200";
    	$insert_data[6]["valid"] =0;
    	$insert_data[6]["car_no"] ="562566";
    	$insert_data[6]["type"] ="Car";
    	$insert_data[6]["price"] =0;
    	$insert_data[6]["discount"] =0;

    	$insert_data[7]["user_id"] = "01709635291";
    	$insert_data[7]["user_name"] ="Confidence Power Holdings LTD"; 
    	$insert_data[7]["place_id"] = 9;
    	$insert_data[7]["place_name"] = "Banani-95/A";
    	$insert_data[7]["date"] = date("Y-m-d");
    	$insert_data[7]["start_time"] = "600";
    	$insert_data[7]["end_time"] = "1200";
    	$insert_data[7]["valid"] =0;
    	$insert_data[7]["car_no"] ="256013";
    	$insert_data[7]["type"] ="Car";
    	$insert_data[7]["price"] =0;
    	$insert_data[7]["discount"] =0;


    	$insert_data[8]["user_id"] = "01709635291";
    	$insert_data[8]["user_name"] ="Digicon telecommunication LTD"; 
    	$insert_data[8]["place_id"] = 9;
    	$insert_data[8]["place_name"] = "Banani-95/A";
    	$insert_data[8]["date"] = date("Y-m-d");
    	$insert_data[8]["start_time"] = "600";
    	$insert_data[8]["end_time"] = "1200";
    	$insert_data[8]["valid"] =0;
    	$insert_data[8]["car_no"] ="379816";
    	$insert_data[8]["type"] ="Car";
    	$insert_data[8]["price"] =0;
    	$insert_data[8]["discount"] =0;

    	$insert_data[9]["user_id"] = "01709635291";
    	$insert_data[9]["user_name"] ="Digicon telecommunication LTD"; 
    	$insert_data[9]["place_id"] = 9;
    	$insert_data[9]["place_name"] = "Banani-95/A";
    	$insert_data[9]["date"] = date("Y-m-d");
    	$insert_data[9]["start_time"] = "600";
    	$insert_data[9]["end_time"] = "1200";
    	$insert_data[9]["valid"] =0;
    	$insert_data[9]["car_no"] ="157612";
    	$insert_data[9]["type"] ="Car";
    	$insert_data[9]["price"] =0;
    	$insert_data[9]["discount"] =0;

    	$insert_data[10]["user_id"] = "01709635291";
    	$insert_data[10]["user_name"] ="Digicon telecommunication LTD"; 
    	$insert_data[10]["place_id"] = 9;
    	$insert_data[10]["place_name"] = "Banani-95/A";
    	$insert_data[10]["date"] = date("Y-m-d");
    	$insert_data[10]["start_time"] = "600";
    	$insert_data[10]["end_time"] = "1200";
    	$insert_data[10]["valid"] =0;
    	$insert_data[10]["car_no"] ="563148";
    	$insert_data[10]["type"] ="Car";
    	$insert_data[10]["price"] =0;
    	$insert_data[10]["discount"] =0;

    	$insert_data[11]["user_id"] = "01709635291";
    	$insert_data[11]["user_name"] ="Digicon telecommunication LTD"; 
    	$insert_data[11]["place_id"] = 9;
    	$insert_data[11]["place_name"] = "Banani-95/A";
    	$insert_data[11]["date"] = date("Y-m-d");
    	$insert_data[11]["start_time"] = "600";
    	$insert_data[11]["end_time"] = "1200";
    	$insert_data[11]["valid"] =0;
    	$insert_data[11]["car_no"] ="325917";
    	$insert_data[11]["type"] ="Car";
    	$insert_data[11]["price"] =0;
    	$insert_data[11]["discount"] =0;


    	$insert_data[12]["user_id"] = "01313043870";
    	$insert_data[12]["user_name"] ="Kirtonkhola Tower Bangladesh LTD"; 
    	$insert_data[12]["place_id"] = 9;
    	$insert_data[12]["place_name"] = "Banani-95/A";
    	$insert_data[12]["date"] = date("Y-m-d");
    	$insert_data[12]["start_time"] = "600";
    	$insert_data[12]["end_time"] = "1200";
    	$insert_data[12]["valid"] =0;
    	$insert_data[12]["car_no"] ="512724";
    	$insert_data[12]["type"] ="Car";
    	$insert_data[12]["price"] =0;
    	$insert_data[12]["discount"] =0;


    	$insert_data[13]["user_id"] = "01313043870";
    	$insert_data[13]["user_name"] ="Kirtonkhola Tower Bangladesh LTD"; 
    	$insert_data[13]["place_id"] = 9;
    	$insert_data[13]["place_name"] = "Banani-95/A";
    	$insert_data[13]["date"] = date("Y-m-d");
    	$insert_data[13]["start_time"] = "600";
    	$insert_data[13]["end_time"] = "1200";
    	$insert_data[13]["valid"] =0;
    	$insert_data[13]["car_no"] ="517767";
    	$insert_data[13]["type"] ="Car";
    	$insert_data[13]["price"] =0;
    	$insert_data[13]["discount"] =0;


    	$insert_data[14]["user_id"] = "01313043870";
    	$insert_data[14]["user_name"] ="Kirtonkhola Tower Bangladesh LTD"; 
    	$insert_data[14]["place_id"] = 9;
    	$insert_data[14]["place_name"] = "Banani-95/A";
    	$insert_data[14]["date"] = date("Y-m-d");
    	$insert_data[14]["start_time"] = "600";
    	$insert_data[14]["end_time"] = "1200";
    	$insert_data[14]["valid"] =0;
    	$insert_data[14]["car_no"] ="561378";
    	$insert_data[14]["type"] ="Car";
    	$insert_data[14]["price"] =0;
    	$insert_data[14]["discount"] =0;


    	$insert_data[15]["user_id"] = "8801787667469";
    	$insert_data[15]["user_name"] ="Link3 technologies limited"; 
    	$insert_data[15]["place_id"] = 9;
    	$insert_data[15]["place_name"] = "Banani-95/A";
    	$insert_data[15]["date"] = date("Y-m-d");
    	$insert_data[15]["start_time"] = "600";
    	$insert_data[15]["end_time"] = "1200";
    	$insert_data[15]["valid"] =0;
    	$insert_data[15]["car_no"] ="562724";
    	$insert_data[15]["type"] ="Car";
    	$insert_data[15]["price"] =0;
    	$insert_data[15]["discount"] =0;

    	$insert_data[16]["user_id"] = "8801787667469";
    	$insert_data[16]["user_name"] ="Link3 technologies limited"; 
    	$insert_data[16]["place_id"] = 9;
    	$insert_data[16]["place_name"] = "Banani-95/A";
    	$insert_data[16]["date"] = date("Y-m-d");
    	$insert_data[16]["start_time"] = "600";
    	$insert_data[16]["end_time"] = "1200";
    	$insert_data[16]["valid"] =0;
    	$insert_data[16]["car_no"] ="390972";
    	$insert_data[16]["type"] ="Car";
    	$insert_data[16]["price"] =0;
    	$insert_data[16]["discount"] =0;


    	$insert_data[17]["user_id"] = "8801787667469";
    	$insert_data[17]["user_name"] ="Link3 technologies limited"; 
    	$insert_data[17]["place_id"] = 9;
    	$insert_data[17]["place_name"] = "Banani-95/A";
    	$insert_data[17]["date"] = date("Y-m-d");
    	$insert_data[17]["start_time"] = "600";
    	$insert_data[17]["end_time"] = "1200";
    	$insert_data[17]["valid"] =0;
    	$insert_data[17]["car_no"] ="537430";
    	$insert_data[17]["type"] ="Car";
    	$insert_data[17]["price"] =0;
    	$insert_data[17]["discount"] =0;





    	foreach ($insert_data as $insert) {
            $this->db->insert('end_live_parking',$insert);
        }

        echo "success!";
    }

    public function add_parking_history(){
        if($_POST){
            $qty = $this->input->post('qty');
            $vtype = $this->input->post('vtype');
            $place = $this->input->post('place_name');
            $entry_date = $this->input->post('entry_date');
            $entry_date = date("Y-m-d", strtotime($entry_date));


            for ($i=1; $i <= $qty ; $i++) { 
                $insert_data = array(
                    "user_id" =>0,
                    "user_name" =>0,
                    "place_id" =>0,
                    "place_name" =>$place,
                    "date" =>$entry_date,
                    "start_time" =>0,
                    "end_time" =>0,
                    "valid" =>0,
                    "car_no" =>0,
                    "type" => $vtype,
                    "price" =>0,
                    "discount" =>0  
                );
                $this->db->insert('end_live_parking',$insert_data);
                
            }

            redirect('user_track/parking_history');
              
        }
        
        $this->db->select('place_name');
        $this->db->from('end_live_parking');
        $this->db->where('place_name != ','');
        $this->db->group_by('place_name');
        $this->db->order_by('place_name', 'Desc');
        $p_h = $this->db->get();
         
        $result = $p_h->result_array();
        $send_data = array(
            "places" => $result
        );
        $data['home_view'] = $this->load->view('Dashboard/add-parking-history-form',$send_data,true);
        $this->load->view('Dashboard/main_template',$data);
    }


    public function edit_guest_req_monthly($id=""){

        if($_POST){
            $update_id = $this->input->post('id');
            $guest_name = $this->input->post('guest_name');
            $guest_mobile = $this->input->post('guest_mobile');
            $o_name = $this->input->post('o_name');
            $o_mobile = $this->input->post('o_mobile');
            $parking_address = $this->input->post('parking_address');
            $booking_date = $this->input->post('booking_date');
            $booking_date = date("d-m-Y", strtotime($booking_date));

            $update_array = array(
                'email' => $guest_name,
                'mobile' => $guest_mobile,
                'date' => $booking_date,
                'o_name' => $o_name,
                'o_mobile' => $o_mobile,
                'parking_address' => $parking_address
            );

            

            $this->db->where('id', $update_id);
            $this->db->update('book_monthly', $update_array);
            redirect("dashboard/monthly_booking");
        }
    	$this->db->select('*');
        $this->db->from('book_monthly');
        $this->db->where('id',$id);
        $this->db->order_by('id', 'Desc');
        $total_user = $this->db->get();
        $monthly_book = $total_user->result_array();

        // echo "<pre>";
        // print_r($monthly_book);
        // die;
		$send_data = array(
		"place_data" => $monthly_book 
		);
		$data['home_view']= $this->load->view('Dashboard/edit_place_public',$send_data ,true);
		$this->load->view('Dashboard/main_template',$data);
    }

    public function edit_guest_req_custom($id){

    }

    public function add_mnth_cstm_cmnt($id = ""){
    	if($_POST){
    		$comment_id = $this->input->post('comment_id');
    		$comment = $this->input->post('message');
    		date_default_timezone_set("Asia/Dhaka");
			$comment_date_time = date("Y-m-d H:i:s");
    		$data = array(
        		"comment" => $comment. "<br> <b>commented by: </b>". $this->session->userdata['email']. " <b>commented on : </b>". $comment_date_time

    		);

			$this->db->where('id', $comment_id);
			$this->db->update('tbl_monthly', $data);
			redirect("dashboard/monthly_request");
    	}
    	


    	$data = array(
    		'id' => $id
    	);

    	$data['home_view'] = $this->load->view('Dashboard/customized_guest_comment',$data,true);
	    $this->load->view('Dashboard/main_template',$data);
    }

    public function add_monthly_place_comment($id=""){
        if($_POST){
            $comment_id = $this->input->post('comment_id');
            $comment = $this->input->post('message');
            
            $data = array(
                "comment" => $comment

            );

            $this->db->where('id', $comment_id);
            $this->db->update('tbl_monthly_places', $data);
            redirect("dashboard/monthly_place_list");
        }
        


        $data = array(
            'id' => $id
        );

        $data['home_view'] = $this->load->view('Dashboard/monthly_place_comment',$data,true);
        $this->load->view('Dashboard/main_template',$data);


    }

    public function add_hourly_comment($id=""){
    	// if($_POST){
    	// 	echo $id;
    	// 	die;
    	// }
    	if($_POST){
    		$comment_id = $this->input->post('comment_id');
    		$comment = $this->input->post('message');

    		$data = array(
        		"comment" => $comment

    		);

			$this->db->where('id', $comment_id);
			$this->db->update('transaction_history', $data);
			redirect("dashboard/hourly_request");
    	}
    	


    	$data = array(
    		'id' => $id
    	);

    	$data['home_view'] = $this->load->view('Dashboard/hourly_parking_comment',$data,true);
	    $this->load->view('Dashboard/main_template',$data);
    }


    public function add_host_comment($id=""){
    	if($_POST){
    		$comment_id = $this->input->post('comment_id');
    		$comment = $this->input->post('message');

    		$data = array(
        		"comment" => $comment

    		);

			$this->db->where('id', $comment_id);
			$this->db->update('places', $data);
			redirect("dashboard/new_place");
    	}
    	


    	$data = array(
    		'id' => $id
    	);
    	

    	$data['home_view'] = $this->load->view('Dashboard/hourly_host_comment',$data,true);
	    $this->load->view('Dashboard/main_template',$data);

    }



    public function login_history(){
    	$login_history = $this->Dashboard_model->get_login_history();
    	$send_data = array(
    		"user_log" => $login_history

    	);

    	$data['home_view'] = $this->load->view('Dashboard/login_history_list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);


    }

    // 9th may

    public function hourly_request(){
    	$hourly_request = $this->Dashboard_model->get_hourly_transaction_request();
    

    	$send_data = array(
    		'hourly_request_list' => $hourly_request
    	);
    	$data['home_view'] = $this->load->view('Dashboard/hourly_request_list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
    }

    public function update_promo(){
    	if($_POST){
    		$id = $this->input->post('id');
    		$promo_code = $this->input->post('promo_code');
    		$price = $this->input->post('price');
    		$data = array(
        		'promo_code' =>$promo_code,
        		'price' => $price
    		);

			$this->db->where('id', $id);
			$this->db->update('promo_list', $data);
			redirect('dashboard/promo_list');
    	}
    }
    public function promo_action($action,$id){
            if($action == 'delete'){
            	$data = array(
        			'id' =>$id,
        		);

				$this->db->delete('promo_list', $data);
				redirect('dashboard/promo_list');
            }

            if($action == 'edit'){
            	$promo = $this->Dashboard_model->get_specific_promo($id);
            	$send_data = array(
            		"promo" => $promo
            	);
            	$data['home_view'] = $this->load->view('Dashboard/edit_promo_form',$send_data,true);
	    		$this->load->view('Dashboard/main_template',$data);
            }
        }


    public function add_promo(){

    	if($_POST){
    		$promo_code = $this->input->post('promo_code');
    		$price = $this->input->post('price');
    		
    		
    		$data = array(
        		'promo_code' =>$promo_code,
        		'price' => $price
    		);

			$this->db->insert('promo_list',$data);

			redirect('dashboard/promo_list');

    	}


    	$data['home_view'] = $this->load->view('Dashboard/promo_form',array(),true);
	    $this->load->view('Dashboard/main_template',$data);
    }

    public function promo_list(){
    	$promo_list = $this->Dashboard_model->get_promo_list();
    	$promo_user_list = $this->Dashboard_model->get_promo_user_list();
    	$send_data = array(
    		"promo_list" => $promo_list,
    		"promo_user_list" =>$promo_user_list
    	);
    	$data['home_view'] = $this->load->view('Dashboard/promo-list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
    }


    // end 9th may

    public function recharge_user_credit($id=""){

    	if($_POST){
    		$credit_amount = $this->input->post('credit_amount');
    		$credit_validity = date("Y-m-d 23:59:00", strtotime($this->input->post('credit_validity')));
    		$recharge_id = $this->input->post('id');

    		$get_specific_user = $this->Dashboard_model->get_specific_user($recharge_id);
    		$credit = $get_specific_user[0]['credit'];
    		$credit = $credit + $credit_amount;
    		
    		
    		$data = array(
        		'credit' =>$credit,
        		'credit_validity' => $credit_validity
    		);

			$this->db->where('id', $recharge_id);
			$this->db->update('users', $data);

			redirect('dashboard/credit_management');

    	}
    	
    	$get_specific_user = $this->Dashboard_model->get_specific_user($id);
    	// echo "<pre>";
    	// print_r($get_specific_user);
    	// die;
    	$send_data = array(
    		"recharge_id" => $id,
    		"name" => $get_specific_user[0]['name'],
    		"email" => $get_specific_user[0]['email'],
    		"mobile" => $get_specific_user[0]['mobile'],
    		"available_credit" => $get_specific_user[0]['credit']
    	);
    	$data['home_view'] = $this->load->view('Dashboard/credit_form',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
    }

    public function credit_management(){

    	$credit_list = $this->Dashboard_model->get_total_active_user();

		$send_data = array(
			"credit_list" => $credit_list,
		);
		$data['home_view'] = $this->load->view('Dashboard/credit-list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
    }

    public function division_specific_place(){

    	$dhaka = $this->Dashboard_model->get_total_place_area("dhaka");
    	$chittagong = $this->Dashboard_model->get_total_place_area("chittagong");
		$sylhet = $this->Dashboard_model->get_total_place_area("sylhet");
		
		$send_data = array(
			"dhaka" =>$dhaka,
			"chittagong" =>$chittagong,
			"sylhet" => $sylhet 
		);

		$data['home_view'] = $this->load->view('Dashboard/all_place',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);




    }


    public function todays_signup(){

    	if($_POST){
    		$start_date = $this->input->post('start_date');
    		$end_date = $this->input->post('end_date');
	    	$start_date = date("Y-m-d", strtotime($start_date));
	    	$end_date = date("Y-m-d", strtotime($end_date));
	    	$phone_number = $this->input->post('phone');

	    	$this->db->select('*');
	        $this->db->from('users');

	        if(isset($start_date)&& !empty($start_date)){
	        
	        	$this->db->where('time>= ', $start_date);
	        }

	        if(isset($end_date)&& !empty($end_date)){
				$this->db->where('time<= ', $end_date);
	    	}

	        if(isset($phone_number)&& !empty($phone_number)){
	        	$this->db->where('mobile',$phone_number);
	        }
	        
	        $this->db->where('ref','Q');
	        $total_user = $this->db->get();
	        $total_user = $total_user->result_array();

	        $send_data = array(
            'signups' => $total_user
            );

            
        $data['home_view'] = $this->load->view('Dashboard/signup_users',$send_data,true);
	    $this->load->view('Dashboard/main_template_install',$data);



    	}else{
    	$date = date("Y-m-d");
    	$this->db->select('*');
        $this->db->from('users');
        $this->db->where('ref','Q');
        $this->db->where('time',$date);
        $this->db->order_by('id', 'Desc');
		$total_user = $this->db->get();
		$total_user = $total_user->result_array();
		$send_data = array(
            'signups' => $total_user
            );
        $data['home_view'] = $this->load->view('Dashboard/signup_users',$send_data,true);
	    $this->load->view('Dashboard/main_template_install',$data);

	    }
    }
	// public function index()
	// {
	// if($this->session->userdata('user_id')){
	// $today = date("Y-m-d");
	
	// // last 7 days
	
	// 	$m= date("m");

	// 	$de= date("d");
	
	// 	$y= date("Y");
	
	// 	for($i=0; $i<=6; $i++){
	
	// 	$day[$i] = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 
	
	// 	}
	// 	$getDailyHit= $this->Dashboard_model->getDailyHit($today);
		
		
	// 	// if(isset($getDailyHit)&&!empty($getDailyHit)){
	// 	// $current_hit =  $getDailyHit[0]["hit"];
	// 	// }

	// 	if(!empty($getDailyHit)){
	// 	$current_hit =  $getDailyHit[0]["hit"];
 // 		}else{
 // 		    $current_hit = 0;
 // 		}
		
	// 	$weeklyTotalUser = $this->Dashboard_model->getweeklyUser($day);
	// 	$weeklyTotalSlot = $this->Dashboard_model->getweeklySlot($day);
		
	// 	$weekpyPlace = count($weeklyTotalUser );
		
	// 	$weeklyTransaction = $this->Dashboard_model->getweeklyTransaction($day);
	// 	$numberOfTransaction = count($weeklyTransaction );
		
	// 	$total_active_user = $this->Dashboard_model->get_total_active_user();
	// 	$total_user = count($total_active_user);

	// 	$public_place = $this->Dashboard_model->get_total_public_place();
		
	// 	$total_public_place = count($public_place);

	// 	$private_place = $this->Dashboard_model->get_total_private_place();
		
	// 	$total_private_place = count($private_place);
	// 	$total_private_slot =0;
	// 	$total_public_slot =0;
	// 	$weeklyTotalTransaction = 0;
	// 	$weekly_Total_Slot = 0;
		
	// 	foreach ($weeklyTotalSlot as $weeklyslot)
	//      	{
	     		
	//     		$weekly_Total_Slot += (double)$weeklyslot['total_slot'];
	    		
	//     	}
	    	
	// 	foreach ($weeklyTransaction as $weeklyT)
	//      	{
	     		
	//     		$weeklyTotalTransaction += (double)$weeklyT['cost'];
	    		
	//     	}
	    	
	//     	foreach ($private_place as $private)
	//      	{
	     		
	//     		$total_private_slot += (double)$private['total_slot'];
	    		
	//     	}
	    	
	//     	foreach ($public_place as $public)
	//      	{
	     		
	//     		$total_public_slot += (double)$public['total_slot'];
	    		
	//     	}
	    	
	//     	// if(!isset($urrent_hit)){
	//     	//        $current_hit = 0;
	//     	// }
	//     	$send_data = array(
	// 		"total_user" => $total_user,
	// 		"total_public_place"=>$total_public_place,
	// 		"total_private_place"=>$total_private_place,
	// 		"public_place" => $public_place,
	// 		"private_place" => $private_place,
	// 		"total_public_slot" => $total_public_slot,
	// 		"total_private_slot" => $total_private_slot,
	// 		"weeklyNumberOfTransaction"=>$numberOfTransaction,
	// 		"weeklyTotalTransaction" =>$weeklyTotalTransaction,
	// 		"weekly_Total_Slot" => $weekly_Total_Slot,
	// 		"weekpyPlace"=>$weekpyPlace,
	// 		"current_hit" => $current_hit  
	// 	);
	// 	$data['home_view'] = $this->load->view('Dashboard/dashboard_view',$send_data,true);
	//     $this->load->view('Dashboard/main_template',$data);
	//     }else{
	//     redirect('login');
	//     }
	// }



	public function transaction(){
		$total_transaction = $this->Dashboard_model->get_total_transaction();
		$send_data = array(
			"total_transaction" => $total_transaction,
			
		);
		$data['home_view'] = $this->load->view('Dashboard/transaction',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	}

	
	// view excel form
	public function upload_lead_excel(){
		$data['home_view'] = $this->load->view('Dashboard/upload_excel_lead',array(),true);
	    $this->load->view('Dashboard/main_template',$data);
	}

	// upload excel form

	function add_excel()
	{
		$new_excel = $this;
		$this->upload_excel($new_excel);
	}


	 function upload_excel($file, $upload_field = 'xlsx' )
    {

    	if(isset( $_FILES[ $upload_field ]['name'] ) == FALSE )	return false; 
  		
		$myUploadedfileName='';
		$isUploadedSuccessful= false;
		$location='xlsx/';

		$config['upload_path'] = './content/'.$location;
		$config['allowed_types'] = 'xlsx|xls';  //|gif|jpg|png|jpeg
		$config['file_name']  = 'xlsxfile'; //the extenstion needed to be explicitely determined
		$config['max_size'] = '150000';
		
			
    	$ci = &get_instance();
		
    	$ci->load->library('upload', $config);
    	
    	if ( ! $ci->upload->do_upload('xlsx'))
			{

				
					// die ('error '.'Content File Upload Failed: ' . $this->upload->display_errors());
					$myUploadedfileName = false;
					redirect( 'dashboard/upload_lead_excel');
			}	
			else
			{
				
					$data=$this->upload->data();
						
					$myUploadedfileName=$data['raw_name'].$data['file_ext'];
					
					$isUploadedSuccessful= true;
					
			}
			 session_start();
			 
			$_SESSION['uploadedZipFile'] =  $myUploadedfileName;
			
			
       		redirect(site_url('dashboard/readContentExcelFile'));	
			
    }


    function readContentExcelFile( ) // reading the extracted Folders.
    {
		
		
		$uploadedFile = $_SESSION['uploadedZipFile'];
		$excelFile = BASEPATH .'../content/xlsx/'.$uploadedFile;
		

		$this->load->library('myExcel');
		
			try 
			{
				$objPHPExcel = PHPExcel_IOFactory::load($excelFile);
			} 
			catch(Exception $e) 
			{
				die ('Error loading file :' . $e->getMessage());
				redirect( 'sms_log/excel');
			}
			
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			
			
			//myColumnCount
			$myColumnCount=0;
			$myRowCount =0;
			$row =0;
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) 
			{
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();  ////mkdir hide it.
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
				
				
				
				
				//header will/should be in row 1 only. of course this can be modified to suit your need.
				
				if ($row == 1)  
				{
					$header[$row][$column] = $data_value;
					$myColumnCount++;
				} else 
				{
					$content_data[$row][$column] = $data_value;
				}
				
				//$row++ ;
				
			}
			
			
				
			//send the data in an array format
			$data['header'] = $header;


			$count=$row-1;
			
			

			// foreach ($content_data as $data) {
			// 	if($data['J'] == 'guest list'){
			// 			$lead_type = "guest";

			// 			$insert_array = array(
			// 				"name" => $data['O'],
			// 				"email" => $data['N'],
			// 				"phone" => $data['P'],
			// 				"address" => $data['Q'],
			// 				"location" => $data['M'],
			// 				"lead_type" => $lead_type
			// 			);
			// 		}else{
			// 			$lead_type = "host";
			// 			$insert_array = array(
			// 				"name" => $data['Q'],
			// 				"email" => $data['P'],
			// 				"phone" => $data['R'],
			// 				"address" => $data['S'],
			// 				"location" => $data['M'],
			// 				"lead_type" => $lead_type,
			// 				"vehicle_type" => $data['N']
			// 			);
			// 	}

			// 	$this->db->insert('lead_list',$insert_array);
				
			// }


			foreach ($content_data as $data) {
					$comment = 'Rent: '.$data['E'].' Time: '.$data['H'];
					$lead_type = "host";
					$insert_array = array(
						"name" => $data['A'],
						"number_of_parking" => $data['D'],
						"email" => "",
						"phone" => $data['C'],
						"address" => $data['F'],
						"status" => $data['I'],
						"location" => $data['B'],
						"lead_type" => $lead_type,
						"vehicle_type" => "car/bike",
						"comment" => $comment,
						"priority" => "others"
					);

					// echo "<pre>";
					// print_r($insert_array);
					// die;
				

				$this->db->insert('lead_list',$insert_array);
				
			}
			redirect('dashboard/lead_management');

			
			
			 	
			
	}		
	




	public function monthly_request(){
		$monthly_request = $this->Dashboard_model->get_monthly_request();
		$send_data = array(
			"monthly_request" => $monthly_request,
			
		);
		$data['home_view'] = $this->load->view('Dashboard/monthly_request',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	}
	
	public function complete_monthly_request($id){
		$update_array= array(
		"status"=>1	
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_monthly',$update_array);
		redirect('dashboard/monthly_request');
	}


	public function new_place(){
		$pending_place = $this->Dashboard_model->get_total_pending_place();
		$send_data = array(
			"pending_place" => $pending_place,
			
		);
		$data['home_view'] = $this->load->view('Dashboard/pending_place',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	}

	public function GetPendingPlaces() //@nadim
	{
		# code...
		$requestData = $_REQUEST;
           
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'cost',
            4 => 'mobile',
            5 => 'local',
            6 => 'place_date'
           );
		   $sql = "SELECT places.id AS place_id, places.name, places.email, places.cost, places.local, places.total_slot, places.division, places.image1, users.mobile, places.date AS place_date, places.comment as comment FROM places JOIN users ON places.email = users.email WHERE places.status= 'admin'";
   
   
       
		   $data = $this->db->query($sql);
		  $query = $data->result_array();
		 
		  $totalData = $this->db->query("SELECT count(id) as id FROM `places`");
		  $totalData = $totalData->result();
		  $totalData = $totalData[0]->id;
	   
		 $totalFiltered = $totalData;
		 
		 $totalFiltered = count($query);
		 $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length length
		 
		 $data = $this->db->query($sql);
		  $query = $data->result_array();
       
       $data = array();
       $cnt = $requestData['start'] + 1;
       
     
        foreach ($query as $dt) {
			$cost = $dt['cost'];
			$id = $dt['place_id'];
            $nestedData = array();
			$nestedData[] = $cnt++;
            $nestedData[] = $dt['name'];
			$nestedData[] = $dt['email'];
			if($cost != 'free*'){

				$nestedData[] = $cost.' BDT';
			}else{

				$nestedData[] = $cost;
			}
            
            $nestedData[] = $dt['mobile'];
            $nestedData[] = $dt['local'].','.$dt['division'];
            $nestedData[] = $dt['place_date'];
            $nestedData[] = $dt['comment'];
            // $nestedData[] = "<a href='".base_url()."dashboard/edit_place".'/'.$id."'>Edit</a> <a href='".base_url()."dashboard/approve_place".'/'.$id."'>Approve</a> <a href='".base_url()."dashboard/delete_place".'/'.$id."'>Delete</a>";
            $nestedData[] = "<a href='".base_url()."dashboard/edit_place".'/'.$id."'>Edit</a> <a href='".base_url()."dashboard/approve_place".'/'.$id."'>Approve</a> <a href='".base_url()."dashboard/add_host_comment".'/'.$id."'>Comment</a>";
            $data[] = $nestedData;
        }
       
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
 
        echo json_encode($json_data);
	}

	// public function live_track(){
	// 	$online_user = $this->User_track_model->getOnlineUser();
	// 	$send_data = array(
	// 		"user_track" => $online_user,
			
	// 	);
	// 	$data['home_view']= $this->load->view('Dashboard/user_track',$send_data,true);
	// 	$this->load->view('Dashboard/main_template',$data);
	// }

	public function live_parking(){
		$online_user = $this->User_track_model->getLiveParking();
		$send_data = array(
			"live_parking" => $online_user,
		);
		$data['home_view']= $this->load->view('Dashboard/live_parking',$send_data,true);
		$this->load->view('Dashboard/main_template',$data);
	}

	public function editsummery(){
		$booking_id=$this->input->post('function');
		$data['booking_comment'] = $this->User_track_model->get_booking_comment($booking_id);
		$this->load->view('Dashboard/booking_comment',$data);
		
        
	}

	public function monthly_booking(){
		if($_POST){
			$booking_id = $this->input->post('booking_id');
			$booking_comment = $this->input->post('booking_comment');
			// $insert_array = array(
			// 	"booking_id" => $booking_id,
			// 	"comment_for_table" => "book_monthly",
			// 	"comment" => $booking_comment
				
			// );
			// $this->db->insert('comments',$insert_array);
			// redirect('dashboard/monthly_booking');
			date_default_timezone_set("Asia/Dhaka");
			$comment_date_time = date("Y-m-d H:i:s");
			$update_array = array(
				"comment" => $booking_comment. "<br> <b>commented by: </b>". $this->session->userdata['email']. " <b>commented on : </b>". $comment_date_time
			);

			$this->db->where('id', $booking_id);
			$this->db->update('book_monthly', $update_array);
		}
		$monthly_booking = $this->Dashboard_model->getMonthlyBooking();

		
        

		$send_data = array(
			"monthly_booking" => $monthly_booking,
			
		);
		$data['home_view']= $this->load->view('Dashboard/monthly_booking',$send_data,true);
		$this->load->view('Dashboard/main_template',$data);
	}
	
	public function customer_management(){
		if($_POST){
			$customer_name = $this->input->post('customer_name');
			$customer_mobile = $this->input->post('customer_mobile');
			$customer_address = $this->input->post('customer_address');
			$garage_address = $this->input->post('garage_address');
			$g_o_name = $this->input->post('g_o_name');
			$g_o_mobile = $this->input->post('g_o_mobile');
			$price = $this->input->post('price');
			$insert_array = array(
				"customer_name" => $customer_name,
				"customer_mobile" => $customer_mobile,
				"customer_address" => $customer_address,
				"garage_address" => $garage_address,
				"garage_owner_name" => $g_o_name,
				"garage_owner_mobile" => $g_o_mobile,
				"price" => $price,
				
				
			);
			$this->db->insert('customer',$insert_array);
			redirect('dashboard/customer_management');
		}
		$customer_list = $this->Dashboard_model->getCustomer();


		$send_data = array(
			"customer_list" => $customer_list
			
		);
		$data['home_view']= $this->load->view('Dashboard/customer',$send_data,true);
		$this->load->view('Dashboard/main_template',$data);
	}

	

	public function add_employee(){
	    if($_POST){
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$designation = $this->input->post('designation');
			$phone = $this->input->post('phone');
			$join_date = $this->input->post('join_date');
			$join_date = date("Y-m-d", strtotime($join_date));
			$nid = $this->input->post('nid');
			$password = $this->input->post('password');
			$role = $this->input->post('role');
			$insert_array = array(
				"name" => $name,
				"email" => $email,
				"nid" => $nid,
				"designation" => $designation,
				"phone" => $phone,
				"joining_date" => $join_date
			);
			$this->db->insert('employees',$insert_array);
			$employee_id = $this->db->insert_id();
			$insert_user_array = array(
			"user_id" => $employee_id ,
			"user_type" => "employee",
			"email" => $email,
			"user_role" => $role,
			"password" => md5($password) 
			);
			$this->db->insert('company_user_list',$insert_user_array);
			redirect('dashboard/employee_management');
		}
	    $data['home_view']= $this->load->view('Dashboard/employee_form',array(),true);
		$this->load->view('Dashboard/main_template',$data);
	}

	public function employee_management(){
		
		$employee_list = $this->Dashboard_model->getEmployee();
		$send_data = array(
			"employee_list" => $employee_list
		);
		$data['home_view']= $this->load->view('Dashboard/employee',$send_data,true);
		$this->load->view('Dashboard/main_template',$data);
	}

	public function notification_list(){
		$notification_list = $this->Dashboard_model->getnNotifications();
		
		$send_data = array(

			"notifications" => $notification_list
		);
    	$data['home_view']= $this->load->view('Dashboard/notification',$send_data,true);
		$this->load->view('Dashboard/main_template',$data);
    }


    public function add_to_notification(){
    	
	    if($_POST){
			$title = $this->input->post('title');
			$message = $this->input->post('message');
			$status = "Pending";
			$phone = $this->input->post('phone');
			$insert_array = array(
				"title" => $title,
				"notification" => $message,
				"status" => $status
			);
			$this->db->insert('notification_to_send',$insert_array);
			redirect('dashboard/notification_list');
		}
	    $data['home_view']= $this->load->view('Dashboard/notification_to_sendform',array(),true);
		$this->load->view('Dashboard/main_template',$data);
	}


	public function edit_notification($id){
		$update_array = array(
			"status" => "Sent"
		);

		$this->db->where('id', $id);
		$this->db->update('notification_to_send', $update_array);
		redirect("dashboard/notification_list");
	}


	

	public function edit_place($id){
		$edited_data = $this->Dashboard_model->get_edit_place($id);
		$send_data = array(
		"place_data" => $edited_data 
		);
		$data['home_view']= $this->load->view('Dashboard/edit_place',$send_data ,true);
		$this->load->view('Dashboard/main_template',$data);
		
	
	}
	
	public function edit_place_private($id){
	
	$edited_data = $this->Dashboard_model->get_edit_place($id);
	$send_data = array(
	"place_data" => $edited_data 
	);
	$data['home_view']= $this->load->view('Dashboard/edit_place_private',$send_data ,true);
	$this->load->view('Dashboard/main_template',$data);
	
	}
	
	public function edit_place_public($id){
	
	$edited_data = $this->Dashboard_model->get_edit_place($id);
	$send_data = array(
	"place_data" => $edited_data 
	);
	$data['home_view']= $this->load->view('Dashboard/edit_place_public',$send_data ,true);
	$this->load->view('Dashboard/main_template',$data);
	
	}
	
	public function update_place(){
	
	$id= $this->input->post('id');
	$name = $this->input->post('name');
	$email= $this->input->post('email');
	$cost= $this->input->post('cost');
	$division= $this->input->post('division');
	$local= $this->input->post('local');
	$lat= $this->input->post('lat');
	$lon= $this->input->post('lon');
	$status= $this->input->post('status');
	$ava_slot= $this->input->post('ava_slot');
	$total_slot= $this->input->post('total_slot');
	$date= $this->input->post('date');
	$bike= $this->input->post('bike');
	$car= $this->input->post('car');
	$bycycle= $this->input->post('bycycle');
	$get_request= $this->input->post('get_request');
	
	$get_reg= $this->input->post('get_reg');
	$monthly_cost= $this->input->post('monthly_cost');
	$start_time= $this->input->post('start_time');
	$end_time= $this->input->post('end_time');
	$hourly= $this->input->post('hourly');
	$monthly= $this->input->post('monthly');
	$guard= $this->input->post('guard');
	$indor= $this->input->post('indor');
	$cctv= $this->input->post('cctv');
	
	
	$update_array= array(
	"name "=>$name ,
	"email"=>$email,
	"cost"=>$cost,
	"division"=>$division ,
	"local"=>$local,
	"lat"=>$lat,
	"lon"=>$lon,
	"status"=>$status,
	"ava_slot"=>$ava_slot,
	"total_slot"=>$total_slot,
	"date"=>$date,
	"bike"=>$bike,
	"car"=>$car,
	"bycycle"=>$bycycle,
	"get_request"=>$get_request,
	"get_reg"=>$get_reg,
	"monthly_cost"=>$monthly_cost,
	"start_time"=>$start_time,
	"end_time"=>$end_time ,
	"hourly"=>$hourly,
	"monthly"=>$monthly,
	"cctv"=>$cctv,
	"guard"=>$guard,
	"indor"=>$indor,
	);
	
	$this->db->where('id',$id);
	$this->db->update('places',$update_array);
	redirect('dashboard/new_place');
	}
	
	
	public function update_place_private(){
	
	$id= $this->input->post('id');
	$name = $this->input->post('name');
	$email= $this->input->post('email');
	$cost= $this->input->post('cost');
	$division= $this->input->post('division');
	$local= $this->input->post('local');
	$lat= $this->input->post('lat');
	$lon= $this->input->post('lon');
	$status= $this->input->post('status');
	$ava_slot= $this->input->post('ava_slot');
	$total_slot= $this->input->post('total_slot');
	$date= $this->input->post('date');
	$bike= $this->input->post('bike');
	$car= $this->input->post('car');
	$bycycle= $this->input->post('bycycle');
	$get_request= $this->input->post('get_request');
	
	$get_reg= $this->input->post('get_reg');
	$monthly_cost= $this->input->post('monthly_cost');
	$start_time= $this->input->post('start_time');
	$end_time= $this->input->post('end_time');
	$hourly= $this->input->post('hourly');
	$monthly= $this->input->post('monthly');
	$guard= $this->input->post('guard');
	$indor= $this->input->post('indor');
	$cctv= $this->input->post('cctv');
	
	
	$update_array= array(
	"name "=>$name ,
	"email"=>$email,
	"cost"=>$cost,
	"division"=>$division ,
	"local"=>$local,
	"lat"=>$lat,
	"lon"=>$lon,
	"status"=>$status,
	"ava_slot"=>$ava_slot,
	"total_slot"=>$total_slot,
	"date"=>$date,
	"bike"=>$bike,
	"car"=>$car,
	"bycycle"=>$bycycle,
	"get_request"=>$get_request,
	"get_reg"=>$get_reg,
	"monthly_cost"=>$monthly_cost,
	"start_time"=>$start_time,
	"end_time"=>$end_time ,
	"hourly"=>$hourly,
	"monthly"=>$monthly,
	"cctv"=>$cctv,
	"guard"=>$guard,
	"indor"=>$indor,
	);
	
	$this->db->where('id',$id);
	$this->db->update('places',$update_array);
	redirect('dashboard/index');
	}
	
	
	public function update_place_public(){
	
	$id= $this->input->post('id');
	$name = $this->input->post('name');
	$email= $this->input->post('email');
	$cost= $this->input->post('cost');
	$division= $this->input->post('division');
	$local= $this->input->post('local');
	$lat= $this->input->post('lat');
	$lon= $this->input->post('lon');
	$status= $this->input->post('status');
	$ava_slot= $this->input->post('ava_slot');
	$total_slot= $this->input->post('total_slot');
	$date= $this->input->post('date');
	$bike= $this->input->post('bike');
	$car= $this->input->post('car');
	$bycycle= $this->input->post('bycycle');
	$get_request= $this->input->post('get_request');
	
	$get_reg= $this->input->post('get_reg');
	$monthly_cost= $this->input->post('monthly_cost');
	$start_time= $this->input->post('start_time');
	$end_time= $this->input->post('end_time');
	$hourly= $this->input->post('hourly');
	$monthly= $this->input->post('monthly');
	$guard= $this->input->post('guard');
	$indor= $this->input->post('indor');
	$cctv= $this->input->post('cctv');
	
	
	$update_array= array(
	"name "=>$name ,
	"email"=>$email,
	"cost"=>$cost,
	"division"=>$division ,
	"local"=>$local,
	"lat"=>$lat,
	"lon"=>$lon,
	"status"=>$status,
	"ava_slot"=>$ava_slot,
	"total_slot"=>$total_slot,
	"date"=>$date,
	"bike"=>$bike,
	"car"=>$car,
	"bycycle"=>$bycycle,
	"get_request"=>$get_request,
	"get_reg"=>$get_reg,
	"monthly_cost"=>$monthly_cost,
	"start_time"=>$start_time,
	"end_time"=>$end_time ,
	"hourly"=>$hourly,
	"monthly"=>$monthly,
	"cctv"=>$cctv,
	"guard"=>$guard,
	"indor"=>$indor,
	);
	
	$this->db->where('id',$id);
	$this->db->update('places',$update_array);
	redirect('dashboard/index');
	}
	
	public function approve_place($id){
	$this->Dashboard_model->approve($id);
	redirect('dashboard/new_place');
	}
	
	public function delete_place($id){
	$this->Dashboard_model->delete($id);
	redirect('dashboard/new_place');
	}

    public function delete_guest_request_monthly($id){
    $data = array(
        'id' =>$id,
        );

    $this->db->delete('book_monthly', $data);
    redirect('dashboard/monthly_booking');
    }

    public function delete_monthly_req($id){
    $data = array(
        'id' =>$id,
        );

    $this->db->delete('tbl_monthly', $data);
    redirect('dashboard/monthly_request');
    }
	
	public function delete_place_private_public($id){
	$this->Dashboard_model->delete($id);
	redirect('dashboard/index');
	}
	
	public function logout(){
	$this->session->unset_userdata('email');
	$this->session->unset_userdata('password');
	$this->session->unset_userdata('user_id');
	redirect('login');
	}
	
	public function billing(){
	    $this->db->select('*');
        $this->db->from('voucher_list');
        $this->db->order_by('id', 'Desc');
        $voucher_list= $this->db->get();
        $voucher_list =$voucher_list->result_array();
        
        $this->db->select('*');
        $this->db->from('invoice_list');
        $this->db->order_by('id', 'Desc');
        $invoice_list= $this->db->get();
        $invoice_list =$invoice_list->result_array();
        
        
	    $send_data = array(
	           'voucher_list' => $voucher_list,
	           'invoice_list' => $invoice_list
	        );
	    
	    $data['home_view'] = $this->load->view('Dashboard/billing',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	}
	
	public function add_voucher(){
        
	    $total_praces = $this->input->post('n_place');
	    $unit_price = $this->input->post('price');
	    $total_price = $total_praces*$unit_price;
	    $insert_array = array(
    		"customer_name" => $this->input->post('c_name'),
    		"customer_phone" => $this->input->post('c_phone'),
    		"total_places" => $total_praces,
    		"total_price" => $total_price,
    		"per_unit_price" => $unit_price,
    		"voucher_id" => $this->generateRandomString(),
			"customer_email" => $this->input->post('c_email'),
			"voucher_date" => date("Y-m-d")
		);
		
// 		echo '<pre>';
// 		print_r($insert_array);
// 		die;
 		
		$this->db->insert('voucher_list',$insert_array);
		redirect('dashboard/billing');
	}
	
	public function view_voucher($id){
	    $this->db->select('*');
        $this->db->from('voucher_list');
        $this->db->where('id',$id);
        $this->db->order_by('id', 'Desc');
        $voucher_list= $this->db->get();
        $voucher =$voucher_list->row_array();
        
        $send_data = array(
            'voucher' => $voucher
            );
        
        
	    $data['home_view'] = $this->load->view('Dashboard/view_voucher',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
        
	    
	}
	public function create_new_invoice(){
	    
	    $data['home_view'] = $this->load->view('Dashboard/invoice_form',array(),true);
	    $this->load->view('Dashboard/main_template',$data);
        
	}
	
		public function add_invoice(){
        
	    
	    $insert_invoice = array(
    		"name" => $this->input->post('c_name'),
    		"total_place" => $this->input->post('n_place'),
    		 "amount" => $this->input->post('price'),
    		 "type" => $this->input->post('ptype'),
    		"invoice_id" => $this->generateRandomString(),
    		"invoice_date" => date("Y-m-d")
		);
		
// 		echo '<pre>';
// 		print_r($insert_invoice);
// 		die;
 		
		$this->db->insert('invoice_list',$insert_invoice);
		redirect('dashboard/billing');
	}

	public function view_specific_voucher($id){
	    $this->db->select('*');
        $this->db->from('voucher_list');
        $this->db->where('id',$id);
        $this->db->order_by('id', 'Desc');
        $voucher_list= $this->db->get();
        
        // html 
        
        // end html
        $voucher =$voucher_list->result();
        // echo "<pre>";
        // print_r($voucher);
        // die;
        
        
        $output = '<div class="content" style="background-color:#fcfcfb !important">
    <div class="container-fluid">
        <div class="wrapper" style="border:1px solid #232323;">
            <div class="col-md-12" style="border-bottom:1px solid #b4b4b4; background-color:#000;color:#fff">
            <div class="col-md-2">
                <img style="width:200px;height:auto;margin-top:30px;" src="'.base_url().'images/invoice-logo.png">
            </div>
            
            <div class="col-md-6" style="padding-left:60px;">
                <h4>Parking Koi</h4>
                <address><b>Address:</b>  No# 215 (3rd floor), Merul Badda, Dhaka 1212<br>
                <b>Phone:</b> +01788-584258<br>
                <b>E-mail:</b> info@parkingkoi.net
                </address>
            </div>
            
            <div class="col-md-4" style="padding-left:80px;padding-top:30px">
                    <p style="font-size:20px;padding-left:15px;">Voucher</p>
                        <span>
                            ID: '.$voucher[0]->voucher_id.
                        '</span>
                        <br>
                        <span>
                            Date:'.$voucher[0]->voucher_date.'
                        </span>
            </div>
            
            
            </div>
        
            <div class="col-md-10 col-md-offset-2" style="padding-left:70px;">
            <h3>Customer Information</h3>
            <table class="table table-bordered" style="margin-top:20px">
                
                    <tr>
                        <td><b>Name:</b></td>
                        <td>'.$voucher[0]->customer_name.'</td>
                    </tr>
                    
                    <tr>
                        <td><b>Phone:</b></td>
                        <td>'.$voucher[0]->customer_phone.'</td>
                    </tr>
                    
                    <tr>
                        <td><b>Email:</b></td>
                        <td>'.$voucher[0]->customer_email.'</td>
                    </tr>
                
            </table>
        </div>
        
        
            <div class="col-md-10 col-md-offset-2" style="padding-left:70px;">
                <h3>Voucher Details</h3>
                <table class="table" style="margin-top:20px">
                
                    <tr>
                        <td style="border:none"><b>Total Space:</b></td>
                        <td style="border:none">'.$voucher[0]->total_places.'</td>
                    </tr>
                    
                    <tr>
                        <td style="border:none"><b>Per Unit Price:</b></td>
                        <td style="border:none"> '.$voucher[0]->per_unit_price.' TK</td>
                    </tr>
                    
                    <tr>
                        <td><b>Total Price:</b></td>
                        <td>'.$voucher[0]->total_price.' TK</td>
                    </tr>
                
            </table>
            </div>
            
            <div class="col-md-12" style="background-color:#232323; color:#fff;padding:16px;">
                <div class="col-md-12" style="text-align:center">
                    Email: info@parkingkoi.net | Phone: +01788-584258
                </div>
            </div>
            
        </div>
        
        
    </div>
</div>';
        
        $send_data = array(
            'voucher' => $output
            );
        
        
	    $data['home_view'] = $this->load->view('Dashboard/view_voucher',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	}
	
	public function view_specific_invoice($id){
	    $this->db->select('*');
        $this->db->from('invoice_list');
        $this->db->where('id',$id);
        $this->db->order_by('id', 'Desc');
        $invoice_list= $this->db->get();
        
        // html 
        
        // end html
        $invoice_list =$invoice_list->result();
        // echo "<pre>";
        // print_r($voucher);
        // die;
        
        
        $output = '<div class="content" style="background-color:#fcfcfb !important">
    <div class="container-fluid">
        <div class="wrapper" style="border:1px solid #232323;">
            <div class="col-md-12" style="border-bottom:1px solid #b4b4b4; background-color:#000;color:#fff">
            <div class="col-md-2">
                <img style="width:200px;height:auto;margin-top:30px;" src="'.base_url().'images/invoice-logo.png">
            </div>
            
            <div class="col-md-6" style="padding-left:60px;">
                <h4>Parking Koi</h4>
                <address><b>Address:</b>  No# 215 (3rd floor), Merul Badda, Dhaka 1212<br>
                <b>Phone:</b> +01788-584258<br>
                <b>E-mail:</b> info@parkingkoi.net
                </address>
            </div>
            
            
            
            <div class="col-md-4" style="padding-left:80px;padding-top:30px">
                    <p style="font-size:20px;padding-left:15px;">Invoice</p>
                        <span>
                            ID: '.$invoice_list[0]->invoice_id.
                        '</span>
                        <br>
                        <span>
                            Date:'.$invoice_list[0]->invoice_date.'
                        </span>
            </div>
            
            
        </div>
        
            <div class="col-md-10 col-md-offset-2" style="padding-left:70px;">
                <div class="row" style="margin:30px 0 30px 0">
                    <div class="col-md-4">Invoice ID: <b style="font-size:16px">'.$invoice_list[0]->invoice_id.'</b> </div>
                    <div class="col-md-4"><span style="border:2px solid red; padding:10px;border-radius:5px">Money Receipt</span></div>
                    <div class="col-md-4">Date:'.$invoice_list[0]->invoice_date.'</div>
                </div>
                
                <div class="row" style="margin:30px 0 30px 0;">
                    <div class="col-md-12" style="padding:20px 0">
                    <div class="col-md-6">
                        <div class="col-md-5" style="padding-left:0 !important">Received From:</div> 
                        <div class="col-md-7" style="!important;border-bottom:1px solid #232323;">'.$invoice_list[0]->name.'</div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-3" style="padding-left:0 !important">
                        of taka
                        </div>
                        
                        <div class="col-md-6" style="!important;border-bottom:1px solid #232323;">'
                        .$invoice_list[0]->amount.'
                        </div>
                        
                    </div>
                        
                    </div>
                    
                    <div class="col-md-12">
                    <div class="col-md-2" style="padding-left:0 !important">
                        For: 
                    </div>
                    <div class="col-md-8" style="!important;border-bottom:1px solid #232323;">
                    '.$invoice_list[0]->total_place.' place(s)
                    </div>
                    
                    </div>
                    
                </div>
                
                <div class="row" style="margin:30px 0 30px 0">
                    <div class="col-md-6">
                    Payment Received In: <span style="font-size:15px;font-weight:bold;font-style:capitalize">'.$invoice_list[0]->type.'</span>
                    </div>
                    
                    <div class="col-md-6">
                    <ul style="list-style:none">
                    <li>Total Amount Due:</li>
                    <li>Amount Received:<span style="!important;border-bottom:1px solid #232323;padding:0 10px 0 10px">'.$invoice_list[0]->amount.' <span></li>
                    <li>Balance Due:</li>
                    </div>
                    
                </div>
            </div>
        
        
            
            
            <div class="col-md-12" style="background-color:#232323; color:#fff;padding:16px;">
                <div class="col-md-12" style="text-align:center">
                    Email: info@parkingkoi.net | Phone: +01788-584258
                </div>
            </div>
            
        </div>
        
        
    </div>
</div>';
        
        $send_data = array(
            'invoice' => $output
            );
        
        
	    $data['home_view'] = $this->load->view('Dashboard/view_invoice',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	}
	
	
	

	
	
	public function pdf($id){
	    $this->db->select('*');
        $this->db->from('voucher_list');
        $this->db->where('id',$id);
        $this->db->order_by('id', 'Desc');
        $voucher_list= $this->db->get();
        
        // html 
        
        // end html
        $voucher =$voucher_list->result();
        // echo "<pre>";
        // print_r($voucher);
        // die;
        
        
        $output = '
        <style>
        .pdf-class li{
            list-style:none;
            display:inline-block;
        }
        </style>
        <link href="https://parkingkoi.net/admin/assets/css/bootstrap.min.css" rel="stylesheet" /><div class="content" style="background-color:#fcfcfb !important">
    <div class="container-fluid">
        <div class="wrapper" style="border:1px solid #232323;">
            <div class="col-md-12" style="border-bottom:1px solid #b4b4b4; background-color:#000;color:#fff">
                
                <ul class="pdf-class">
                <li>
                 
                    <img style="width:150px;height:auto;margin-top:-90px;" src="'.base_url().'images/invoice-logo.png">
                 
                </li>
                
                <li style="padding-top:60px;">
                
                    <h4 style="font-size:15px">Parking Koi</h4>
                    <address style="font-size:12px"><b>Address:</b>  No# 215 (3rd floor), Merul Badda, Dhaka 1212<br>
                    <b>Phone:</b> +01788-584258<br>
                    <b>E-mail:</b> info@parkingkoi.net
                    </address>
                
                </li>
                
                <li style="margin-top:-20px;font-size:15px !important;padding-left:20px;">            
                    
                        <p style="font-size:15px;padding-left:15px;">Voucher</p>
                            <span style="font-size:15px;">
                                ID: '.$voucher[0]->voucher_id.
                            '</span>
                            <br>
                            <span style="font-size:15px;">
                                Date:'.$voucher[0]->voucher_date.'
                            </span>
                </li>
            
            
            </div>
        
            <div class="col-md-10 col-md-offset-2" style="padding-left:70px;">
            <h3>Customer Information</h3>
            <table class="table table-bordered" style="margin-top:20px">
                
                    <tr>
                        <td><b>Name:</b></td>
                        <td>'.$voucher[0]->customer_name.'</td>
                    </tr>
                    
                    <tr>
                        <td><b>Phone:</b></td>
                        <td>'.$voucher[0]->customer_phone.'</td>
                    </tr>
                    
                    <tr>
                        <td><b>Email:</b></td>
                        <td>'.$voucher[0]->customer_email.'</td>
                    </tr>
                
            </table>
        </div>
        
        
            <div class="col-md-10 col-md-offset-2" style="padding-left:70px;">
                <h3>Voucher Details</h3>
                <table class="table" style="margin-top:20px">
                
                    <tr>
                        <td style="border:none"><b>Total Space:</b></td>
                        <td style="border:none">'.$voucher[0]->total_places.'</td>
                    </tr>
                    
                    <tr>
                        <td style="border:none"><b>Per Unit Price:</b></td>
                        <td style="border:none"> '.$voucher[0]->per_unit_price.' TK</td>
                    </tr>
                    
                    <tr>
                        <td><b>Total Price:</b></td>
                        <td>'.$voucher[0]->total_price.' TK</td>
                    </tr>
                
            </table>
            </div>
            
            <div class="col-md-12" style="background-color:#232323; color:#fff;padding:16px;">
                <div class="col-md-12" style="text-align:center">
                    Email: info@parkingkoi.net | Phone: +01788-584258
                </div>
            </div>
            
        </div>
        
        
    </div>
</div>';
        
        $this->pdf->loadHtml($output);
        $this->pdf->render();
        $this->pdf->stream("".$id."pdf",array("Attachment"=>0));
        
        
	    
	}
	
	public function pdf_invoice($id){
	    
	    $this->db->select('*');
        $this->db->from('invoice_list');
        $this->db->where('id',$id);
        $this->db->order_by('id', 'Desc');
        $invoice_list= $this->db->get();
        
        // html 
        
        // end html
        $invoice_list =$invoice_list->result();
        // echo "<pre>";
        // print_r($voucher);
        // die;
        
        
        $output ='<div class="content" style="background-color:#fcfcfb !important">
    <div class="container-fluid">
        <div class="wrapper" style="border:1px solid #232323;">
            <div class="col-md-12" style="border-bottom:1px solid #b4b4b4; background-color:#000;color:#fff;padding-bottom:20px;">
                <div class="col-md-2" style="float:left;width:20%">
                <img style="width:200px;height:auto;margin-top:30px;" src="'.base_url().'images/invoice-logo.png">
                </div>
            
                <div class="col-md-6" style="padding-left:60px;float:left;width:35%">
                    <h4>Parking Koi</h4>
                    <address><b>Address:</b>  No# 215 (3rd floor), Merul Badda, Dhaka 1212<br>
                    <b>Phone:</b> +01788-584258<br>
                    <b>E-mail:</b> info@parkingkoi.net
                    </address>
                </div>
            
            
            
                <div class="col-md-4" style="padding-left:80px;padding-top:30px;float:left;width:35%">
                        <p style="font-size:20px;padding-left:15px;">Invoice</p>
                            <span>
                                ID: '.$invoice_list[0]->invoice_id.
                            '</span>
                            <br>
                            <span>
                                Date:'.$invoice_list[0]->invoice_date.'
                            </span>
                </div>
                <p style="float:none;clear:both"></p>
            </div>
        
            <div class="col-md-10 col-md-offset-2" style="padding-left:70px;">
                <div class="row" style="margin:30px 0 30px 0">
                    <div class="col-md-4" style="float:left;width:30%;text-align:left;padding:10px 0">Invoice ID: <b style="font-size:16px">'.$invoice_list[0]->invoice_id.'</b> </div>
                    <div class="col-md-4" style="float:left;width:35%"><span style="text-align:center;border:2px solid red; padding:10px;border-radius:5px;display:block">Money Receipt</span></div>
                    <div class="col-md-4" style="float:left;width:35%;text-align:center;padding:10px 0">Date:'.$invoice_list[0]->invoice_date.'</div>
                    <p style="float:none;clear:both"></p>
                </div>
                
                <div class="row" style="margin:30px 0 30px 0;">
                    <div class="col-md-12" style="padding:20px 0;">
                    
                        <div class="col-md-6" style="width:50%;float:left;">
                            <div class="" style="float:left;width:40%;padding-right:30px !important">Received From:</div> 
                            <div class="" style="float:right;width:60%;border-bottom:1px solid #232323;">'.$invoice_list[0]->name.'</div>
                            <p style="float:none;clear:both"></p>
                        </div>
                    
                        <div class="col-md-6" style="width:50%;float:left;">
                            <div class="col-md-3" style="float:left;width:100%;padding-left:0 !important;text-align:center">
                            of taka<span style="padding:0 40px;margin-left:30px;border-bottom:1px solid #232323;">
                            '.$invoice_list[0]->amount.'
                            </span>
                            </div>
                            
                            
                            <p style="float:none;clear:both"></p>
                        </div>
                        <p style="float:none;clear:both"></p>
                        
                    </div>
                    
                    <div class="col-md-12">
                    
                    For:
                    <span style="padding:0 20%;margin-left:30px;border-bottom:1px solid #232323;">
                    
                    '.$invoice_list[0]->total_place.' place(s)
                    </span>
                    
                    
                    </div>
                    
                </div>
                
                <div class="row" style="margin:30px 0 30px 0">
                    <div class="col-md-6" style="float:left;width:50%">
                    Payment Received In: <span style="font-size:15px;font-weight:bold;font-style:capitalize">'.$invoice_list[0]->type.'</span>
                    </div>
                    
                    <div class="col-md-6" style="float:left;width:50%">
                    <ul style="list-style:none">
                    <li>Total Amount Due:</li>
                    <li>Amount Received:<span style="!important;border-bottom:1px solid #232323;padding:0 10px 0 10px">'.$invoice_list[0]->amount.' <span></li>
                    <li>Balance Due:</li>
                    </div>
                    
                    <p style="float:none;clear:both"></p>
                    
                </div>
            </div>
        
        
            
            
            <div class="col-md-12" style="background-color:#232323; color:#fff;padding:16px;">
                <div class="col-md-12" style="text-align:center">
                    Email: info@parkingkoi.net | Phone: +01788-584258
                </div>
            </div>
            
        </div>
        
        
    </div>
</div>';
        
        
        
        $this->pdf->loadHtml($output);
        $this->pdf->render();
        $this->pdf->stream("".$id."pdf",array("Attachment"=>0));
        
        
	}
	
	
	public function generateRandomString($length = 2) {
    $date = date('Ymds');	
    $characters="";
    for($i=0;$i<=100;$i++){
    	$characters .= $i;
    }


    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $student_id = $date.$randomString;
    return $student_id;
	    
	}
	
	public function send_notification(){
	    if($_POST){
	        $title = $this->input->post('title');
	        $message = $this->input->post('message');
	        
	        
	        header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            $title=$title;
            $message=$message;
            $date=date("Y-m-d");
            $ck="1";
            $token = array();
            $user_device = $this->Dashboard_model->getDeviceCount();
            $user_array_length = count($user_device);
            $split = ceil($user_array_length/1000);
            for($i=1;$i<=$split;$i++ ){
            	$user_device= $this->Dashboard_model->getUserDevicLimit($i);
            	// echo "<pre>";
            	// print_r($user_device);
            	// die;
            	$count = 0;
            	foreach ($user_device as $device) {
            		$token[$count] = $device['device_token']; 
            	$count++;
        		}
            
           
           
            
      			$registrationIds = $token;
   
       			$server_key="AAAAgq5GHAA:APA91bGwzbIWQXe_kKQddTetKoMSJxz_E3GGnpTTI-15gSCgNmsV3HwEm0DLBWWU7ewwCDQBuSWbrgck9lI2Hh36MGU2QnTy7tQRLXxVUp5rHZESIGlIzI2manZNRWIa0RaxrBLX8iXo";
				$url = 'https://fcm.googleapis.com/fcm/send';
				$fields = array('registration_ids' 	=> $registrationIds,
			'notification'=>array('title'=>$title,'body'=>$message,'tag'=>"notification",'sound'=>"DEFOULET",'vibrate'=>1 ));
			 
				$headers = array(
					'Authorization:key =' .$server_key,
					'Content-Type: application/json'
				);
				   $ch = curl_init();
			       curl_setopt($ch, CURLOPT_URL, $url);
			       curl_setopt($ch, CURLOPT_POST, true);
			       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
			       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			       $result = curl_exec($ch);           
			           if ($result === FALSE) {
			              // die('Curl failed: ' . curl_error($ch));
			            // die('not ok');
			            // echo 'false';
			           }else{
			           		// echo $result;
			           		// die;
			           }
			            curl_close($ch);

           }

           // die;
           $inser_array = array(
           		'discription' =>$message,
           		'date' =>$date,
           		'titel' =>$title
           	);
           $this->db->insert('notification',$inser_array);
           redirect('dashboard/send_notification'); 
	    }
	    
	    $data['home_view'] = $this->load->view('Dashboard/notification_form',array(),true);
	    $this->load->view('Dashboard/main_template',$data);
	}


	// public function send_notification(){
	//     if($_POST){
	//         $title = $this->input->post('title');
	//         $message = $this->input->post('message');
	        
	        
	//         header("Access-Control-Allow-Origin: *");
 //            header("Content-Type: application/json; charset=UTF-8");
 //            $title=$title;
 //            $message=$message;
 //            $date=date("Y-m-d");
 //            $ck="1";
 //            // $token = array();
 //            $user_device = $this->Dashboard_model->getDeviceCount();
            
 //            // echo "<pre>";
 //            // print_r($user_device);
 //            // die;
 //            foreach ($user_device as $token) {
 //            	$token[] = $token['device_token'];
            
 //      			$registrationIds = $token;
   
 //       			$server_key="AAAAgq5GHAA:APA91bGwzbIWQXe_kKQddTetKoMSJxz_E3GGnpTTI-15gSCgNmsV3HwEm0DLBWWU7ewwCDQBuSWbrgck9lI2Hh36MGU2QnTy7tQRLXxVUp5rHZESIGlIzI2manZNRWIa0RaxrBLX8iXo";
	// 			$url = 'https://fcm.googleapis.com/fcm/send';
	// 			$fields = array('registration_ids' 	=> $registrationIds,
	// 		'notification'=>array('title'=>$title,'body'=>$message,'tag'=>"notification",'sound'=>"DEFOULET",'vibrate'=>1 ));
			 
	// 			$headers = array(
	// 				'Authorization:key =' .$server_key,
	// 				'Content-Type: application/json'
	// 			);
	// 			   $ch = curl_init();
	// 		       curl_setopt($ch, CURLOPT_URL, $url);
	// 		       curl_setopt($ch, CURLOPT_POST, true);
	// 		       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// 		       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 		       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
	// 		       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// 		       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	// 		       $result = curl_exec($ch);           
	// 		           if ($result === FALSE) {
	// 		              // die('Curl failed: ' . curl_error($ch));
	// 		            // die('not ok');
	// 		            echo 'false';
	// 		           }else{
	// 		           		echo $result;
	// 		           		// die;
	// 		           }
	// 		            curl_close($ch);
	// 		    }
           
 //           die;
 //           // die;
 //           // $inser_array = array(
 //           // 		'discription' =>$message,
 //           // 		'date' =>$date,
 //           // 		'titel' =>$title
 //           // 	);
 //           // $this->db->insert('notification',$inser_array);
 //           redirect('dashboard/send_notification'); 
	//     }
	    
	//     $data['home_view'] = $this->load->view('Dashboard/notification_form',array(),true);
	//     $this->load->view('Dashboard/main_template',$data);
	// }
	
	
	
	
	
	public function guest_list(){
	    $guest_list = $this->Dashboard_model->getGuest();
	    
	    
	    $send_data = array(
	        'guest_list'=> $guest_list
	        );
	    
	    $data['home_view'] = $this->load->view('Dashboard/guest_list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    public function add_guest(){
        if($_POST){
            $start_date = $this->input->post('start_date');
            $start_date = date("Y-m-d", strtotime($start_date));
        
			$guest_array = array(
				"guest_id" => $this->input->post('guest_id'),
				"guest_name" => $this->input->post('guest_name'),
				"start_date" => $start_date,
				"phone" => $this->input->post('phone'),
				"location" => $this->input->post('location'),
				"qty" => $this->input->post('qty'),
				"rent_per_month" => $this->input->post('rpm'),
				"host_id" => $this->input->post('host_id'),
				
				
			);
			$this->db->insert('guest_list',$guest_array);
			redirect('dashboard/guest_list');
		}
		
		
        
        $data['home_view'] = $this->load->view('Dashboard/guest_form',array(),true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    public function host_list(){
	    $host_list = $this->Dashboard_model->getHost();
	    
	    
	    $send_data = array(
	        'host_list'=> $host_list
	        );
	    
	    $data['home_view'] = $this->load->view('Dashboard/host_list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    public function add_host(){
        if($_POST){
            $start_date = $this->input->post('start_date');
            $start_date = date("Y-m-d", strtotime($start_date));
        
            $host_array = array(
                "host_id" => $this->input->post('host_id'),
                "host_name" => $this->input->post('host_name'),
                "start_date" => $start_date,
                "phone" => $this->input->post('phone'),
                "location" => $this->input->post('location'),
                "qty" => $this->input->post('qty'),
                "rent" => $this->input->post('rpm'),
                "guest_id" => $this->input->post('host_id'),
                "advance_payment" => $this->input->post('advance'),
                
                
            );
            $this->db->insert('host_list',$host_array);
            redirect('dashboard/host_list');
        }
        
		
        
        $data['home_view'] = $this->load->view('Dashboard/host_form',array(),true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    
    public function host_payment_list($id){
	    $host_list = $this->Dashboard_model->getHostPayment($id);
	    
	    
	    $send_data = array(
	        'host_list'=> $host_list
	        );
	    
	    $data['home_view'] = $this->load->view('Dashboard/host_payment_list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    public function guest_payment_list($id){
	    $host_list = $this->Dashboard_model->getGuestPayment($id);
	    
	    
	    $send_data = array(
	        'host_list'=> $host_list
	        );
	    
	    $data['home_view'] = $this->load->view('Dashboard/guest_payment_list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    
    
    public function add_host_payment($id=""){
        
        if($_POST){
            $payment_date = $this->input->post('payment_date');
            $payment_date = date("Y-m-d", strtotime($payment_date));
        
            $host_array = array(
                "status" => $this->input->post('status'),
                "host_id" => $this->input->post('host_id'),
                "payment_month" => $this->input->post('payment_month'),
                "payment_year" => $this->input->post('payment_year'),
                "payment_date" => $payment_date,
                "amount" => $this->input->post('amount')
                
                
            );
            
            $this->db->insert('host_payment',$host_array);
            $this->host_payment_list($this->input->post('host_id'));
        }
        
		$send_data = array(
		    'host_id'=> $id
		    );
        
        $data['home_view'] = $this->load->view('Dashboard/host_payment_form',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    
    public function add_guest_payment($id=""){
        
        if($_POST){
            $payment_date = $this->input->post('payment_date');
            $payment_date = date("Y-m-d", strtotime($payment_date));
        
            $guest_array = array(
                "status" => $this->input->post('status'),
                "guest_id" => $this->input->post('guest_id'),
                "payment_month" => $this->input->post('payment_month'),
                "payment_year" => $this->input->post('payment_year'),
                "payment_date" => $payment_date,
                "amount" => $this->input->post('amount')
                
                
            );
            
            $this->db->insert('guest_payment',$guest_array);
            $this->guest_payment_list($this->input->post('guest_id'));
        }
        
		$send_data = array(
		    'guest_id'=> $id
		    );
        
        $data['home_view'] = $this->load->view('Dashboard/gueset_payment_form',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }

    public function lead_management(){
        $lead_list = $this->Dashboard_model->LeadList();
	    
	    
	    $send_data = array(
	        'lead_list'=> $lead_list
	        );
	    
	    $data['home_view'] = $this->load->view('Dashboard/lead_list',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
    }
    
    public function add_lead(){
        $data['home_view'] = $this->load->view('Dashboard/lead-form',array(),true);
	    $this->load->view('Dashboard/main_template',$data);
	    
    }
    
    public function submit_lead(){
        if($_POST){
        	date_default_timezone_set("Asia/Dhaka");
        	$created_at = date("Y-m-d H:i:s"); 
            $insert_array = array(
                "location" => $this->input->post('location'),
                "number_of_parking" => $this->input->post('qty'),
                "name" => $this->input->post('name'),
                "email" => $this->input->post('email'),
                "phone" => $this->input->post('phone'),
                "address" => $this->input->post('address'),
                "status" => $this->input->post('status'),
                "comment" => $this->input->post('comment'),
                "lead_type" =>$this->input->post('lead_type'),
                "vehicle_type" =>$this->input->post('vehicle_type'),
                "priority" =>$this->input->post('priority'),
                "created_at" => $created_at
                );
            $this->db->insert('lead_list',$insert_array);
            redirect('dashboard/lead_management');
        }
    }
    
    public function delete_lead($id){
        $data = array(
        'id' =>$id,
        );

	$this->db->delete('lead_list', $data);
	redirect('dashboard/lead_management');
    }
    
    public function edit_lead($id=""){
        if($_POST){
            $update_array = array(
                "location" => $this->input->post('location'),
                "number_of_parking" => $this->input->post('qty'),
                "name" => $this->input->post('name'),
                "email" => $this->input->post('email'),
                "phone" => $this->input->post('phone'),
                "address" => $this->input->post('address'),
                "status" => $this->input->post('status'),
                "comment" => $this->input->post('comment'),
                "lead_type" =>$this->input->post('lead_type'),
                "vehicle_type" =>$this->input->post('vehicle_type'),
                "priority" =>$this->input->post('priority'),
                
            );
            
        $this->db->where('id', $this->input->post('lead_id'));
	    $this->db->update('lead_list', $update_array);
	    redirect('dashboard/lead_management');
        }
        $get_edit_list = $this->Dashboard_model->lead_user($id);
        $send_data = array(
            "lead" => $get_edit_list
            );
            
        $data['home_view'] = $this->load->view('Dashboard/edit_lead',$send_data,true);
	    $this->load->view('Dashboard/main_template',$data);
        
    }



    public function live_track(){
        $online_user = $this->User_track_model->getOnlineUser();
        $send_data = array(
            "user_track" => $online_user,
           
        );
        $data['home_view']= $this->load->view('Dashboard/user_track',$send_data,true);
        $this->load->view('Dashboard/main_template',$data);
    }
    public function GetOnlineUsersList()
    {
        # code...
        $requestData = $_REQUEST;
           
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'mobile',
            3 => 'online_time',
            4 => 'location',
            5 => 'date',
           );
       $sql = "SELECT * FROM user_track WHERE of_status = 1 ORDER BY id DESC";
       $data = $this->db->query($sql);
        $query = $data->result();
       
        $totalData = $this->db->query("SELECT count(id) as id FROM `user_track`");
        $totalData = $totalData->result();
        $totalData = $totalData[0]->id;
     
       $totalFiltered = $totalData;
       
       $totalFiltered = count($query);
       $sql .= "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
       
       $data = $this->db->query($sql);
        $query = $data->result_array();
     
       
       $data = array();
       $cnt = $requestData['start'] + 1;
       
     
        foreach ($query as $dt) {
            if(!empty($dt['file_exist'])){
                $download_button = "<i onClick='javascript:this.parentNode.submit();' style='cursor:pointer;' class='fa fa-play-circle fa-2x' aria-hidden='true' title='Play recorded file'></i>";
            }
            $nestedData = array();
            $nestedData[] = $dt['id'];
            $nestedData[] = $dt['name'];
            $nestedData[] = $dt['mobile'];
            $nestedData[] = $dt['online_time'];
            $nestedData[] = $dt['location'];
            $nestedData[] = $dt['date'];
            $data[] = $nestedData;
        }
       
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
 
        echo json_encode($json_data);
    }
	public function index()
    {
    if($this->session->userdata('user_id')){
    $today = date("Y-m-d");
   
    // last 7 days
   
        $m= date("m");
 
        $de= date("d");
   
        $y= date("Y");
   
        for($i=0; $i<=24; $i++){
   
        $day[$i] = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y));
   
        }
        $getDailyHit= $this->Dashboard_model->getDailyHit($today);
       	
       
        // if(isset($getDailyHit)&&!empty($getDailyHit)){
        // $current_hit =  $getDailyHit[0]["hit"];
        // }
 
        if(!empty($getDailyHit)){
        $current_hit =  $getDailyHit[0]["hit"];
        }else{
            $current_hit = 0;
        }

        $todays_parking = $this->Dashboard_model->todays_parking($today);
        $todays_parking = count($todays_parking);
        $current_hit = $current_hit+$todays_parking;


        // echo $current_hit;
        // die;
       
        $weeklyTotalUser = $this->Dashboard_model->getweeklyUser($day);
        $weeklyTotalSlot = $this->Dashboard_model->getweeklySlot($day);
       
        $weekpyPlace = count($weeklyTotalUser );
       
        $weeklyTransaction = $this->Dashboard_model->getweeklyTransaction($day);
        $numberOfTransaction = count($weeklyTransaction );
       	$weeklyParkingTransaction = $this->Dashboard_model->getweeklyParkingTransaction($day);
        // echo "<pre>";
        // print_r($weeklyParkingTransaction);
        // die;
        $numberOfTransaction = count($weeklyTransaction );
        $numberOfParkingTransaction = count($weeklyParkingTransaction );
        // echo $numberOfParkingTransaction;
        // die;
        $numberOfTransaction = $numberOfTransaction + $numberOfParkingTransaction;
        $total_active_user = $this->Dashboard_model->get_total_active_user();
        $total_parking_user = $this->Dashboard_model->get_total_parking_user();
        $total_parking_user = count($total_parking_user);

        $total_user = count($total_active_user);
        $total_user = $total_parking_user + $total_user;
 		
        $public_place = $this->Dashboard_model->get_total_public_place();
       
        $total_public_place = count($public_place);
 
        $private_place = $this->Dashboard_model->get_total_private_place();
       
        $total_private_place = count($private_place);
        $total_private_slot =0;
        $total_public_slot =0;
        $weeklyTotalTransaction = 0;
         $weeklyTotalParkingTransaction = 0;
        $weekly_Total_Slot = 0;
       
        foreach ($weeklyTotalSlot as $weeklyslot)
            {
               
                $weekly_Total_Slot += (double)$weeklyslot['total_slot'];
               
            }
           
        foreach ($weeklyTransaction as $weeklyT)
            {
               
                $weeklyTotalTransaction += (double)$weeklyT['cost'];
               
            }

            foreach ($weeklyParkingTransaction as $weeklyPTrans)
            {
               
                $weeklyTotalParkingTransaction += (double)$weeklyPTrans['price'];
               
            }

            $weeklyTotalTransaction = (int)$weeklyTotalTransaction + (int)$weeklyTotalParkingTransaction;
           
            foreach ($private_place as $private)
            {
               
                $total_private_slot += (double)$private['total_slot'];
               
            }
           
            foreach ($public_place as $public)
            {
               
                $total_public_slot += (double)$public['total_slot'];
               
            }
           
            // if(!isset($urrent_hit)){
            //        $current_hit = 0;
            // }
            $send_data = array(
            "total_user" => $total_user,
            "total_public_place"=>$total_public_place,
            "total_private_place"=>$total_private_place,
            "total_public_slot" => $total_public_slot,
            "total_private_slot" => $total_private_slot,
            "weeklyNumberOfTransaction"=>$numberOfTransaction,
            "weeklyTotalTransaction" =>$weeklyTotalTransaction,
            "weekly_Total_Slot" => $weekly_Total_Slot,
            "weekpyPlace"=>$weekpyPlace,
            "current_hit" => $current_hit  
        );
        //echo "<pre>"; print_r($send_data['private_place']); exit;
        $data['home_view'] = $this->load->view('Dashboard/dashboard_view',$send_data,true);
        $this->load->view('Dashboard/main_template',$data);
        }else{
        redirect('login');
        }
    }
 
	public function GetPrivateParkingList()
    {
        # code...
        $requestData = $_REQUEST;
           
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'total_slot',
            3 => 'cost',
            4 => 'mobile',
            5 => 'local',
           );
       $sql = "SELECT places.id AS place_id, places.name, places.email, places.cost, places.local, places.total_slot, places.division, places.image1, users.mobile, places.date AS place_date FROM places JOIN users ON places.email = users.email WHERE places.cost != 'free*' AND places.status!= 'admin'";
   
   
       
         $data = $this->db->query($sql);
        $query = $data->result_array();
       
        $totalData = $this->db->query("SELECT count(id) as id FROM `places`");
        $totalData = $totalData->result();
        $totalData = $totalData[0]->id;
     
	       $totalFiltered = $totalData;
	       
	       $totalFiltered = count($query);
	       $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length length
	       
	       $data = $this->db->query($sql);
	        $query = $data->result_array();
	     
	       
	       $data = array();
	       $cnt = $requestData['start'] + 1;
	       
	     
	        foreach ($query as $dt) {
	 
	            //$button =
	            $id = $dt['place_id'];
	            $nestedData = array();
	            $nestedData[] = $cnt++;
	            $nestedData[] = $dt['name'];
	            $nestedData[] = $dt['total_slot'];
	            $nestedData[] = $dt['cost'];
	            $nestedData[] = $dt['mobile'];
	            $nestedData[] = $dt['local'];
	            $nestedData[] = "<a href='".base_url()."dashboard/edit_place_private".'/'.$id."'>Edit</a> <a href='".base_url()."dashboard/delete_place_private_public".'/'.$id."'>Delete</a>";
	           
	            $data[] = $nestedData;
	        }
	       
	        $json_data = array(
	            "draw" => intval($requestData['draw']),
	            "recordsTotal" => intval($totalData),
	            "recordsFiltered" => intval($totalFiltered),
	            "data" => $data
	        );
	 
	        echo json_encode($json_data);
    }

    public function GetPublicParkingList()
    {
        # code...
        $requestData = $_REQUEST;
           
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'total_slot',
            3 => 'cost',
            4 => 'mobile',
            5 => 'local',
           );
       $sql = "SELECT places.id AS place_id, places.name, places.email, places.cost, places.local, places.total_slot, places.division, places.image1, users.mobile, places.date AS place_date FROM places JOIN users ON places.email = users.email WHERE places.cost = 'free*' AND places.status!= 'admin'";
   
   
       
         $data = $this->db->query($sql);
        $query = $data->result_array();
       
        $totalData = $this->db->query("SELECT count(id) as id FROM `places`");
        $totalData = $totalData->result();
        $totalData = $totalData[0]->id;
     
       $totalFiltered = $totalData;
       
       $totalFiltered = count($query);
       $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length length
       
       $data = $this->db->query($sql);
        $query = $data->result_array();
     
       
       $data = array();
       $cnt = $requestData['start'] + 1;
       
     
        foreach ($query as $dt) {
 
            //$button =
            $id = $dt['place_id'];
            $nestedData = array();
            $nestedData[] = $cnt++;
            $nestedData[] = $dt['name'];
            $nestedData[] = $dt['total_slot'];
            $nestedData[] = $dt['cost'];
            $nestedData[] = $dt['mobile'];
            $nestedData[] = $dt['local'];
            $nestedData[] = "<a href='".base_url()."dashboard/edit_place_private".'/'.$id."'>Edit</a> <a href='".base_url()."dashboard/delete_place_private_public".'/'.$id."'>Delete</a>";
           
            $data[] = $nestedData;
        }
       
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
 
        echo json_encode($json_data);
    }
	   

	   public function GetDivisionSpecificPlaceDhaka() // For Dhaka @nadim
	{
		# code...
		# code...
        $requestData = $_REQUEST;
           
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'cost',
            4 => 'mobile',
            5 => 'local',
            6 => 'place_date',
           );
		   $sql = "SELECT places.id AS place_id, places.name, places.email, places.cost, places.local, places.total_slot, places.division, places.image1, users.mobile, places.date AS place_date FROM places JOIN users ON places.email = users.email WHERE places.status!= 'admin' AND places.division = 'Dhaka'";
   
   
       
		   $data = $this->db->query($sql);
		  $query = $data->result_array();
		 
		  $totalData = $this->db->query("SELECT count(id) as id FROM `places`");
		  $totalData = $totalData->result();
		  $totalData = $totalData[0]->id;
	   
		 $totalFiltered = $totalData;
		 
		 $totalFiltered = count($query);
		 $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length length
		 
		 $data = $this->db->query($sql);
		  $query = $data->result_array();
       
       $data = array();
       $cnt = $requestData['start'] + 1;
       
     
        foreach ($query as $dt) {
			$cost = $dt['cost'];
			$id = $dt['place_id'];
            $nestedData = array();
			$nestedData[] = $cnt++;
            $nestedData[] = $dt['name'];
			$nestedData[] = $dt['email'];
			if($cost != 'free*'){

				$nestedData[] = $cost.' BDT';
			}else{

				$nestedData[] = $cost;
			}
            
            $nestedData[] = $dt['mobile'];
            $nestedData[] = $dt['local'].','.$dt['division'];
            $nestedData[] = $dt['place_date'];
            $nestedData[] = "<a href='".base_url()."dashboard/delete_place".'/'.$id."'>Delete</a>";;
            $data[] = $nestedData;
        }
       
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
 
        echo json_encode($json_data);
	}
	public function AllPlacesListCtgDivision() // For Ctg @nadim
	{
		# code...
		# code...
        $requestData = $_REQUEST;
           
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'cost',
            4 => 'mobile',
            5 => 'local',
            6 => 'place_date',
           );
		   $sql = "SELECT places.id AS place_id, places.name, places.email, places.cost, places.local, places.total_slot, places.division, places.image1, users.mobile, places.date AS place_date FROM places JOIN users ON places.email = users.email WHERE places.status!= 'admin' AND places.division = 'chittagong'";
   
   
       
		   $data = $this->db->query($sql);
		  $query = $data->result_array();
		 
		  $totalData = $this->db->query("SELECT count(id) as id FROM `places`");
		  $totalData = $totalData->result();
		  $totalData = $totalData[0]->id;
	   
		 $totalFiltered = $totalData;
		 
		 $totalFiltered = count($query);
		 $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length length
		 
		 $data = $this->db->query($sql);
		  $query = $data->result_array();
       
       $data = array();
       $cnt = $requestData['start'] + 1;
       
     
        foreach ($query as $dt) {
			$cost = $dt['cost'];
			$id = $dt['place_id'];
            $nestedData = array();
			$nestedData[] = $cnt++;
            $nestedData[] = $dt['name'];
			$nestedData[] = $dt['email'];
			if($cost != 'free*'){

				$nestedData[] = $cost.' BDT';
			}else{

				$nestedData[] = $cost;
			}
            
            $nestedData[] = $dt['mobile'];
            $nestedData[] = $dt['local'].','.$dt['division'];
            $nestedData[] = $dt['place_date'];
            $nestedData[] = "<a href='".base_url()."dashboard/delete_place".'/'.$id."'>Delete</a>";;
            $data[] = $nestedData;
        }
       
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
 
        echo json_encode($json_data);
	}
	public function AllPlacesListSylhetDivision() // For Sylhet @nadim
	{
		# code...
		# code...
        $requestData = $_REQUEST;
           
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'cost',
            4 => 'mobile',
            5 => 'local',
            6 => 'place_date',
           );
		   $sql = "SELECT places.id AS place_id, places.name, places.email, places.cost, places.local, places.total_slot, places.division, places.image1, users.mobile, places.date AS place_date FROM places JOIN users ON places.email = users.email WHERE places.status!= 'admin' AND places.division = 'sylhet'";
   
   
       
		   $data = $this->db->query($sql);
		  $query = $data->result_array();
		 
		  $totalData = $this->db->query("SELECT count(id) as id FROM `places`");
		  $totalData = $totalData->result();
		  $totalData = $totalData[0]->id;
	   
		 $totalFiltered = $totalData;
		 
		 $totalFiltered = count($query);
		 $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length length
		 
		 $data = $this->db->query($sql);
		  $query = $data->result_array();
       
       $data = array();
       $cnt = $requestData['start'] + 1;
       
     
        foreach ($query as $dt) {
			$cost = $dt['cost'];
			$id = $dt['place_id'];
            $nestedData = array();
			$nestedData[] = $cnt++;
            $nestedData[] = $dt['name'];
			$nestedData[] = $dt['email'];
			if($cost != 'free*'){

				$nestedData[] = $cost.' BDT';
			}else{

				$nestedData[] = $cost;
			}
            
            $nestedData[] = $dt['mobile'];
            $nestedData[] = $dt['local'].','.$dt['division'];
            $nestedData[] = $dt['place_date'];
            $nestedData[] = "<a href='".base_url()."dashboard/delete_place".'/'.$id."'>Delete</a>";
            $data[] = $nestedData;
        }
       
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
 
        echo json_encode($json_data);
	}
	    
	    
	public function get_allPlaces(){
        

        $places =  $this->Dashboard_model->get_all_places_forbd();
        

        echo json_encode($places);
    }

}
