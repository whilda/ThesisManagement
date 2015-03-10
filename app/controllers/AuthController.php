<?php

class AuthController extends Controller {
	 
	public function Signup()
    {
        return View::make('signup');
    }
	public function LogIn(){
		if(Cookie::get('__token')!=false){
			$data=$this->getUserName(Cookie::get('__token'));
			if(isset($data['code'])&&$data['code']==1){
				Session::put('username',$data['data']['username']);
				Session::put('token',Cookie::get('__token'));
				Session::put('role',$data['data']['status']);
				Session::put('name',$data['data']['name']);
				return Redirect::to("/".Session::get('role')."/home")->withCookie(Cookie::make('__token',Cookie::get('__token'),1440 * 30));
			}else{
				return View::make('login');
			}
		}else{
			return View::make('login');
		}
	}
	public function logOut(){
		Session::flush();
		return Redirect::to('/')->withCookie(Cookie::forget('__token'));
	}
	public function SignupStudent(){
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required|regex:/^[\w\.\-]{4,15}$/',
				'password' => 'required|regex:/^[\w]{8,16}$/',
				'repass' => 'required|same:password',
				'nim' => 'required|regex:/^[A-Ea-e]\d{2}\.\d{4}\.\d{5}$/',
				'name' => 'required|between:1,30',
				'address' => 'between:0,50',
				'handphone' => 'digits_between:0,20',
				'email' => 'email',
			)
		);
		if($validator->passes()){
			$data = array(
				"appkey" =>REST::$appkey, 
				"username" =>Input::get('username'), 
			);
			$data_string=json_encode($data);
			$exist=$this->isExist(json_encode($data));
			if($exist==1){
				$data = array(
					"appkey" =>REST::$appkey, 
					"username" =>Input::get('username'), 
					"password" =>Input::get('password'), 
					"nim" =>ucfirst(Input::get('nim')),
					"name" =>ucwords(Input::get('name')),
					"address" =>Input::get('address'),
					"handphone" =>Input::get('handphone'),
					"email" =>Input::get('email'),
				);
				$data_string=json_encode($data);
				$json=REST::POSTRequest('s/register',$data_string);
				$output=json_decode($json,true);
				if(isset($output['code'])){
					if($output['code']=='1'){
						return $this->Auth();
					}else{
						return $output['message'];
					}
				}else{
					return "Internal Server Error";
				}
			}else if($exist==0){
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
				'username' => 'required|regex:/^[\w\.\-]{4,15}$/',
				'password' => 'required|regex:/^[\w]{8,16}$/',
				'repass' => 'required|same:password',
				'npp' => 'required|regex:/^[0-9]{4}\.[0-9]{2}\.[0-9]{4}\.[0-9]{3}$/',
				'name' => 'required|between:1,30',
				'address' => 'between:0,50',
				'handphone' => 'digits_between:0,20',
				'email' => 'email',
			)
		);
		if($validator->passes()){
			$data = array(
				"appkey" =>REST::$appkey, 
				"username" =>Input::get('username'), 
			);
			$exist=$this->isExist(json_encode($data));
			if($exist==1){
				$data = array(
					"appkey" =>REST::$appkey, 
					"username" =>Input::get('username'), 
					"password" =>Input::get('password'), 
					"npp" =>Input::get('npp'),
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
			}else if($exist==0){
				return "Username sudah terdaftar";
			}else{
				return "Internal Server Error";
			}
		}else{
			return Redirect::to('/signup');
		}
	}
	public function Auth(){
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required|regex:/^[\w\.\-]{4,15}$/',
				'password' => 'required|regex:/^[\w]{8,16}$/',
			)
		);
		if($validator->passes()){
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
					Session::put('username',Input::get('username'));
					Session::put('token',$output['token']);
					Session::put('role','student');
					$data=$this->getUserName($output['token']);
					Session::put('name',$data['data']['name']);
				}else if($output['code']==2){
					Session::put('username',Input::get('username'));
					Session::put('token',$output['token']);
					Session::put('role','supervisor');
					$data=$this->getUserName($output['token']);
					Session::put('name',$data['data']['name']);
				}else if($output['code']==-1){
					return "Internal Server Error";
				}else{
					return Redirect::to("/")->with('error',"Username/Password salah");;
				}
				if(Input::has('remember'))
					return Redirect::to("/".Session::get('role')."/home")->withCookie(Cookie::make('__token',$output['token'],1440 * 30));
				else
					return Redirect::to("/".Session::get('role')."/home");
			}else{
				return "Internal Server Error";
			}
		}else{
			return Redirect::to("/")->with('error',"Username/Password salah");
		}
	}
	public function isExist($data_string=NULL){
		if(Request::ajax()){
			$data['username']=Input::get('username');
			$data['appkey']=REST::$appkey;
			$data_string=json_encode($data);
		}
		if($data_string!=NULL){
			$json=REST::POSTRequest('f/isexist',$data_string);
			$output=json_decode($json,true);
			if(!isset($output['code']))
				$output['code']=-1;
			return $output['code'];
		}else{
			return -1;
		}
	}
	public function getUserName($token){
		$json=REST::GETRequest('f/getusername/'.REST::$appkey.'/'.$token);
		$output=json_decode($json,true);
		return $output;
	}
}
