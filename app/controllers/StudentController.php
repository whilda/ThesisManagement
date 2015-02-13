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
	public function Profile(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			$data_output['data']=json_decode($data_output['data'],true);
			return View::make('student/profile', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function EditProfile(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			$data_output['data']=json_decode($data_output['data'],true);
			return View::make('student/editProfile', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function EditThesis(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			$data_output['data']=json_decode($data_output['data'],true);
			return View::make('student/thesis', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function SaveThesis(){
		if(Request::ajax()&&Input::has("topic")&&Input::has("title")&&Input::has("description")&&Input::has("field")){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get("token"),
				"topic"=>Input::get("topic"),
				"title"=>Input::get("title"),
				"description"=>Input::get("description"),
				"field"=>Input::get("field")
			);
			$data_string=json_encode($data);
			$output=REST::POSTRequest("s/savethesis",$data_string);
			$output=json_decode($output,true);
			if(isset($output["code"])&&$output["code"]==1){
				return 1;
			}else{
				return -1;
			}
		}else{
			return -1;
		}
	}
	public function SupervisorList(){
		$output=REST::GETRequest("su/getall/".REST::$appkey."/".Session::get('token'));
		$output=json_decode($output,true);
		if(isset($output["code"])&&$output["code"]!=-1){
			$output['data']=json_decode($output['data'],true);
			return View::make('student/supervisorList',array('data'=>$output['data']));
		}else{
			return View::make('student/supervisorList')->with('data',array());
		}
	}
	public function SupervisorView($supervisor){
		$output=REST::GETRequest("su/get/".$supervisor."/".REST::$appkey."/".Session::get('token'));
		$output=json_decode($output,true);
		if(isset($output["code"])&&$output["code"]!=-1){
			if($output["code"]==1){
				$output['data']=json_decode($output['data'],true);
				return View::make('student/supervisor',array('data'=>$output['data']));
			}else if($output["code"]==0){
				return "Supervisor not found";
			}
		}else{
			return "Internal Server Error";
		}
	}
	public function SaveProfile(){
		if(Request::ajax()&&Input::has("address")&&Input::has("handphone")&&Input::has("email")){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get("token"),
				"address"=>Input::get("address"),
				"handphone"=>Input::get("handphone"),
				"email"=>Input::get("email")
			);
			$data_string=json_encode($data);
			$output=REST::POSTRequest("s/editprofile",$data_string);
			$output=json_decode($output,true);
			if(isset($output["code"])&&$output["code"]==1){
				return 1;
			}else{
				return -1;
			}
		}else{
			return -1;
		}
	}
	public function getData(){
		$path="s/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
}
