<?php
//count users
$countusers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users"));
//count tickets
$counttickets = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM tickets"));
//count employee
$countemployee = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM employee"));
//count total bill
$add=mysqli_query($conn,'SELECT SUM(monthly_bill) from `users`');
  while($row1=mysqli_fetch_array($add))
  {
  $totalBill=$row1['SUM(monthly_bill)'];
  }



//count current month collected due bill
$current_month= date('F-Y');

  //SUM Monthly bill
  $add1=mysqli_query($conn,"SELECT SUM(monthly_bill) from `billing` WHERE billing_month = '$current_month'");
  while($row1=mysqli_fetch_array($add1))
  {
  $sum_monthly_bill=$row1['SUM(monthly_bill)'];
  }
//SUM DUE bill
  $add2=mysqli_query($conn,"SELECT SUM(pre_due) from `billing` WHERE billing_month = '$current_month'");
  while($row2=mysqli_fetch_array($add2))
  {
  $sum_due_bill=$row2['SUM(pre_due)'];
  }
//SUM Collected Monthly bill
  $add3=mysqli_query($conn,"SELECT SUM(paid_bill) from `billing` WHERE billing_month = '$current_month'");
  while($row3=mysqli_fetch_array($add3))
  {
  $sum_col_monthly_bill=$row3['SUM(paid_bill)'];
  }

//SUM Collected DUE bill
  $add4=mysqli_query($conn,"SELECT SUM(paid_due) from `billing` WHERE billing_month = '$current_month'");
  while($row4=mysqli_fetch_array($add4))
  {
  $sum_col_due_bill=$row4['SUM(paid_due)'];
  }
  
  //SUM Collected DUE bill
  $add5=mysqli_query($conn,"SELECT SUM(monthly_bill) from `users` WHERE area = 'Mohakhali DOHS'");
  while($row5=mysqli_fetch_array($add5))
  {
  $sum_mdohs_bill=$row5['SUM(monthly_bill)'];
  }
//Sum Total Collected bill
$total_col_bill=$sum_col_monthly_bill + $sum_col_due_bill;
//Sum Remaining Monthly bill
$rem_monthly_bill=$sum_monthly_bill - $sum_col_monthly_bill;
//Sum Remaining Due bill
$rem_due_bill=$sum_due_bill - $sum_col_due_bill;
//Sum Remaining TOTAL bill
$rem_total_bill=$rem_monthly_bill + $rem_due_bill;








//Sum salary Expense
$add100=mysqli_query($conn,"SELECT SUM(salary) from `employee` ");
  while($row100=mysqli_fetch_array($add100))
  {
  $totalSalary=$row100['SUM(salary)'];
  }

$fromDate = date("Y-m") ;
$toDate = date("Y-m");
//count New Clients
$countNewClients = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE activation_date BETWEEN '$fromDate-01' AND '$toDate-30'"));
//count left Clients
$countLeftClients = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM left_client WHERE left_on BETWEEN '$fromDate-01' AND '$toDate-30'"));



?>