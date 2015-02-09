<?php

class StudentController extends Controller {
	 
	public function home(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			$data_output['data']=json_decode($data_output['data'],true);
			return View::make('student/dashboard', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function getData(){
		$path="s/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
}
