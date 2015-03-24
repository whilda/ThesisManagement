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
			foreach($student['data']['task'] as $task){
				if($task['id_task']==$id)
					$data=$task;
			}
			return View::make('supervisor/student/viewTask',array('data'=>$student['data'],'task'=>$data));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function getStudentTasks($username){
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
