<?php

class PlagiasiController extends Controller {
	 
	public function getLaporan(){
		REST::$url="http://localhost:8080/PlagiarismW/rest/";
		$path="clocal/pbynamefile/".REST::$appkey;
		$output=REST::POSTRequest($path,"{}");
		$file=json_decode($output,true);
		if(isset($file['code'])&&$file['code']==1){
			return View::make('supervisor/plagiasi',array('data'=>$file['data']));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function cekPlagiasi($file){
		REST::$url="http://localhost:8080/PlagiarismW/rest/";
		$path="clocal/getresult/";
		$input=array(
			"appkey"=>REST::$appkey,
			"NameFile"=>$file,
		);
		$output=REST::POSTRequest($path,json_encode($input));
		$file=json_decode($output,true);
		if(isset($file['code'])&&$file['code']==1){
			return View::make('supervisor/plagiasiHasil',array('data'=>$file['Hasil Check Plagiarisme [Nim / Similarity]']));
		}else{
			return Redirect::to('/supervisor/home');
		}
	}
	public function cekPlagiasi2($file){
		$data="{
			\"_id\" : \"A11.2011.05929.pdf\",
			\"plagdetails\" : [ 
				{
					\"nim\" : \"A11.2011.05930.pdf\",
					\"similarity\" : 0.2365591397849463
				}, 
				{
					\"nim\" : \"A11.2011.05931.pdf\",
					\"similarity\" : 1
				}, 
				{
					\"nim\" : \"A11.2011.05932.pdf\",
					\"similarity\" : 0.2365591397849463
				}
			]
		}";
		$data_output=json_decode($data,true);
		return View::make('supervisor/plagiasiHasil',array('data'=>$data_output));
	}
}
