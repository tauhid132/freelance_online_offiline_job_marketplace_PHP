<?php
	
	
	include('includes/routeros_api.class.php');			
    include('includes/connapi.php');
	$username=$_GET['user'];
	echo $username;
	$testServer = $testServer->comm("/ppp/active/remove
						=.id=".$_GET['user']."");	
	//echo "<script>alert('Kick User Successful.')</script>";
	//echo "<meta http-equiv='refresh' content='0;url=index.php?opt=pppoeonline' />";
	
	exit;

?>