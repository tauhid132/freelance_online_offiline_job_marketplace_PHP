<?php
    include('conn.php');
	$username=$_POST['username'];
	$query=mysqli_query($conn,"select * from `users` where username='$username'");
	$result=mysqli_fetch_array($query);
	$mobile=$result['mobile'];
	
    $smstext="Dear Customer, your password is 123456. Thank You. ATS Technology";




try{
 $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
 $paramArray = array(
 'userName' => "01751968954",
 'userPassword' => "2b897c5425",
 'mobileNumber' => "$mobile",
 'smsText' => "$smstext",
 'type' => "TEXT",
 'maskName' => '',
 'campaignName' => '',
 );
 $value = $soapClient->__call("OneToOne", array($paramArray));
 echo $value->OneToOneResult;
} catch (Exception $e) {
 echo $e->getMessage();
}
header("location:../login.php");
?>