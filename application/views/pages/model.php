<?php
class Dashboard_model extends CI_Model {



    public function gettoolbox()
    {
        $this->db->order_by("date", "DESC");
        $all_tool_data = $this->db->get('service_request');
        if($all_tool_data->num_rows()>0){

            return $all_tool_data->result();
        }else{
            return false;
        }
    } 


    // ----------------------

    public function get_login_history(){
            $this->db->select('*');
            $this->db->from('company_user_list');
            $this->db->order_by('last_login', 'Desc');
            $total_user = $this->db->get();
            return $total_user->result_array();
    }
    // 9th may

    public function get_hourly_transaction_request(){
            $this->db->select('*');
            $this->db->from('transaction_history');
            $this->db->order_by('id', 'Desc');
            $total_user = $this->db->get();
            return $total_user->result_array();
        }

    public function get_promo_user_list(){
            $this->db->select('
                promo_list.promo_code,
                promo_user_list.*
                ');
            $this->db->from('promo_user_list');
            $this->db->join('promo_list', 'promo_user_list.promo_id = promo_list.id');
            $this->db->order_by('id', 'Desc');
            $total_user = $this->db->get();
            return $total_user->result_array();
        }

        public function get_promo_list(){
            $this->db->select('*');
            $this->db->from('promo_list');
            $this->db->order_by('id', 'Desc');
            $total_user = $this->db->get();
            return $total_user->result_array();
        }

        public function get_specific_promo($id){
            $this->db->select('*');
            $this->db->from('promo_list');
            $this->db->where('id',$id);
            $total_user = $this->db->get();
            return $total_user->result_array();
        }

        // end 9th may

    public function get_specific_user($id)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $id);
            $total_user = $this->db->get();
            return $total_user->result_array();
        }

        public function get_total_active_user()
        {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('id', 'Desc');
		$total_user = $this->db->get();
		return $total_user->result_array();
        }

        public function get_total_parking_user()
        {
        $sql = "SELECT DISTINCT user_id FROM end_live_parking";
        $result = $this->db->query($sql);
        return $result->result_array();
        }

        public function todays_parking($date){
                $this->db->select('*');
                $this->db->from('end_live_parking');
                $this->db->where('date', $date);
                $todays_parking = $this->db->get();
                return $todays_parking->result_array();
        }

	public function getweeklyTransaction($data)
        {
        $this->db->select('*');
	        $this->db->from('transjection');
	        if(!empty($data[4])&& $data[4]!="1970-01-01")
	        {
	            $this->db->where('time>= ', $data[4]);
	        }
	        if(!empty($data[0])&& $data[0]!="1970-01-01")
	        {
	            $this->db->where('time<= ', $data[0]);
	        }
	        $weeklyReport= $this->db->get();
	        return $weeklyReport->result_array();
        }

        public function getweeklyParkingTransaction($data)
        {       

                $this->db->select('price');
                $this->db->from('end_live_parking');
                if(!empty($data[4])&& $data[4]!="1970-01-01")
                {
                    $this->db->where('date>= ', $data[4]);
                }
                if(!empty($data[0])&& $data[0]!="1970-01-01")
                {
                    $this->db->where('date<= ', $data[0]);
                }
                $weeklyReport= $this->db->get();
                return $weeklyReport->result_array();
        }
        
        public function getweeklySlot($data)
        {
        $this->db->select('*');
	        $this->db->from('places');
	        if(!empty($data[12])&& $data[12]!="1970-01-01")
	        {
	            $this->db->where('date>= ', $data[12]);
	        }
	        if(!empty($data[0])&& $data[0]!="1970-01-01")
	        {
	            $this->db->where('date<= ', $data[0]);
	        }
	        $weeklyslot= $this->db->get();
	        return $weeklyslot->result_array();
        }
        
        public function getweeklyUser($data)
        {
            $this->db->select('*');
            $this->db->group_by('user_id');
	        $this->db->from('end_live_parking');
	        if(!empty($data[12])&& $data[12]!="1970-01-01")
	        {
	            $this->db->where('date>= ', $data[12]);
	        }
	        if(!empty($data[0])&& $data[0]!="1970-01-01")
	        {
	            $this->db->where('date<= ', $data[0]);
	        }
	        $weeklyuser= $this->db->get();
	        return $weeklyuser->result_array();
        }
        
        public function getDailyHit($data)
        {
        	$this->db->select('hit');
	        $this->db->from('user_hit');
	        if(!empty($data)&& $data!="1970-01-01")
	        {
	            $this->db->where('date', $data);
	        }
	        
	        $dailyHit= $this->db->get();
	        return $dailyHit->result_array();
        }
        
       
        
        public function get_total_place_area($division)
        {
        $this->db->select('

        places.id as place_id,
        places.name,
        places.email,
        places.cost,
        places.local,
        places.total_slot,
        places.division,
        places.image1,
        users.mobile,
        places.date as place_date

        ');
        $this->db->from('places');
        $this->db->join('users', 'places.email = users.email');
        $this->db->where('division',$division);
        $this->db->where('status!=','admin');
        $this->db->order_by('places.id', 'Desc');
                $total_public_place = $this->db->get();
                $data = $total_public_place->result_array();
        return $data;
        }
        
        
        
        
        

        public function get_total_public_place()
        {
        $this->db->select('

        places.id as place_id,
        places.name,
        places.email,
        places.cost,
        places.local,
        places.total_slot,
        places.division,
        places.image1,
        users.mobile,
        places.date as place_date

        ');
        $this->db->from('places');
        $this->db->join('users', 'places.email = users.email');
        $this->db->where('cost','free*');
        $this->db->where('status!=','admin');
        $this->db->order_by('places.id', 'Desc');
		$total_public_place = $this->db->get();
		$data = $total_public_place->result_array();
        return $data;
        }

        public function get_total_private_place()
        {
        $this->db->select('
        places.id as place_id,
        places.name,
        places.email,
        places.cost,
        places.local,
        places.total_slot,
        places.division,
        places.image1,
        users.mobile,
        places.date as place_date
        ');
        $this->db->from('places');
        $this->db->join('users', 'places.email = users.email');
	$this->db->where('cost!=','free*');
        $this->db->where('status!=','admin');
        $this->db->order_by('places.id', 'Desc');
	$total_public_place = $this->db->get();
	return $total_public_place->result_array();
        }


        public function get_total_pending_place()
        {
        $this->db->select('
        places.id as place_id,
        places.name,
        places.email,
        places.cost,
        places.local,
        places.division,
        places.image1,
        users.mobile,
        places.date as place_date,
        places.comment as comment
        ');
        $this->db->from('places');
        $this->db->join('users', 'places.email = users.email');
        $this->db->where('status','admin');
        $this->db->order_by('places.id', 'Desc');
        $total_pending_place = $this->db->get();
        return $total_pending_place->result_array();
        }

        public function get_total_transaction()
        {
        $this->db->select('*');
        $this->db->from('transjection');
        $this->db->order_by('id', 'Desc');
		$transactoin = $this->db->get();
		return $transactoin->result_array();
        }
        
        public function get_monthly_request()
        {
        $this->db->select('*');
        $this->db->from('tbl_monthly');
        $this->db->where('status','0');
        $this->db->order_by('id', 'Desc');
        $monthly_request = $this->db->get();
        return $monthly_request->result_array();
        }

	public function approve($id){
	$data = array(
        'status' =>"available",
        );

	$this->db->where('id', $id);
	$this->db->update('places', $data);
	}
	
	
	
	public function delete($id){
	$data = array(
        'id' =>$id,
        );

	$this->db->delete('places', $data);
	}
	
    
	public function get_edit_place($id){
	$this->db->select('*');
        $this->db->from('places');
        $this->db->where('id', $id);
        $admin= $this->db->get();
        return $admin->result_array();
	        
	}
	
	public function checkValidUser($email,$pass){
	$this->db->select('*');
        $this->db->from('company_user_list');
        $this->db->where('email', $email);
        $this->db->where('password', $pass);
        $admin= $this->db->get();
        return $admin->result_array();
	}

        public function getMonthlyBooking(){
        $this->db->select('*');
        $this->db->from('book_monthly');
        $this->db->order_by('id', 'Desc');
        $monthly_booking= $this->db->get();
        return $monthly_booking->result_array();
        }

        public function getCustomer(){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->order_by('id', 'Desc');
        $customer= $this->db->get();
        return $customer->result_array();
        }
        
        public function getGuest(){
        $this->db->select('*');
        $this->db->from('guest_list');
        $this->db->order_by('id', 'Desc');
        $guest= $this->db->get();
        return $guest->result_array();
        }
        
        public function getHost(){
        $this->db->select('*');
        $this->db->from('host_list');
        $this->db->order_by('id', 'Desc');
        $host= $this->db->get();
        return $host->result_array();
        }
        
        public function getHostPayment($id){
        $this->db->select('*');
        $this->db->from('host_payment');
        $this->db->where('host_id',$id);
        $this->db->order_by('id', 'Desc');
        $host= $this->db->get();
        return $host->result_array();
        }
        
        public function getGuestPayment($id){
        $this->db->select('*');
        $this->db->from('guest_payment');
        $this->db->where('guest_id',$id);
        $this->db->order_by('id', 'Desc');
        $host= $this->db->get();
        return $host->result_array();
        }

        public function getEmployee(){
        $this->db->select('*');
        $this->db->from('employees');
        $this->db->order_by('id', 'Desc');
        $employees= $this->db->get();
        return $employees->result_array();
        }

        public function getnNotifications(){
        $this->db->select('*');
        $this->db->from('notification_to_send');
        $this->db->order_by('id', 'Desc');
        $notifications= $this->db->get();
        return $notifications->result_array();
        }

        public function getDeviceCount(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('id', 'Desc');
        $employees= $this->db->get();
        return $employees->result_array();
        }

        public function getUserDevice(){
        $this->db->select('device_token');
        $this->db->limit(1000);
        $this->db->from('users');
        $this->db->order_by('id', 'Desc');
        $employees= $this->db->get();
        return $employees->result_array();
        }

        public function getUserDevicLimit($offset){

        if($offset == 1){
        $this->db->select('*');
        $this->db->limit(1000);
        $this->db->from('users');
        $employees= $this->db->get();
            
        }else{
        $offset = (1000*$offset)-1000;
        

        $this->db->select('*');
        $this->db->limit(1000,$offset);
        $this->db->from('users');
        $employees= $this->db->get();
        // return $employees->result_array();
        }
        return $employees->result_array(); 
        }


        public function LeadList(){
        $this->db->select('*');
        $this->db->from('lead_list');
        $this->db->order_by('id', 'Desc');
        $lead= $this->db->get();
        return $lead->result_array();
        }

        public function lead_user($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('lead_list');
        $this->db->order_by('id', 'Desc');
        $lead= $this->db->get();
        return $lead->row_array();
        }


	public function get_all_places_forbd(){
        $this->db->select('*');
        $this->db->from('places');
        $this->db->order_by('id', 'Desc');
        $places = $this->db->get();
        return $places->row_array();
        } 


        

        

}

?>