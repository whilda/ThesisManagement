<?php

class GeneralController extends Controller {
	 
	public function getField($search=""){
		if(Request::ajax()){
			if($search=="")
				$json=REST::GETRequest("f/getallfield/".REST::$appkey."/".Session::get('token'));
			else
				$json=REST::GETRequest("f/searchfield/".rawurlencode($search)."/".REST::$appkey."/".Session::get('token'));
			$output=json_decode($json,true);
			if(isset($output['code'])){
				if($output['code']==1){
					return json_encode($output['data']);
				}else if($output['code']==0){
					return "[]";
				}
			}
		}
	}
	public function ChangePassword(){
		$validator = Validator::make(Input::all(),
			array(
				'oldpass' => 'required|regex:/^[\w]{8,16}$/',
				'newpass' => 'required|regex:/^[\w]{8,16}$/',
				'renewpass' => 'required|same:newpass',
			)
		);
		if(Request::ajax()&&$validator->passes()){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get("token"),
				"oldpassword"=>Input::get("oldpass"),
				"newpassword"=>Input::get("newpass"),
			);
			$data_string=json_encode($data);
			$output=REST::POSTRequest("f/resetpassword",$data_string);
			return $output;
		}else{
			return "{\"code\":-1}";
		}
	}
	public function getFile($id){
		$data=REST::FILERequest("f/download?id=".$id);
		if(preg_match("/Content-Disposition: .*filename {0,1}= {0,1}([^(\n)]+)/i",$data['header'],$matches)){
			header($matches[0]);
		}
		return $data['body'];
	}
    
    public function getReference($search=""){
		if(Request::ajax()){
			if($search=="")
				$json=REST::GETRequest("f/getallreference/".REST::$appkey."/".Session::get('token'));
			else
				$json=REST::GETRequest("f/searchreference/".rawurlencode($search)."/".REST::$appkey."/".Session::get('token'));
			$output=json_decode($json,true);
			if(isset($output['code'])){
				if($output['code']==1){
					return json_encode($output['data']);
				}else if($output['code']==0){
					return "[]";
				}
			}
		}
	}
}
