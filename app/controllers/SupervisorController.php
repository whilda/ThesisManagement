<?php

class SupervisorController extends Controller {
	 
	public function home(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			$data_output['data']=json_decode($data_output['data'],true);
			return View::make('student/dashboard', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function addField(){
		if(Input::has('name')&&Input::has('description')){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"name"=>Input::get('name'),
				"description"=>Input::get('description'),
			);
			$data_string=json_encode($data);
			$json=REST::POSTRequest('f/savefield',$data_string);
			$output=json_decode($json,true);
			if(isset($output['code'])&&$output['code']==1){
				return "Sukses";
			}else{
				return "Internal Server Error";
			}
		}
	}
	public function getData(){
		$path="su/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
}
