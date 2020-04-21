<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class First extends CI_Controller {

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
	public function pagination(){
		$all['books'] = $this->get_monthly_place_list();
		$all['num_ids'] = $this->num_id();
		// echo "<pre>";
		// print_r($all);
		$this->load->view('pages/pagination', $all);
	}



	public function index()
	{
		//$this->load->view('includes/header_first');
        $this->load->view('pages/newpage');
        
	}
	public function country_selection(){

		$bd = $this->input->post('selcetion');


		redirect($bd);

	}

	public function Admin(){

		$all['all_places'] = $this->get_place_list_form_amzan();
		$all['all_places2'] = $this->get_place_list_form_amzan();

		$this->load->view('pages/admin', $all);

		// echo "<pre>";

		// print_r($all);
	}



	public function get_place_list_form_amzan(){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://parkingkoi.xyz/admin/Dashboard/get_allPlaces',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);
        
        $resp = curl_exec($curl);
        
        curl_close($curl);
        
        $place_array = json_decode($resp);
        
        return $place_array;
    }











	public function get_monthly_place_list(){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost/parkingkoi_bd/AdminToolBox/admin_p',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);
        
        $resp = curl_exec($curl);
        
        curl_close($curl);
        
        $place_array = json_decode($resp);
        
        return $place_array;
    }

    

    public function num_id(){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost/parkingkoi_bd/AdminToolBox/count_id',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);
        
        $resp = curl_exec($curl);
        
        curl_close($curl);
        
        $place_array = json_decode($resp);
        
        return $place_array;
    }
}
