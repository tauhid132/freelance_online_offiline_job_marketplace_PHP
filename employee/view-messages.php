<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>Messages</title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('../includes/stylesheet.php')  ?>
</head>
<body>


	
	<?php include('../includes/header-employee.php')  ?>

	<main class="browse-section">
		<div class="container">
			<div class="row">
				<?php include('includes/sidebar.php')  ?>
				<div class="col-lg-8 col-md-8 mainpage">
					<div class="account_heading">
						<div class="account_hd_left">
							<h1>Messages</h1>
						</div>

					</div>
					<?php include('includes/topbar.php')  ?>
					<div style="margin-top:150px">
						<div class="row">
							<div class="col-lg-4 g-0">
								<div class="card">
									<div class="card-body">
										<div class="srch_br">
											<input class="list_search" type="text" placeholder="Search">
											<i class="fas fa-search list_srch_icon"></i>
										</div>
										<div class="messages-list scrollstyle_4">
											<?php

											$email = $_SESSION['email'];
											$output = ''; 
											$sql7 = "SELECT * FROM employer WHERE emailAddress IN ((SELECT senderEmail FROM messages WHERE receiverEmail = '$email') UNION (SELECT receiverEmail FROM messages WHERE senderEmail = '$email'))";
											if($result7 = mysqli_query($conn, $sql7)){
												if(mysqli_num_rows($result7) > 0){
													while($row = mysqli_fetch_array($result7)){
														$sender = $row['emailAddress'];
														$query2=mysqli_query($conn,"SELECT * FROM messages WHERE receiverEmail = '$email'  and senderEmail = '$sender' ORDER by timestamp desc  LIMIT 1;");
														$result2=mysqli_fetch_array($query2); 

														$unseen = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM messages WHERE receiverEmail = '$email' && senderEmail='$sender' && seen=0 "));
														$output .='
														<a class="openchat" id="'.$row['emailAddress'].'">
														<div class="usr-msg-details" style="margin-top:25px">
														<div class="usr-ms-img">
														<img src="'.$url.'/'.$row['imageLink'].'" alt="">
														
														</div>
														<div class="usr-mg-info">
														<h3 >'.$row['fullName'].'</h3>
														<p>'.$result2['text'].'</p>
														</div>
														<span class="posted_time">'.$unseen[0].'</span>
														</div>
														</a>';

													}
												}
											} 
											echo $output;
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">

									<section class="msger">
										<header class="msger-header">
											<div id="receiver-info"></div>
											<div class="msger-header-options">
												<span><i class="fas fa-cog"></i></span>
											</div>
										</header>
										<form id="send_msg" method="post">
											<main class="msger-chat scrollstyle_4">
												<div id="message-box">


												</div>

											</main>

											<div class="msger-inputarea">
												<input type="text" name="message" class="msger-input" id="message" placeholder="Enter your message...">
												<button type="submit" class="msger-send-btn">Send</button>
											</form>
										</section>
									</div>

								</div>
							</div>
						</div>


					</div>
				</div>
			</main>


			<?php include('../includes/footer.php')  ?>


			<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>
			<button onclick="topFunction()" id="pageup2" title="Go to top"><i class="fas fa-arrow-up"></i></button>



			<?php include('../includes/js.php')  ?>


			<script type="text/javascript">

				$(document).ready(function(){

					var sender = '<?php echo $_SESSION['email']; ?>';
					var globalReceiver;

					$(".openchat").on('click', function() {
						var receiver = $(this).attr("id");
						globalReceiver = receiver;

						reload_messages();
						$.ajax({  
							url:"action/get-receiver-info.php",  
							method:"post", 
							data:{receiver:receiver}, 
							success:function(data){  
								$('#receiver-info').html(data);  
							}  
						}); 
					});

					

					function reload_messages(){
						$.ajax({  
							url:"action/load-message.php",  
							method:"post", 
							data:{sender:sender,receiver:globalReceiver},  
							success:function(data){  
								$('#message-box').html(data);  
								var messageBody = document.querySelector('.msger-chat');
								messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;


							}  
						});  
					}

					function showMessage(messageHTML) {
							//$('#chat-box').append(messageHTML);
							alert(messageHTML);
						}

						$(document).ready(function(){
							var websocket = new WebSocket("ws://103.132.154.10:8090/demo/php-socket.php"); 
							websocket.onopen = function(event) { 
								// showMessage("<div class='chat-connection-ack'>Connection is established!</div>");		
							}
							websocket.onmessage = function(event) {
								var Data = JSON.parse(event.data);
								if(Data.messageType == 'chat' &&  globalReceiver != undefined){
									reload_messages();
								}
								
								
							};

							websocket.onerror = function(event){
								showMessage("<div class='error'>Problem due to some Error</div>");
							};
							websocket.onclose = function(event){
								showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
							}; 

							$('#send_msg').on("submit",function(event){
								event.preventDefault();
								var message = $('#message').val();
								$.ajax({  
									url:"action/send-msg.php",  
									method:"POST",  
									data:{sender:sender,receiver2:globalReceiver,message:message}, 
									beforeSend:function(){  

									},  
									success:function(data){  
										$('input[name=message').val('');
										var messageJSON = {
											messageType: 'chat',
											message: ' '
										};
										websocket.send(JSON.stringify(messageJSON));
									}  
								});  		
								
							});
						});

					});
				</script>

				<!-- Mirrored from gambolthemes.net/html-items/jobby/jobby-medical/hospital_dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 15:41:37 GMT -->
				</html>