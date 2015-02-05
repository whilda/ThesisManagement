<?php

class AuthController extends Controller {
	 
	public function Signup()
    {
        return View::make('signup');
    }
	public function SignupStudent(){
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required|alpha_dash',
				'password' => 'required',
				'repass' => 'required|same:password',
				'nim' => 'required|regex:/^[A-Za-z][0-9]{2}\.[0-9]{4}\.[0-9]{5}$/',
				'name' => 'required',
				'address' => 'required',
				'handphone' => 'required|numeric|digits_between:7,12',
				'email' => 'required|email',
			)
		);
		if($validator->passes()){
			$data = array(
				"appkey" =>REST::$appkey, 
				"username" =>Input::get('username'), 
			);
			$data_string=json_encode($data);
			$json=REST::POSTRequest('f/isexist',$data_string);
			$output=json_decode($json,true);
			if(isset($output['code'])&&$output['code']==0){
				$data = array(
					"appkey" =>REST::$appkey, 
					"username" =>Input::get('username'), 
					"password" =>Input::get('password'), 
					"nim" =>Input::get('nim'),
					"name" =>ucwords(Input::get('name')),
					"address" =>Input::get('address'),
					"handphone" =>Input::get('handphone'),
					"email" =>Input::get('email'),
				);
				$data_string=json_encode($data);
				$json=REST::POSTRequest('s/register',$data_string);
				$output=json_decode($json,true);
				if(isset($output['code'])){
					if($output['code']=="-1"){
						return $output['message'];
					}else if($output['code']=='1'){
						return $this->Auth();
					}
				}else{
					return "Internal Server Error";
				}
			}else if(isset($output['code'])&&$output['code']==1){
				return "Username sudah terdaftar";
			}else{
				return "Internal Server Error";
			}
		}else{
			return Redirect::to('/signup');
		}
	}
	public function SignupSupervisor(){
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required|alpha_dash',
				'password' => 'required',
				'repass' => 'required|same:password',
				'nip' => 'required|regex:/^[0-9]{4}\.[0-9]{2}\.[0-9]{4}\.[0-9]{3}$/',
				'name' => 'required',
				'address' => 'required',
				'handphone' => 'required|numeric|digits_between:7,12',
				'email' => 'required|email',
			)
		);
		if($validator->passes()){
			$data = array(
				"appkey" =>REST::$appkey, 
				"username" =>Input::get('username'), 
			);
			$data_string=json_encode($data);
			$json=REST::POSTRequest('f/isexist',$data_string);
			$output=json_decode($json,true);
			if(isset($output['code'])&&$output['code']==0){
				$data = array(
					"appkey" =>REST::$appkey, 
					"username" =>Input::get('username'), 
					"password" =>Input::get('password'), 
					"nik" =>Input::get('nip'),
					"name" =>ucwords(Input::get('name')),
					"address" =>Input::get('address'),
					"handphone" =>Input::get('handphone'),
					"email" =>Input::get('email'),
				);
				$data_string=json_encode($data);
				$json=REST::POSTRequest('su/register',$data_string);
				$output=json_decode($json,true);
				if(isset($output['code'])){
					if($output['code']=="-1"){
						return $output['message'];
					}else if($output['code']=='1'){
						return $this->Auth();
					}
				}else{
					return "Internal Server Error";
				}
			}else if(isset($output['code'])&&$output['code']==1){
				return "Username sudah terdaftar";
			}else{
				return "Internal Server Error";
			}
		}else{
			return Redirect::to('/signup');
		}
	}
	public function Auth(){
		$data = array(
			"appkey" =>REST::$appkey, 
			"username" =>Input::get('username'), 
			"password" =>Input::get('password')
		);
		$data_string=json_encode($data);
		$json=REST::POSTRequest('f/auth',$data_string);
		$output=json_decode($json,true);
		if(isset($output['code'])){
			if($output['code']==1){
				Session::put('name',Input::get('name'));
				Session::put('username',Input::get('username'));
				Session::put('token',Input::get('name'));
				Session::put('role','student');
			}else if($output['code']==2){
				Session::put('name',Input::get('name'));
				Session::put('username',Input::get('username'));
				Session::put('token',Input::get('name'));
				Session::put('role','supervisor');
			}else{
				return "Login gagal";
			}
			return Redirect::to("/".Session::get('role')."/home");
		}else{
			return "Internal Server Error";
		}
	}
}
