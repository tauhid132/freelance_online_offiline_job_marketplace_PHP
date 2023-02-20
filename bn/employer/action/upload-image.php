<?php
include ('../../database/dbconnect.php');
$email = $_POST['email'];
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "../../upload/".$_FILES['userImage']['name'];
$img_link = "upload/".$_FILES['userImage']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img class="image-preview" src="<?php echo $targetPath; ?>" class="upload-preview" />
<?php
}
}
}

 mysqli_query($conn,"  
           UPDATE employer   
           SET imageLink='$img_link'
           WHERE emailAddress='$email'"); 


?>