<?php
include_once 'config.php';
 
	$action=$_GET['action'];
	$user=$_GET['usr_phone'];
	$pwd=$_GET['usr_pwd'];
	
	$ut = new util(); 
	$ut->connectDB();
  
	if($ut->doLogin($user,$pwd) || $_GET['action']=="doRegister" )
	{ 	
		
		
		switch ($action)
		{
			case "updateLocation":
			//32.9697, -96.80322, 29.46786, -98.53506
			//http://202.65.147.102/mGuru/api.php?action=updateLocation&usr_phone=9030003060&usr_pwd=uikkkk&lat=32.9697&long=-96.80322
			//http://202.65.147.102/mGuru/api.php?action=updateLocation&usr_phone=9030203030&usr_pwd=uikkkk&lat=32.9697&long=-96.80322
				$ut->updateLocation($_GET['lat'],$_GET['long']);
				break;
			case "getEvents":
				$ut->getEvents();
				break;
			case "postEvent":
		//http://202.65.147.102/mGuru/api.php?action=postEvent&usr_phone=9030203030&usr_pwd=uikkkk&lat=32.9697&long=-96.80322&title=Zeolotz@nsp		
		$ut->postEvent($_GET['title'],$_GET['lat'],$_GET['long']);	
				break;
			case "setGeoAlert":
				$ut->setGeoAlert($_GET['lat'],$_GET['long']);
				break;
			case "getLocation":
				break;
			case "doRegister":
			//http://202.65.147.102/mGuru/api.php?action=doRegister&usr_phone=9030000&usr_pwd=uikkkk&usr_name=chakri&usr_dob=dob&usr_gender=male
				$km=$ut->getDistance(32.9697, -96.80322, 29.46786, -98.53506, "k");
				echo $km;
				$ut->doRegister($_GET['usr_phone'],$_GET['usr_pwd'],$_GET['usr_name'],$_GET['usr_dob'],$_GET['usr_gender']);
				break;
			case "getUserLocation":
				//http://202.65.147.102/mGuru/api.php?action=getUserLocation&usr_phone=9030003060&usr_pwd=uikkkk&usr_name=chakri&usr_dob=dob&usr_gender=male&lat=32.9697&long=-96.80322
				print_r($ut->getUserLocation());
				break;


		}
	}
	else 
	{
		echo "ACCESS DENIED";
	}
	$ut->discDB();
	
?>