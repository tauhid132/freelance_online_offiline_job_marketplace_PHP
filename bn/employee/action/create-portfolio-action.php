<?php  
include ('../../database/dbconnect.php');

$service_name = $_POST['service_name'];
$service_description = $_POST['service_description'];
$service_salary = $_POST['service_salary'];
$service_salary_method = $_POST['service_salary_method'];
$service_working_type = $_POST['service_working_type'];
$service_experience = $_POST['service_experience'];
$service_category = $_POST['service_category'];
$service_area = $_POST['service_area'];
$employee_email = $_POST['employee_email'];

mysqli_query($conn, "INSERT INTO service_portfolio (employee_email, service_name, service_description, service_salary, service_salary_method, service_working_type, service_experience, service_category, service_area) 
		VALUES 
		('$employee_email','$service_name', '$service_description', '$service_salary', '$service_salary_method', '$service_working_type', '$service_experience', '$service_category', '$service_area')
	");


$pid = mysqli_insert_id($conn);
$uploadsDir = "../../upload/";
$allowedFileType = array('jpg','png','jpeg');

        // Velidate if files exist
if (!empty(array_filter($_FILES['fileUpload']['name']))) {
	
            // Loop through file items
	foreach($_FILES['fileUpload']['name'] as $id=>$val){
                // Get files upload path
		$fileName        = $_FILES['fileUpload']['name'][$id];
		$tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
		$targetFilePath  = $uploadsDir . $fileName;
		$fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
		$uploadDate      = date('Y-m-d H:i:s');
		$uploadOk = 1;
		if(in_array($fileType, $allowedFileType)){
			if(move_uploaded_file($tempLocation, $targetFilePath)){
				$sqlVal = "('".$fileName."', '".$uploadDate."')";
			} else {
				$response = array(
					"status" => "alert-danger",
					"message" => "File coud not be uploaded."
				);
			}
			
		} else {
			$response = array(
				"status" => "alert-danger",
				"message" => "Only .jpg, .jpeg and .png file formats allowed."
			);
		}
		
		mysqli_query($conn,"INSERT into portfolio_image (portfolioId, imageLink) VALUES('$pid', '$fileName')");

		
	}
} else {
            // Error
	$response = array(
		"status" => "alert-danger",
		"message" => "Please select a file to upload."
	);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);



?>