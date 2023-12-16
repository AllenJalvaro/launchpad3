<?php

require 'config.php';
$userEmail=$_SESSION['email'];
$notifquery = "SELECT * FROM invitation, student_registration where invitation.invitee_studentid=student_registration.student_id AND student_email= '$userEmail'";
$notifResult = mysqli_query($conn, $notifquery);
echo $notifResult->num_rows;

?>
