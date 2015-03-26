<?php

class ViewStudentController extends Controller {
	 
	public function profile($username){
		$student=$this->getStudent($username);
		if(isset($student['code'])&&$student['code']==1){
			return View::make('supervisor/student/profile',array('data'=>$student['data']));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function report($username){
		$student=$this->getStudent($username);
		if(isset($student['code'])&&$student['code']==1){
			return View::make('supervisor/student/report',array('data'=>$student['data']));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function timeline($username){
		$student=$this->getStudent($username);
		if(isset($student['code'])&&$student['code']==1){
			return View::make('supervisor/student/timeline',array('data'=>$student['data']));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function thesis($username){
		$student=$this->getStudent($username);
		if(isset($student['code'])&&$student['code']==1){
			return View::make('supervisor/student/thesis',array('data'=>$student['data']));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function tasks($username){
		$student=$this->getStudent($username);
		if(isset($student['code'])&&$student['code']==1){
			$isSupervisor=$student['data']['supervisor']==Session::get('username');
			return View::make('supervisor/student/tasks',array('data'=>$student['data'],'isSupervisor'=>$isSupervisor));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function viewTask($username,$id){
		$student=$this->getStudent($username);
		if(isset($student['code'])&&$student['code']==1){
			$data="";
			foreach($student['data']['task'] as $task){
				if($task['id_task']==$id)
					$data=$task;
			}
			if($data=="")
				return Redirect::to('student/'.$username.'/tasks');
			else
				return View::make('supervisor/student/viewTask',array('data'=>$student['data'],'task'=>$data));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function getAllTasks($username){
		if(Request::ajax()){
			$student=$this->getStudent($username);
			if(isset($student['code'])&&$student['code']==1){
				$data=array();
				foreach($student['data']['task'] as $task){
					$new['name']=$task['name'];
					$new['description']=$task['description'];
					$new['status']=$task['status'];
					$new['comment']=$task['comment'];
					$new['id_task']=$task['id_task'];
					$date=new DateTime($task['created_date']['$date']);
					$new['date']=date_format($date, 'M jS');
					array_push($data,$new);
				}
				return json_encode($data);
			}else{
				return "{\"code\":-1}";
			}
		}
	}
	public function getTask($username,$id){
		if(Request::ajax()){
			$student=$this->getStudent($username);
			if(isset($student['code'])&&$student['code']==1&&$student['data']['supervisor']==Session::get('username')){
				$data=array();
				foreach($student['data']['task'] as $task){
					if($task['id_task']==$id){
						if($task['duration']==-1)
							$task['duration']="";
						return json_encode($task);
					}
				}
				return "{\"code\":-1}";
			}else{
				return "{\"code\":-1}";
			}
		}
	}
	public function getData(){
		$path="su/get/".Session::get('username')."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
	public function getStudent($username){
		$path="s/get/".$username."/".REST::$appkey."/".Session::get('token');
		$output=REST::GETRequest($path);
		$data_output=json_decode($output,true);
		return $data_output;
	}
}
