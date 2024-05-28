<?php
$con=mysqli_connect("localhost","root","","hms");

function display_specs() {
  global $con;
  $query="select distinct(spec) from doctor";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_array($result))
  {
    $spec=$row['spec'];
    echo '<option data-value="'.$spec.'">'.$spec.'</option>';
  }
}

function display_docs()
{
 global $con;
 $query = "select * from doctor";
 $result = mysqli_query($con,$query);
 while( $row = mysqli_fetch_array($result) )
 {
  $username = $row['username'];
  $price = $row['docFees'];
  $spec = $row['spec'];
  // Sanitize the username for use as an attribute value
  $sanitizedUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
  echo '<option value="' .$sanitizedUsername. '" data-value="'.$price.'" data-spec="'.$spec.'">'.$sanitizedUsername.'</option>';
 }
}



if(isset($_POST['doc_sub']))
{
 $username=$_POST['username'];
 $query="insert into doctor(username)values('$username')";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:adddoc.php");
}

?>