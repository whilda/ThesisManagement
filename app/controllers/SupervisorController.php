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
		if(Input::has('name')&&Input::has('description')&&Request::ajax()){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"name"=>Input::get('name'),
				"description"=>Input::get('description'),
			);
			$data_string=json_encode($data);
			$json=REST::POSTRequest('su/savefield',$data_string);
			$output=json_decode($json,true);
			return $json;
		}else{
			return "Internal Server Error";
		}
	}
	public function delField(){
		if(Request::ajax()&&Input::has("names")){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get("token"),
			);
			$deleted=Input::get("names");
			$retval=1;
			foreach($deleted as $name){
				$data["name"]=$name;
				$data_string=json_encode($data);
				$output=REST::POSTRequest('su/deletefield',$data_string);
				$output=json_decode($output,true);
				if(!(isset($output["code"])&&$output['code']==1)){
					$retval=-1;
				}
			}
			return $retval;
		}
		return -1;
	}
	public function Profile(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			$data_output['data']=json_decode($data_output['data'],true);
			return View::make('supervisor/profile', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function EditProfile(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			$data_output['data']=json_decode($data_output['data'],true);
			return View::make('supervisor/editProfile', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function SaveProfile(){
		if(Request::ajax()&&Input::has("address")&&Input::has("handphone")&&Input::has("email")&&Input::has("field")){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get("token"),
				"address"=>Input::get("address"),
				"handphone"=>Input::get("handphone"),
				"email"=>Input::get("email"),
				"field"=>Input::get("field")
			);
			$data_string=json_encode($data);
			$output=REST::POSTRequest("su/editprofile",$data_string);
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
		$path="su/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
}
