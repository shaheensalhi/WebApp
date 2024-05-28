<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "hms");
if (isset($_POST['adsub'])) {
	$username = $_POST['username1'];
	$password = $_POST['password2'];
	$query = "select * from admin where username='$username' and password='$password';";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) == 1) {
		$_SESSION['username'] = $username;
		header("Location:admin-panel.php");
	} else
		header("Location:error4.php");
	echo ("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'index.php';</script>");
}


function display_docs()
{
	global $con;
	$query = "select * from doctor";
	$result = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
		echo '<option value="' . $name . '">' . $name . '</option>';
	}
}

if (isset($_POST['doc_sub'])) {
	$name = $_POST['name'];
	$query = "insert into doctor(name)values('$name')";
	$result = mysqli_query($con, $query);
	if ($result)
		header("Location:adddoc.php");
}
