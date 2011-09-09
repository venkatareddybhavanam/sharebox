<?php
	class util
	{
		var $host="localhost";
		var $usr="root";
		var $pwd="computer";
		var $db="mguru";
		var $conn=null;	
		var $user=null;
		
		function getEvents()
		{
			$query="select * from event_updates where usr_phone='".$phone."' and usr_pwd='".$pwd."'";
			//$res=mysql_query($query,$this->conn);
			echo "Zeolotz @ Nsp";
		}
		
		function getUserLocation()
		{
			//$this->user['usr_id']
			$query="select * from location_history where his_usr_id=".$this->user['usr_id']." limit 1";
			//echo $query;
			$res=mysql_query($query);
			return mysql_fetch_array($res);
		}

		function postEvent($eTitle,$eLat,$eLong)
		{
			$query="insert into event_updates (evnt_usr_id,evnt_title,evnt_lat,evnt_long) values (".$this->user['usr_id'];
			$query.=",'".$eTitle."','".$eLat."','".$eLong."')";
			$res=mysql_query($query,$this->conn);
			//echo $query;
			return 200;
		}
		function setGeoAlert($lat,$long)
		{
			$qu="insert into location_alerts (alrt_usr_id,alrt_lat,alrt_long) values (".$this->user['usr_id'].",'".$lat."','".$long."')";			
			$res=mysql_query($qu,$this->conn);
		}
		function updateLocation($lat,$long)
		{
			//print_r($this->user);
			$qu="insert into location_history (his_usr_id,his_lat,his_long) values (".$this->user['usr_id'].",'".$lat."','".$long."')";			
			$res=mysql_query($qu,$this->conn);
			
		}
		function doLogin($phone,$pwd)
		{
			$query="select * from users where usr_phone='".$phone."' and usr_pwd='".$pwd."'";
			//echo $query;
			$res=mysql_query($query,$this->conn);					
			if(mysql_num_rows($res)==0)
			return false;			
			$this->user=mysql_fetch_array($res);
			return true;			
		}
		function doRegister($phone,$pwd,$usr_name,$usr_dob,$usr_gender)
		{
			//echo "adsf";
			//http://202.65.147.102/mGuru/api.php?action=doRegister&usr_phone=9030003060&usr_pwd=uikkkk&usr_name=chakri&usr_dob=dob&usr_gender=male
			$qu="insert into  users (usr_phone,usr_pwd,usr_name,usr_dob,usr_gender,usr_created_dt)";
			$qu.=" values ('".$phone."','".$pwd."','".$usr_name."','".$usr_dob."','".$usr_gender."',sysdate())";	
			//echo $qu;
			$res=mysql_query($qu,$this->conn);
		}
		
		function connectDB()
		{
			$this->conn=mysql_connect($this->host,$this->usr,$this->pwd);
			mysql_select_db($this->db,$this->conn);
		}
		function discDB()
		{
		   mysql_close($this->conn);
		}
		
		public static function getDistance($lat1, $lon1, $lat2, $lon2, $unit) 
		{ 

			  $theta = $lon1 - $lon2; 
			  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
			  $dist = acos($dist); 
			  $dist = rad2deg($dist); 
			  $miles = $dist * 60 * 1.1515;
			  $unit = strtoupper($unit);

			  if ($unit == "K") 
			  {
				return ($miles * 1.609344); 
			  } 
			  else if ($unit == "N") 
			  {
				  return ($miles * 0.8684);
			  } 
			  else 
			  {
					return $miles;
			  }
		}

	}
?>