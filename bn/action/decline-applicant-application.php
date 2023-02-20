<?php
include ('../database/dbconnect.php');
$proposal_id = $_GET['id'];

// mysqli_query($conn, "INSERT INTO hire_employee (employeeEmail, employerEmail, servicePortfolioId) VALUES ('$employee_email', '$employer_email', '$portfolio_id')");
// $p_id = $_POST['proposal_id'];
// mysqli_query($conn, "UPDATE apply_job set status = 1 WHERE id = '$p_id'");
// mysqli_query($conn, "INSERT INTO notifications (email, notification) VALUES('$employee_email','Congratulations!! You application accepted and you are hired!!')");

// $query=mysqli_query($conn,"SELECT * FROM apply_job  WHERE id = '$p_id';");
// $result=mysqli_fetch_array($query);
// $job_post_id = $result['jobPostId'];

mysqli_query($conn, "UPDATE apply_job SET status = 2 WHERE id = '$proposal_id'");
header('Location: ../employer/my-job-posts.php');
?>