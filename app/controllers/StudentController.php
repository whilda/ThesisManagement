<?php

class StudentController extends Controller {
	 
	public function home(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			return View::make('student/dashboard', array('data'=>$data_output['data']));
		}else{
			return $data_output;
		}
	}
	public function Profile(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			return View::make('student/profile', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function EditProfile(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			return View::make('student/editProfile', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function EditThesis(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
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
	public function SelectSupervisor($username){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			if($data_output['data']['status']==-1&&$data_output['data']['thesis']['topic']!=""){
				$input=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"supervisor"=>$username
				);
				$input=json_encode($input);
				REST::POSTRequest("s/propose/",$input);
			}
			return Redirect::to('/student/supervisorList');
		}else{
			return "Internal Server Error";
		}
	}
	public function SupervisorList($page=1){
		$student=$this->getData();
		if(isset($student['code'])&&$student['code']==1){
			if($student['data']['thesis']['topic']=="")
				$student['data']['status']=-2;
			$output=REST::GETRequest("su/getall/".REST::$appkey."/".Session::get('token'));
			$output=json_decode($output,true);
			$maxperpage=5;
			if(isset($output["code"])&&$output["code"]!=-1){
				$maxpage=ceil(count($output['data'])/$maxperpage);
				if($maxpage==0)
					$maxpage=1;
				if($page>$maxpage)
					return Redirect::to('/student/supervisorList');
				else{
					$dataSupervisor=array();
					for($i=$maxperpage*($page-1);$i<($maxperpage*$page)&&$i<count($output['data']);$i++){
						$dataSupervisor[$i]=$output['data'][$i];
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
					return View::make('student/supervisorList',array('data'=>$dataSupervisor,'pagination'=>$generate,'status'=>$student['data']['status']));
				}
			}else{
				return View::make('student/supervisorList',array('data'=>array(),'status'=>$student['data']['status']));
			}
		}else{
			return "Internal Server Error";
		}
	}
	public function SupervisorByField($key,$page=1){
		$student=$this->getData();
		if(isset($student['code'])&&$student['code']==1){
			if($student['data']['thesis']['topic']=="")
				$student['data']['status']=-2;
			$output=REST::GETRequest("f/search/".$key."/".REST::$appkey."/".Session::get('token'));
			$output=json_decode($output,true);
			$maxperpage=5;
			if(isset($output["code"])&&$output["code"]!=-1){
				$maxpage=ceil(count($output['data'])/$maxperpage);
				if($maxpage==0)
					$maxpage=1;
				if($page>$maxpage)
					return Redirect::to('/student/supervisorList');
				else{
					$dataSupervisor=array();
					for($i=$maxperpage*($page-1);$i<($maxperpage*$page)&&$i<count($output['data']);$i++){
						$dataSupervisor[$i]=$output['data'][$i];
					}
					$generate="";
					if($page==1){
						$generate.="<li class=\"disabled\"><a><i class=\"icon-backward\"></i></a></li>";
						$generate.="<li class=\"disabled\"><a><i class=\"icon-chevron-left\"></i></a></li>";
					}else{
						$generate.="<li><a href='".URL::to('/student/supervisorList')."/field/".$key."'><i class=\"icon-backward\"></i></a></li>";
						$generate.="<li><a href='".URL::to('/student/supervisorList')."/field/".$key."/".($page-1)."'><i class=\"icon-chevron-left\"></i></a></li>";
					}
					for($i=$page-4;$i<$page;$i++){
						if($i<1)
							continue;
						$generate.="<li><a href='".URL::to('/student/supervisorList')."/field/".$key."/".$i."'>".$i."</a></li>";
					}
					$generate.="<li class=\"disabled\"><a>".$page."</a></li>";
					for($i=$page+1;$i<($page+5)&&$i<=$maxpage;$i++){
						$generate.="<li><a href='".URL::to('/student/supervisorList')."/field/".$key."/".$i."'>".$i."</a></li>";
					}
					if($page==$maxpage){
						$generate.="<li class=\"disabled\"><a><i class=\"icon-chevron-right\"></i></a></li>";
						$generate.="<li class=\"disabled\"><a><i class=\"icon-forward\"></i></a></li>";
					}else{
						$generate.="<li><a href='".URL::to('/student/supervisorList')."/field/".$key."/".($page+1)."'><i class=\"icon-chevron-right\"></i></a></li>";
						$generate.="<li><a href='".URL::to('/student/supervisorList')."/field/".$key."/".$maxpage."'><i class=\"icon-forward\"></i></a></li>";
					}
					return View::make('student/supervisorList',array('data'=>$dataSupervisor,'pagination'=>$generate,'status'=>$student['data']['status']));
				}
			}else{
				return View::make('student/supervisorList',array('data'=>array(),'status'=>$student['data']['status']));
			}
		}else{
			return "Internal Server Error";
		}
	}
	public function SupervisorView($supervisor){
		$output=REST::GETRequest("su/get/".$supervisor."/".REST::$appkey."/".Session::get('token'));
		$output=json_decode($output,true);
		$student=$this->getData();
		if(isset($student['code'])&&$student['code']==1){
			if($student['data']['thesis']['topic']=="")
				$student['data']['status']=-2;
			if(isset($output["code"])&&$output["code"]!=-1){
				if($output["code"]==1){
					return View::make('student/supervisor',array('data'=>$output['data'],'status'=>$student['data']['status']));
				}else if($output["code"]==0){
					return "Supervisor not found";
				}
			}else{
				return "Internal Server Error";
			}
		}else{
			return "Internal Server Error";
		}
	}
	public function SaveProfile(){
		$validator = Validator::make(Input::all(),
			array(
				'address' => 'between:0,50',
				'handphone' => 'digits_between:0,20',
				'email' => 'email',
			)
		);
		if(Request::ajax()&&$validator->passes()){
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
	public function Password(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			return View::make('student/password', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function Code(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			return View::make('student/code', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
		}
	}
	public function saveCode(){
		if(Request::ajax()&&Input::has('code')){
			$data_output=$this->getData();
			if(isset($data_output['code'])&&$data_output['code']==1){
				if($data_output['data']['status']==1){
					$data=array(
						"appkey"=>REST::$appkey,
						"token"=>Session::get("token"),
						"code"=>Input::get("code")
					);
					$data_string=json_encode($data);
					$output=REST::POSTRequest("s/inputcode",$data_string);
					$output=json_decode($output,true);
					if(isset($output['code']))
						return $output['code'];
					else
						return -1;
				}else{
					return -1;
				}
			}else{
				return -1;
			}
		}else{
			return -1;
		}
	}
	public function viewTask($id){
		$student=$this->getData();
		if(isset($student['code'])&&$student['code']==1){
			$data="";
			foreach($student['data']['task'] as $task){
				if($task['id_task']==$id)
					$data=$task;
			}
			if($data=="")
				return Redirect::to('student/home');
			else
				return View::make('student/viewTask',array('data'=>$student['data'],'task'=>$data));
		}else{
			return Redirect::to('/student/home');
		}
	}
	public function createWork($task){
		if(Request::ajax()&&Input::hasFile('file')){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"student"=>Session::get('username'),
				"id_task"=>$task,
			);
			$count=0;
			foreach(Input::file("file") as $file){
				if($file->isValid()){
					$data["file[".$count."]"]=new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName());
					$count++;
				}
			}
			$output=REST::ServletRequest('f/creatework',$data);
			return "{\"code\":1}";
		}
	}
	public function addComment($task){
		if(Request::ajax()&&Input::has('text')&&Input::has('type')&&Input::get('type')>20&&Input::get('type')<23){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"student"=>Session::get('username'),
				"id_task"=>$task,
				"type"=>Input::get('type'),
				"text"=>Input::get('text')
			);
			if(Input::hasFile("file")){
				$count=0;
				foreach(Input::file("file") as $file){
					if($file->isValid()){
						$data["file[".$count."]"]=new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName());
						$count++;
					}
				}
			}
			$output=REST::ServletRequest('f/createcomment',$data);
			return $output;
		}
	}
	public function finalReport(){
		$student=$this->getData();
		if(isset($student['code'])&&$student['code']==1){
			$open=false;
			foreach($student['data']['task'] as $task){
				$open=true;
				if($task['status']==0){
					$open=false;
					break;
				}
			}
			return View::make('student/report', array('open'=>$open,'status'=>$student['data']['status']));
		}
	}
	public function uploadReport(){
		if(Request::ajax()&&Input::hasFile('report')){
			$file=Input::file('report');
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"file"=>new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
			);
			$output=REST::ServletRequest('s/claim',$data);
			return $output;
		}
	}
	public function getData(){
		$path="s/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
    
    public function addReference(){
		if(Request::ajax()&&Input::has("add")){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get("token"),
			);
			$added=Input::get("add");
			$retval=1;
			foreach($added as $id){
				$data["id"]=$id;
				$data_string=json_encode($data);
				$output=REST::POSTRequest('s/addreference',$data_string);
				$output=json_decode($output,true);
				if(!(isset($output["code"])&&$output['code']==1)){
					$retval=-1;
				}
			}
			return $retval;
		}
		return -1;
	}
    
    public function getAllReference($search=""){
		if(Request::ajax()){
			if($search=="")
				$json=REST::GETRequest("s/getallreference/".REST::$appkey."/".Session::get('token'));
			else
				$json=REST::GETRequest("s/searchreference/".rawurlencode($search)."/".REST::$appkey."/".Session::get('token'));
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
    
    public function delReference(){
		if(Request::ajax()&&Input::has("delete")){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get("token"),
			);
			$deleted=Input::get("delete");
			$retval=1;
			foreach($deleted as $id){
				$data["id"]=$id;
				$data_string=json_encode($data);
				$output=REST::POSTRequest('s/removereference',$data_string);
				$output=json_decode($output,true);
				if(!(isset($output["code"])&&$output['code']==1)){
					$retval=-1;
				}
			}
			return $retval;
		}
		return -1;
	}
    
    public function createReference(){
		if(Input::has('author')&&Input::has('title')&&Input::has('year')&&Input::has('keywords')&&Request::ajax()){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"author"=>Input::get('author'),
				"title"=>Input::get('title'),
                "year"=>Input::get('year'),
                "abstract"=>Input::get('abstract', ''),
                "keywords"=>Input::get('keywords'),
			);
			$data_string=json_encode($data);
			$json=REST::POSTRequest('f/createreference',$data_string);
			$output=json_decode($json,true);
            if(isset($output['code'])&&$output['code']==1){
                $data=array(
                    "appkey"=>REST::$appkey,
                    "token"=>Session::get("token"),
                    "id"=>$output['data']
                );
                $data_string=json_encode($data);
				$output=REST::POSTRequest('s/addreference',$data_string);
				$output=json_decode($output,true);
				return $output;
            }else{
                return $json;
            }
		}else{
			return "Internal Server Error";
		}
	}
    
    public function getReference($id){
        $path="f/getreference/".$id."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$ref=json_decode($output,true);
		if(isset($ref['code'])&&$ref['code']==1){
			return View::make('student/viewReference',array('data'=>$ref['data']));
		}else{
			return Redirect::to('/student/library');
		}
	}
    
    public function getRefReccomendation(){
		if(Request::ajax()){
            $json=REST::GETRequest("s/reccomender/".REST::$appkey."/".Session::get('token'));
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
