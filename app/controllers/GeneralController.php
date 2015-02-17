<?php

class GeneralController extends Controller {
	 
	public function getField($search=""){
		if(Request::ajax()){
			if($search=="")
				$json=REST::GETRequest("f/getallfield/".REST::$appkey."/".Session::get('token'));
			else
				$json=REST::GETRequest("f/searchfield/".$search."/".REST::$appkey."/".Session::get('token'));
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
