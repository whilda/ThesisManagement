<?php
class REST{
	public static $url = "http://localhost:8080/RESTfulWS/rest/"; 
	public static $appkey = "P0DyxGkgKComHAz0AhJJ";
 
	static function POSTRequest($path, $data_string){
		//$data_string = json_encode($data);
		$ch = curl_init(REST::$url.$path);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		 
		$result = curl_exec($ch);
		return $result;
	}
	static function GETRequest($path){
		$ch = curl_init(REST::$url.$path);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json')                                                                       
		);                                                                                                                   
		 
		$result = curl_exec($ch);
		return $result;
	}
	static function FILERequest($path){
		$ch = curl_init(REST::$url.$path);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		$result = curl_exec($ch);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$data["header"] = substr($result, 0, $header_size);
		$data["body"] = substr($result, $header_size);
		return $data;
	}
	static function ServletRequest($path, $data){
		$ch = curl_init(REST::$url.$path);
		curl_setopt($ch, CURLOPT_POST,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$result = curl_exec($ch);
		return $result;
	}
}