<?php
class Demo extends CI_Controller{

	function __construct(){ 
		parent::__construct();
	} 
	function url($url1 = '',$url2 = '',$url3 = ''){
		
		$this->session->set_flashdata('gagal','INI HANYA DEMO');

		redirect(base_url(@$url1.'/'.@$url2.'/'.@$url3));
	} 
	function test(){

		$curl = curl_init();

		$pesan = [
		  "messageType" => "text",
		  "to" => "085855011542",
		  "body" => "testest",
		  "delay" => 10,
		  "schedule" => 1665408510000
		];

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.starsender.online/api/send',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => json_encode($pesan),
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type:application/json',
		    'Authorization: 85083166-578b-43b8-b7f3-3cb15437bbf7'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}
}