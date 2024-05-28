<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "hms");

if (isset($_POST['patsub'])) {
    $email = $_POST['email'];
    $password = $_POST['password2'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('Enter username and password first.');
              window.location.href = 'patient-login';</script>";
    } else {
        $query = "select * from patient where email='$email' and password='$password';";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $_SESSION['pid'] = $row['pid'];
                $_SESSION['username'] = $row['fname'] . " " . $row['lname'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['contact'] = $row['contact'];
                $_SESSION['email'] = $row['email'];
            }
            header("Location: patient-panel.php");
        } else {
            echo ("<script>alert('Invalid Email or Password. Try Again!');
                  window.location.href = 'patient-login';</script>");
        }
    }
}

?>
