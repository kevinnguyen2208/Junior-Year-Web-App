<?php

/* Function to validate inputs*/
function sanitise_inputs($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


 if (isset($_POST['submit'])) {

 	//Import database settings
require_once 'settings.php';

//Create an sql statement
$sql = "create table if not exists eoi(
	
	EOInumber int(3) primary key not null AUTO_INCREMENT,
	job_ref varchar(5) not null,
	fname varchar (20) not null,
	lname varchar (20) not null,
	street varchar(40) not null,
	town varchar (40) not null,
	state varchar (5) not null,
	postcode varchar(4) not null,
	email varchar (100) not null,
	phone varchar (12) not null,
	skills varchar (100) not null,
	other_skills text not null,
	app_date DATE,
	status enum('Current','Final','New') not null
	)";
//Excecute the statement
	
//$connection->exec($sql);

if (mysqli_query($connection, $sql)) {
    //echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($connection);
}




 $fname = sanitise_inputs($_POST['firstname']);
 $lname = sanitise_inputs($_POST['lastname']);
 $dob = sanitise_inputs($_POST['dob']);
 $town =  sanitise_inputs($_POST['town']);
 $address = sanitise_inputs($_POST['address']);
 $state = sanitise_inputs($_POST['state']);
 $postcode = sanitise_inputs($_POST['postcode']);
 $email = sanitise_inputs($_POST['email']);
 $phone = sanitise_inputs($_POST['phone']);
 $other_skills = sanitise_inputs($_POST['otherskilltext']);
 $jobID = sanitise_inputs($_POST['jobID']);
 $skills  = array();


      if (isset($_POST['skill1'])) {
      	array_push($skills, $_POST['skill1']);
      }


      if (isset($_POST['skill2'])) {
      	array_push($skills, $_POST['skill2']);
      }

      if (isset($_POST['skill3'])) {
      	array_push($skills, $_POST['skill3']);
      }

      if (isset($_POST['skill4'])) {
      	array_push($skills, $_POST['skill4']);
      }

      if (isset($_POST['skill5'])) {
      	array_push($skills, $_POST['skill5']);
      }

      if (isset($_POST['skill6'])) {
      	array_push($skills, $_POST['skill6']);
      }

      if (isset($_POST['skill7'])) {
      	array_push($skills, $_POST['skill7']);
      }

      if (isset($_POST['skill8'])) {
      	array_push($skills, $_POST['skill8']);
      }

      if (isset($_POST['skill9'])) {
      	array_push($skills, $_POST['skill9']);
      }

	
      $errorMsg = "";
       

      if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
      	$errorMsg.="<p>Please input a valid email address</p>";
      
      }

      if (!preg_match("/^[A-Za-z0-9]{5}$/", $jobID) or strlen($jobID) != 5) {
      	$errorMsg.= "<p>Please input Job ID(5 characters)</p>";
      
      }

      if (strlen($fname) > 20 or strlen($lname)  > 20 or strlen($fname) == 0 or strlen($lname) == 0) {
      	$errorMsg.= "<p>Name must not be empty and must be a maximum of 20 charactors</p>";
    ;
      }
//lecture 11 
      $dob=trim($_POST["dob"]);	// dob
	  if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $dob)){
		  $errorMsg .= "<p>Please enter your date of birth follow the dd/mm/yyyy format.</p>";
	  }
	  else {
		  $dob=explode("/", $dob);
		  $dob=$dob[2] . "-" . $dob[1] . "-" . $dob[0];
		  
		  $dateDob = date_create($dob);
		  $dateNow = date_create();
		  $age = date_diff($dateDob, $dateNow);
		  $age = date_interval_format($age, "%Y");
		  
		  if ($age<15 || $age>80)
			  $errorMsg .= "<p>You age must be between 15 and 80.</p>";
	  }	 
	 
     
	  if (isset($_POST["gender"]))    // check box
	  $gender=$_POST["gender"];
  else
	  $errorMsg.= "";

      if (strlen($address) > 40 or strlen($town) > 40) {
     	$errorMsg.= "<p>Address and town must not exceed 40 characters</p>";
      
     }


      if (strlen($postcode) > 4) {
     	$errorMsg.= "<p>Post code must be 4 digits and must match the state</p>";
     
	 }

	 $firstnumber=substr($postcode,0,1);
	 switch($state){
		 case "VIC":
		 if($firstnumber!=3 && $firstnumber!=8){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
		 case "NSW":
		 if($firstnumber!=1 && $firstnumber!=2){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
		 case "QLD":
		 if($firstnumber!=4 && $firstnumber!=9){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
		 case "NT":
		 if($firstnumber!=0){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
		 case "WA":
		 if($firstnumber!=6){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
		 case "SA":
		 if($firstnumber!=5){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
		 case "TAS":
		 if($firstnumber!=7){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
		 case "ACT":
		 if($firstnumber!=0){
			 $errorMsg.= "<p>Please ensure the Postcode matches the State.</p>";
		 }
		 break;
	 }

      if (strlen($phone) < 8 or strlen($phone) > 12) {
     	$errorMsg.= "<p>Invalid phone number. Phone must contain 8 to 12 numbers.</p>";
      
     }

	 


     if (sizeof($skills) == 0 and !isset($_POST['skill10'])) {
     	$errorMsg.= "<p>You have not specified a skill.</p>";
     
     	
     }

     $skillist = "";
     for($i =0; $i < sizeof($skills); $i++){
     	if ($i == (sizeof($skills) - 1)) {
     		$skillist = $skillist.$skills[$i];
     	}else{
     		$skillist = $skillist.$skills[$i].",";
     	}
     	

     }

 if (isset($_POST['skill10'])) {
      	if (!isset($_POST['otherskilltext']) or strlen($other_skills) == 0) {
      	$errorMsg.= "<p>Please specify other skills.</p>";
      
      	exit();
      	}
      }
	  if ($errorMsg!=""){
		echo $errorMsg;
	}
	else {
	// connect to db, create table, insert record
	require_once "settings.php";	// Load MySQL log in credentials
	$connection = mysqli_connect ($host,$username,$password,$database_name);	// Log in and use database




      //Now add to database
      $sql = "INSERT INTO `eoi`( `job_ref`, `fname`, `lname`, `street`, `town`, `state`, `postcode`, `email`, `phone`, `skills`, `other_skills`,`app_date`, `status`) VALUES ('$jobID','$fname','$lname','$address','$town','$state','$postcode','$email','$phone','$skillist','$other_skills',CURDATE(),'New')";


if (mysqli_query($connection, $sql)) {
    $EOInumber = mysqli_insert_id($connection);

   echo '<div id="success" name="success">Application  successful!  Your EOI number is '.$EOInumber.'</div>';
    exit();
   
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

    

      exit();
}
 	exit();
 }



  ?>