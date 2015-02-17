<?php

class SupervisorController extends Controller {
	 
	public function home(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
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
			return View::make('supervisor/profile', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function EditProfile(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
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
	public function ProposalList($page=1){
		$supervisor=$this->getData();
		if(isset($supervisor['code'])&&$supervisor['code']==1){
			$output=$supervisor['data']['proposal'];
			$maxperpage=5;
			$maxpage=ceil(count($output)/$maxperpage);
			if($maxpage==0)
				$maxpage=1;
			if($page>$maxpage)
				return Redirect::to('/student/supervisorList');
			else{
				$dataPropose=array();
				for($i=$maxperpage*($page-1);$i<($maxperpage*$page)&&$i<count($output);$i++){
					$dataPropose[$i]=$output[$i];
				}
				$generate="";
				if($page==1){
					$generate.="<li class=\"disabled\"><a><i class=\"icon-backward\"></i></a></li>";
					$generate.="<li class=\"disabled\"><a><i class=\"icon-chevron-left\"></i></a></li>";
				}else{
					$generate.="<li><a href='".URL::to('/student/supervisorList')."'><i class=\"icon-backward\"></i></a></li>";
					$generate.="<li><a href='".URL::to('/student/supervisorList')."/".($page-1)."'><i class=\"icon-chevron-left\"></i></a></li>";
				}
				for($i=$page-4;$i<$page;$i++){
					if($i<1)
						continue;
					$generate.="<li><a href='".URL::to('/student/supervisorList')."/".$i."'>".$i."</a></li>";
				}
				$generate.="<li class=\"disabled\"><a>".$page."</a></li>";
				for($i=$page+1;$i<($page+5)&&$i<=$maxpage;$i++){
					$generate.="<li><a href='".URL::to('/student/supervisorList')."/".$i."'>".$i."</a></li>";
				}
				if($page==$maxpage){
					$generate.="<li class=\"disabled\"><a><i class=\"icon-chevron-right\"></i></a></li>";
					$generate.="<li class=\"disabled\"><a><i class=\"icon-forward\"></i></a></li>";
				}else{
					$generate.="<li><a href='".URL::to('/student/supervisorList')."/".($page+1)."'><i class=\"icon-chevron-right\"></i></a></li>";
					$generate.="<li><a href='".URL::to('/student/supervisorList')."/".$maxpage."'><i class=\"icon-forward\"></i></a></li>";
				}
				return View::make('supervisor/proposal',array('data'=>$dataPropose,'pagination'=>$generate));
			}
		}else{
			return "Internal Server Error";
		}
	}
	public function AcceptPropose($username){
		$supervisor=$this->getData();
		if(isset($supervisor['code'])&&$supervisor['code']==1){
			$found=false;
			foreach($supervisor['data']['proposal'] as $value){
				if($value['username']==$username){
					$found=true;
					break;
				}
			}
			if($found==true){
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$username,
					"code"=>1
				);
				$data_string=json_encode($data);
				REST::POSTRequest('su/response',$data_string);
				//return $output;
			}
			return Redirect::to('/supervisor/proposal');
		}else{
			return "Internal Server Error";
		}
	}
	public function DeclinePropose($username){
		$supervisor=$this->getData();
		if(isset($supervisor['code'])&&$supervisor['code']==1){
			$found=false;
			foreach($supervisor['data']['proposal'] as $value){
				if($value['username']==$username){
					$found=true;
					break;
				}
			}
			if($found==true){
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$username,
					"code"=>0
				);
				$data_string=json_encode($data);
				REST::POSTRequest('su/response',$data_string);
				//return $output;
			}
			return Redirect::to('/supervisor/proposal');
		}else{
			return "Internal Server Error";
		}
	}
	public function getTemplates(){
		if(Request::ajax()){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1){
				$output=json_encode($supervisor['data']['template']);
				return $output;
			}
		}
	}
	public function createTemplate(){
		if(Request::ajax()&&Input::has('name')&&Input::has('description')){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"name"=>Input::get('name'),
				"description"=>Input::get('description')
			);
			$data_string=json_encode($data);
			$output=REST::POSTRequest('su/createtemplate',$data_string);
			return $output;
		}
	}
	public function getData(){
		$path="su/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
}
