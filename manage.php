
<?php  //Author: Le Bao Duy Nguyen 102449993
 //Target: PHP
 //Purpose: This file is manage applications
 //Created: 25/5/2019
 //Last updated: 31/5/2019
$title = 'Manage applications|EgGaming';
$js = array('apply.js','enhancement2.js');
 ?>


 

<?php include_once('header.inc');
require_once 'settings.php';

function sanitise_inputs($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//update status
if (isset($_GET['change_status'])) {
	$id = $_GET['eoi_number'];
	$st = $_GET['new_status'];
	$sql ="UPDATE eoi set status = '$st' WHERE EOInumber = '$id'";
	$result = mysqli_query($connection,$sql);
}
//delete function

if (isset($_POST['delete_key'])) {
	$key=$_POST['delete_key'];
	$sql = "DELETE FROM eoi WHERE job_ref = '$key' ";
	$result = mysqli_query($connection,$sql);
}

//https://www.youtube.com/watch?v=_yHHwNQA00A
//https://www.youtube.com/watch?v=arqv2YVp_3E
function createManagerTable($connection){
	$sql = "create table if not exists manager (
	username varchar (25) not null primary key,
	password varchar (25) not null
	)";
	$result = mysqli_query($connection,$sql);
	if (!$result) {
		echo "Error creating managers table ".mysqli_error($connection);
		exit();
	}
//set user and password
	$sql = "INSERT INTO `manager`(`username`, `password`) VALUES ('admin','123456')";
	$result = mysqli_query($connection,$sql);
	
}
createManagerTable($connection);


if (isset($_POST['submit_reg'])) {
	$username = sanitise_inputs($_POST['reg_username']);
	$password = sanitise_inputs($_POST['reg_pwd']);
	$password1 = sanitise_inputs($_POST['reg_conpwd']);

	if ($username == '') {
		echo "Invalid username";
		exit();
	}
	if ($password == '') {
		echo "Invalid password";
		exit();
	}

	if ($password != $password1) {
		echo "Passwords do not compare";
		exit();
	}

	$sql = "INSERT INTO `manager`(`username`, `password`) VALUES ('$username','$password')";
	$result = mysqli_query($connection,$sql);

	if (!$result) {
		echo "The username might have been registered. Try another".mysqli_error($connection);;
		exit();
	}
	header("Location: ./manage.php");
}


	














//https://github.com/khavernathy/quac/blob/master/index.php
//logout function
session_start();

if (isset($_GET['logout'])) {
	session_destroy();
	header("Location:./manage.php");
}

//admin login
if (!isset($_SESSION['username'])) {
	?>
	
	<h2>Admin Login</h2>

	
		<form action="./manage.php" method="post">
	
		<input id="admin" type="text" name="email" placeholder="Username">
		<input id="admin" type="password" name="password" placeholder="Password">
		<input id="submitlogin" type="submit" name="login" value="Login">
		
		
	
	

</form>



	<?php
	if (!isset($_POST['login'])) {
		exit();
	}
}

//login function
if (isset($_POST['login'])) {
	//echo "Atempting to login";
	$username = sanitise_inputs($_POST['email']);
	$password  = $_POST['password'];

	if (strlen($username) == 0) {
		echo '<a id="user">Please enter your username</a>';
		exit();
	}else if ($password == "") {
		echo '<a id="user">Please enter your password</a>';
		exit();
	}

	$sql = "SELECT * FROM manager where username = '$username' and password = '$password'";
	$result = mysqli_query($connection,$sql);
	if ($result) {
		$row =mysqli_fetch_row($result);
		//print_r($row);
		$_SESSION['username'] = $row[0];
		
		//echo $_SESSION['email'];

 		header("Location: ./manage.php");
		exit();
	}else{
		echo '<a id="error">Could not authenticate your login. Please check your details and try again</a>';
		exit();
	}

	
	

}



$rows = array();

//print_r($rows);

if (isset($_POST['search'])) {
	if ($_POST['search_by'] == 'job_ref') {
		$key =$_POST['search_key'];
		$sql = "SELECT * FROM eoi WHERE job_ref = '$key'";
		$result = mysqli_query($connection,$sql);
		$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
	}else if ($_POST['search_by'] == 'name') {
		$name = explode(" ", sanitise_inputs($_POST['search_key']));
		$f = $name[0];
		$l = null;
		if (sizeof($name) > 1) {
			$l = $name[1];
			if (strlen(sanitise_inputs($l)) == 0) {
				$l = null;
			}
		}
		$sql = null;
		if ($l != null) {
			$sql = "SELECT * FROM eoi WHERE fname = '$f' and lname = '$l'";
			
		}else{
			$sql = "SELECT * FROM eoi WHERE fname = '$f'";
			
		}
		
		$result = mysqli_query($connection,$sql);
		$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
	}
}else{

		$sql="SELECT * FROM eoi";
		$result = mysqli_query($connection,$sql);
		$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
}

?>





	<?php include_once('menu.inc');?>

<a href="./manage.php?logout=1">Logout</a>






	
		<form id="manage" method="post" action="manage.php">
			<label>Search by</label>
			<select id="search_by" name="search_by">
				<option value="job_ref">Job ref</option>
				<option value="name">Name</option>

				
				</select>
			<input id="search_key" type="text" name="search_key" placeholder="Enter search here..">

			<input id="search" type="submit" name="search" value="Search"> <br> <br>


			<label>Delete</label>
			<input id="delete_key" type="text" name="delete_key" placeholder="Enter job ref you want to delete.." >
			<input id="delete" type="submit" name="delete" value="Delete" class="btn-delete">
			
		</form>


	
	
		<table id="table" class="records_table">
		<tr id="table"><th id="table">EOI number</th><th id="table">Job Ref</th><th id="table">First name</th><th id="table">Last Name</th><th id="table">Street</th><th id="table">Town</th> <th id="table">State</th> <th id="table">Postcode</th><th id="table">Email</th><th id="table">Phone</th><th id="table">Skills</th> <th id="table">Other Skills</th><th id="table">Apply Date</th> <th id="table">Status</th><th id="table">Change Status</th></tr>

	<?php 
//create table values
	foreach ($rows as $row) {
	
	 echo '<tr id="table"><td id="table">'.$row['EOInumber'].'</td><td id="table">'.$row['job_ref'].'</td><td id="table">'.$row['fname'].'</td><td id="table">'.$row['lname'].'</td><td id="table">'.$row['street'].'</td><td id="table">'.$row['town'].'</td> <td id="table">'.$row['state'].'</td> <td id="table">'.$row['postcode'].'</td><td id="table">'.$row['email'].'</td><td id="table">'.$row['phone'].'</td><td id="table">'.$row['skills'].'</td> <td id="table">'.$row['other_skills'].'</td><td id="table">'.$row['app_date'].'</td><td id="table">'.$row['status'].'</td><td id="table"><a href="manage.php?change_status=1&eoi_number='.$row['EOInumber'].'&new_status=New">New&nbsp;&nbsp;</a><a href="manage.php?change_status=1&eoi_number='.$row['EOInumber'].'&new_status=Current">Current&nbsp;&nbsp;</a><a href="manage.php?change_status=1&eoi_number='.$row['EOInumber'].'&new_status=Final">Final</a></td></tr>';
	 } 


	?>
	
</table>




<?php
include_once 'footer.inc';

?>