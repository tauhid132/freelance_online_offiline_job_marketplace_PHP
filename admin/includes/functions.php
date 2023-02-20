<?php
function countNewUsers($fromDate, $conn){
	$countNewUsers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE activation_date BETWEEN '$fromDate-01' AND '$fromDate-30'"));
	return $countNewUsers[0];
}

function countLeftUsers($fromDate, $conn){
	$countLeftUsers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM left_client WHERE left_on BETWEEN '$fromDate-01' AND '$fromDate-30'"));
	return $countLeftUsers[0];
}

function countAreaWiseUsers($area,$conn){
	$countAreaWiseUsers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE area='$area'"));
	return $countAreaWiseUsers[0];
}

function countStatusWiseUsers($status,$conn){
	$countStatusWiseUsers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE status='$status'"));
	return $countStatusWiseUsers[0];
}

function countTypeWiseUsers($type,$conn){
	$countTypeWiseUsers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE conn_type='$type'"));
	return $countTypeWiseUsers[0];
}

function countStatusWiseTickets($status,$conn){
	$countStatusWiseTickets = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM tickets WHERE status = '$status'"));
	return $countStatusWiseTickets[0];
}
function countStatusWiseTasks($status,$conn){
	$countStatusWiseTasks = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM tasks WHERE status = '$status'"));
	return $countStatusWiseTasks[0];
}

function countMonthlyBill($month,$conn){
	$add500=mysqli_query($conn,"SELECT SUM(monthly_bill) from `billing` WHERE billing_month='$month'");
	while($row500=mysqli_fetch_array($add500))
	{
		$sumMonthlyBill=$row500['SUM(monthly_bill)'];
		return $sumMonthlyBill;
	}
}


//functions for accounts module

function sumExpType($type,$month,$conn){
	$add501=mysqli_query($conn,"SELECT SUM(amount) from `expences` WHERE month = '$month' && exp_type = '$type'");
	while($row501=mysqli_fetch_array($add501))
	{
		$sumExpType=$row501['SUM(amount)'];
		return $sumExpType;
	}
}

function sumDailyCollectedBill($day,$conn){

	$date = date("Y-m").'-'.$day;
	$add502=mysqli_query($conn,"SELECT SUM(paid_bill) from `billing` WHERE pay_date = '$date'");
	while($row502=mysqli_fetch_array($add502))
	{
		$sumDailyCollectedBill=$row502['SUM(paid_bill)'];
		return $sumDailyCollectedBill;
	}
}


//functions for HRM

function sumSalePerMonth($month_select,$username,$conn){
	$add503=mysqli_query($conn,"SELECT SUM(monthly_bill) from `users` WHERE reference = '$username' && activation_date BETWEEN '$month_select-01' AND '$month_select-30'");
	while($row503=mysqli_fetch_array($add503))
	{
		$sumSalePerMonth=$row503['SUM(monthly_bill)'];
		return $sumSalePerMonth;
	}
}
function sumConvencePerMonth($month_select,$username,$conn){
	$add503=mysqli_query($conn,"SELECT SUM(amount) from `expences` WHERE exp_type = 'Convence' && month = '$month_select' && exp_by = '$username'");
	while($row503=mysqli_fetch_array($add503))
	{
		$sumConvencePerMonth=$row503['SUM(amount)'];
		return $sumConvencePerMonth;
	}
}


//Sum total Expense
function sumTotalExp($month,$conn){
	$add504=mysqli_query($conn,"SELECT SUM(amount) from `expences` WHERE month = '$month' ");
	while($row504=mysqli_fetch_array($add504))
	{
		$exp=$row504['SUM(amount)'];
	}
	$add505=mysqli_query($conn,"SELECT SUM(paid) from `salary` WHERE month = '$month' ");
	while($row505=mysqli_fetch_array($add505))
	{
		$salary=$row505['SUM(paid)'];
	}
	$add506=mysqli_query($conn,"SELECT SUM(paid) from `upstream_bill` WHERE month = '$month' ");
	while($row506=mysqli_fetch_array($add506))
	{
		$upstream=$row506['SUM(paid)'];
	}
	$total_exp = $exp + $salary + $upstream;
	return $total_exp;
}

//sum total collected bill
function sumCollectedBill($month,$conn){
	$add507=mysqli_query($conn,"SELECT SUM(paid_bill) from `billing` WHERE billing_month = '$month' ");
	while($row507=mysqli_fetch_array($add507))
	{
		$collectedMonthly=$row507['SUM(paid_bill)'];
	}
	$add508=mysqli_query($conn,"SELECT SUM(paid_due) from `billing` WHERE billing_month = '$month' ");
	while($row508=mysqli_fetch_array($add508))
	{
		$collectedDue=$row508['SUM(paid_due)'];
	}
	//calculate final
	$totalCollected = $collectedMonthly + $collectedDue;
	return $totalCollected;
}

//function for Monthly profit
function sumMonthlyProfit($month,$conn){
	$total_exp = sumTotalExp($month,$conn);
	$totalCollected = sumCollectedBill($month,$conn);

    //Calculate Bill
	$sumMonthlyProfit = $totalCollected - $total_exp;
	return $sumMonthlyProfit;
}


//New User Rate
function newUserRate($conn){
	//count current month
	$curr_month = date("Y-m");
	$newUserCurrent = countNewUsers($curr_month,$conn);
	//count Previous month
	$pre_month = date('Y-m', strtotime("-1 Months"));
	$newUserPre = countNewUsers($pre_month,$conn);

	$rate = (($newUserCurrent - $newUserPre) / $newUserPre)*100;
	return round($rate , 2);
}

//left conn rate
function leftUserRate($conn){
	$curr_month = date("Y-m");
	$leftUserCurrent = countLeftUsers($curr_month,$conn);
	//count Previous month
	$pre_month = date('Y-m', strtotime("-1 Months"));
	$leftUserPre = countNewUsers($pre_month,$conn);

	$rateLeft = (($leftUserCurrent - 1) / 1)*100;
	return round($rateLeft , 2);
}

//monthly bill rate
function monthlyBillRate($conn){
	$curr_month = date('F-Y');
	$monthlyBillCurrent = countMonthlyBill($curr_month,$conn);
	//count Previous month
	$pre_month = date('F-Y', strtotime("-1 Months"));
	$monthlyBillPre = countMonthlyBill($pre_month,$conn);

	$rateMonthly = (($monthlyBillCurrent - $monthlyBillPre) / $monthlyBillPre)*100;
	return round($rateMonthly , 2);
}

function countSolvedTicket($month_select,$username,$conn){
	$countSolvedTicket = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM tickets WHERE ass_person = '$username' && close_date BETWEEN '$month_select-01' AND '$month_select-30'"));
	return $countSolvedTicket[0];
}
function countTasks($month_select,$username,$conn){
	$countTasks = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM tasks WHERE assigned_person = '$username' && finish_time BETWEEN '$month_select-01' AND '$month_select-30'"));
	return $countTasks[0];
}

function sumAreaWiseBill($area,$conn){

	$add509=mysqli_query($conn,"SELECT SUM(monthly_bill) from `users` WHERE area = '$area' ");
	while($row509=mysqli_fetch_array($add509))
	{
		$sumAreaWiseBill=$row509['SUM(monthly_bill)'];
		return $sumAreaWiseBill;
	}

}

function projectedProfit($conn){
	$profitLastMonth = sumMonthlyProfit(date('F-Y', strtotime("-1 Months")),$conn);
	$growthThisMonth = monthlyBillRate($conn);
	$projectedProfit = $profitLastMonth + ($profitLastMonth * ($growthThisMonth / 100));
	return round($projectedProfit);
}

function newUsersBill($fromDate,$conn){

	$add510=mysqli_query($conn,"SELECT SUM(monthly_bill) from `users`  WHERE activation_date BETWEEN '$fromDate-01' AND '$fromDate-30' ");
	while($row510=mysqli_fetch_array($add510))
	{
		$newUsersBill=$row510['SUM(monthly_bill)'];
		return $newUsersBill;
	}

}



function getSmsBalance(){
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://esms.mimsms.com/miscapi/C2006488600af9e92648e2.93379022/getBalance",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	return trim($response,"Your Balance is:BDT");
	curl_close($curl);
}

?>