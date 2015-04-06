<?php

class SupervisorController extends Controller {
	 
	public function home(){
		$output=REST::GETRequest('su/getstudentprogress/'.REST::$appkey.'/'.Session::get('token'));
		$data_output=json_decode($output,true);
		if(isset($data_output['code'])&&$data_output['code']!=-1){
			return View::make('supervisor/dashboard', array('data'=>$data_output['data']));
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
		$validator = Validator::make(Input::all(),
			array(
				'address' => 'between:0,50',
				'handphone' => 'digits_between:0,20',
				'email' => 'email',
			)
		);
		if(Request::ajax()&&$validator->passes()&&Input::has("field")){
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
	public function Password(){
		$data_output=$this->getData();
		if(isset($data_output['code'])&&$data_output['code']==1){
			return View::make('student/password', array('data'=>$data_output['data']));
		}else{
			return "Internal Server Error";
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
	public function editTemplate($code){
		$supervisor=$this->getData();
		if(isset($supervisor['code'])&&$supervisor['code']==1){
			$found=false;
			foreach($supervisor['data']['template'] as $template){
				if($template['code']==$code){
					$found=true;
					break;
				}
			}
			if($found){
				return View::make('supervisor/editTemplate',array('data'=>$template));
			}else{
				return Redirect::to('supervisor/template');
			}
		}else{
			return "Internal Server error";
		}
	}
	public function updateTemplate($code){
		if(Request::ajax()&&Input::has('name')&&Input::has('description')){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"code"=>$code,
				"name"=>Input::get('name'),
				"description"=>Input::get('description')
			);
			$data_string=json_encode($data);
			$output=REST::POSTRequest('su/updatetemplate',$data_string);
			return $output;
		}
	}
	public function addTaskTemplate($code){
		if(Request::ajax()&&Input::has('name')&&Input::has('description')&&(Input::get('duration')>0||Input::get('duration')=="")){
			$duration=(Input::get('duration')=="")?"":(int)Input::get('duration');
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"template"=>$code,
				"name"=>Input::get('name'),
				"description"=>Input::get('description'),
				"duration"=>$duration,
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
			$output=REST::ServletRequest('su/addtask',$data);
			return $output;
		}else{
			return "{\"code\":-1}";
		}
	}
	public function updateTaskTemplate($code,$name){
		if(Request::ajax()&&Input::has('name')&&Input::has('description')&&(Input::get('duration')>0||Input::get('duration')=="")){
			$duration=(Input::get('duration')=="")?"":(int)Input::get('duration');
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"template"=>$code,
				"oldname"=>$name,
				"newname"=>Input::get('name'),
				"description"=>Input::get('description'),
				"duration"=>$duration,
				"remove"=>""
			);
			if(Input::has("deleted")){
				$count=0;
				foreach(Input::get("deleted") as $deleted){
					$data["remove"][$count]=$deleted;
					$count++;
				}
				$data["remove"]=json_encode($data["remove"]);
			}
			if(Input::hasFile("file")){
				$count=0;
				foreach(Input::file("file") as $file){
					if($file->isValid()){
						$data["file[".$count."]"]=new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName());
						$count++;
					}
				}
			}
			$output=REST::ServletRequest('su/updatetasktemplate',$data);
			return $output;
		}
	}
	public function deleteTaskTemplate($code,$name){
		if(Request::ajax()){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"template"=>$code,
				"task"=>$name,
			);
			$data=json_encode($data);
			$output=REST::POSTRequest('su/removetask',$data);
			return $output;
		}
	}
	public function getTaskTemplate($code){
		if(Request::ajax()){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1){
				$found=false;
				foreach($supervisor['data']['template'] as $template){
					if($template['code']==$code){
						$found=true;
						break;
					}
				}
				if($found){
					foreach($template['task'] as &$task){
						if($task['duration']==-1)
							$task['duration']="";
					}
					return json_encode($template['task']);
				}else{
					return Redirect::to('supervisor/template');
				}
			}else{
				return "Internal Server error";
			}
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
	public function deleteTemplate($code){
		if(Request::ajax()){
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"code"=>$code,
			);
			$data_string=json_encode($data);
			$output=REST::POSTRequest('su/deletetemplate',$data_string);
			$output=json_decode($output,true);
			if(isset($output['code']))
				return $output['code'];
			else
				return -1;
		}
	}
	public function addTask($student){
		if(Request::ajax()&&Input::has('name')&&Input::has('description')&&(Input::get('duration')>0||Input::get('duration')=="")){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1&&(array_search($student,$supervisor['data']['student'])!==false)){
				$duration=(Input::get('duration')=="")?"":(int)Input::get('duration');
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$student,
					"name"=>Input::get('name'),
					"description"=>Input::get('description'),
					"duration"=>$duration,
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
				$output=REST::ServletRequest('su/createtask',$data);
				return $output;
			}else{
				return "{\"code\":-1}";
			}
		}
	}
	public function updateTask($student,$id){
		$supervisor=$this->getData();
		if(Request::ajax()&&isset($supervisor['code'])&&$supervisor['code']==1&&(array_search($student,$supervisor['data']['student'])!==false)&&
		Input::has('name')&&Input::has('description')&&(Input::get('duration')>0||Input::get('duration')=="")){
			$duration=(Input::get('duration')=="")?"":(int)Input::get('duration');
			$data=array(
				"appkey"=>REST::$appkey,
				"token"=>Session::get('token'),
				"student"=>$student,
				"id_task"=>$id,
				"name"=>Input::get('name'),
				"description"=>Input::get('description'),
				"duration"=>$duration,
				"remove"=>""
			);
			if(Input::has("deleted")){
				$count=0;
				foreach(Input::get("deleted") as $deleted){
					$data["remove"][$count]=$deleted;
					$count++;
				}
				$data["remove"]=json_encode($data["remove"]);
			}
			if(Input::hasFile("file")){
				$count=0;
				foreach(Input::file("file") as $file){
					if($file->isValid()){
						$data["file[".$count."]"]=new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName());
						$count++;
					}
				}
			}
			$output=REST::ServletRequest('su/updatetask',$data);
			return $output;
		}
	}
	public function delTask($student){
		if(Request::ajax()&&Input::has('task')){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1&&(array_search($student,$supervisor['data']['student'])!==false)){
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$student,
					"id_task"=>Input::get('task'),
				);
				$output=REST::POSTRequest('su/deletetask',json_encode($data));
				return $output;
			}else{
				return "{\"code\":-1}";
			}
		}
	}
	public function validateTask($student){
		if(Request::ajax()&&Input::has('task')){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1&&(array_search($student,$supervisor['data']['student'])!==false)){
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$student,
					"id_task"=>Input::get('task'),
				);
				$output=REST::POSTRequest('su/validation',json_encode($data));
				return $output;
			}else{
				return "{\"code\":-1}";
			}
		}
	}
	public function createWork($student,$task){
		if(Request::ajax()&&Input::hasFile('file')){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1&&(array_search($student,$supervisor['data']['student'])!==false)){
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$student,
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
			}else{
				return "{\"code\":-1}";
			}
		}
	}
	public function addComment($student, $task){
		if(Request::ajax()&&Input::has('text')&&Input::has('type')&&Input::get('type')>10&&Input::get('type')<14){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1&&(array_search($student,$supervisor['data']['student'])!==false)){
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$student,
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
			}else{
				return "{\"code\":-1}";
			}
		}
	}
	public function responseFinal($student,$response){
		if($response=="approve"||$response=="reject"){
			$supervisor=$this->getData();
			if(isset($supervisor['code'])&&$supervisor['code']==1&&(array_search($student,$supervisor['data']['student'])!==false)){
				$data=array(
					"appkey"=>REST::$appkey,
					"token"=>Session::get('token'),
					"student"=>$student,
					"code"=>($response=="approve")?1:0,
				);
				$output=REST::ServletRequest('su/claim',$data);
			}
		}
		return Redirect::to('/student/'.$student.'/report');
	}
	public function StudentList($page=1){
		$output=REST::GETRequest("s/getall/".REST::$appkey."/".Session::get('token'));
		$output=json_decode($output,true);
		$maxperpage=5;
		if(isset($output["code"])&&$output["code"]!=-1){
			$maxpage=ceil(count($output['data'])/$maxperpage);
			if($maxpage==0)
				$maxpage=1;
			if($page>$maxpage)
				return Redirect::to('/supervisor/studentList');
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
					$generate.="<li><a href='".URL::to('/supervisor/studentList')."'><i class=\"icon-backward\"></i></a></li>";
					$generate.="<li><a href='".URL::to('/supervisor/studentList')."/".($page-1)."'><i class=\"icon-chevron-left\"></i></a></li>";
				}
				for($i=$page-4;$i<$page;$i++){
					if($i<1)
						continue;
					$generate.="<li><a href='".URL::to('/supervisor/studentList')."/".$i."'>".$i."</a></li>";
				}
				$generate.="<li class=\"disabled\"><a>".$page."</a></li>";
				for($i=$page+1;$i<($page+5)&&$i<=$maxpage;$i++){
					$generate.="<li><a href='".URL::to('/supervisor/studentList')."/".$i."'>".$i."</a></li>";
				}
				if($page==$maxpage){
					$generate.="<li class=\"disabled\"><a><i class=\"icon-chevron-right\"></i></a></li>";
					$generate.="<li class=\"disabled\"><a><i class=\"icon-forward\"></i></a></li>";
				}else{
					$generate.="<li><a href='".URL::to('/supervisor/studentList')."/".($page+1)."'><i class=\"icon-chevron-right\"></i></a></li>";
					$generate.="<li><a href='".URL::to('/supervisor/studentList')."/".$maxpage."'><i class=\"icon-forward\"></i></a></li>";
				}
				return View::make('supervisor/studentList',array('data'=>$dataSupervisor,'pagination'=>$generate));
			}
		}else{
			return View::make('supervisor/studentList',array('data'=>array()));
		}
	}
	public function getData(){
		$path="su/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
}
