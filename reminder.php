<?php

function sendReminders($AppID) {
// Include the necessary files
include('function1.php');
include('send.php');

// Get the patient and prescription information
$query = "SELECT fname, lname, email FROM appointment WHERE AppID = '$AppID'";

// Get the patient and prescription information
$AppID = $_GET['AppID'];
$query = "SELECT fname, lname, email FROM appointment WHERE AppID = '$AppID'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$name = $row['fname']. " ". $row['lname'];
$email = $row['email'];

// Get the prescription details
$query = "SELECT disease, allergy, prescription FROM prescriptiontable WHERE AppID = '$AppID'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$disease = $row['disease'];
$allergy = $row['allergy'];
$prescription = $row['prescription'];

// Set the reminder message
$subject = 'Medicine Reminder';
$message = 'Dear '. $name. ',<br><br>
Please take your medicine as prescribed by Dr. '. $_SESSION['dname']. '.<br>
Prescription details:<br>
Disease: '. $disease. '<br>
Allergy: '. $allergy. '<br>
Prescription: '. $prescription. '<br><br>
Best regards';

// Set the time intervals for sending the reminders (e.g., every 8 hours)
$timeIntervals = [8, 12, 20]; // in hours

// Loop through the time intervals and send the reminders
foreach ($timeIntervals as $interval) {
    // Calculate the time to send the reminder
    $currentTime = date('H');
    $reminderTime = $currentTime + $interval;
    if ($reminderTime > 24) {
        $reminderTime -= 24;
    }

    // Schedule the reminder to be sent at the calculated time
    if (date('H') == $reminderTime) {
        // Send the reminder email
        sendEmail($name, $email, $subject, $message);
    }
}
}
?>