<?php
include('../../db/conn.php');
$username = $_POST['username'];
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "../../uploads/".$_FILES['userImage']['name'];
$img_link = "uploads/".$_FILES['userImage']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img class="image-preview" src="<?php echo $targetPath; ?>" class="upload-preview" />
<?php
}
}
}

 mysqli_query($conn,"  
           UPDATE admin   
           SET image='$img_link'
           WHERE username='$username'"); 


?>