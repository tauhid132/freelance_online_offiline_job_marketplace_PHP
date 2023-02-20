<?php
include ('database/dbconnect.php');
$sql = "SELECT * from service_categories";
$result = mysqli_query($conn, $sql);
$datas = array();
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		$datas[] = $row;
	}
}
?>
<ul id="country-list">
<?php
foreach($datas as $country) {
?>
<li onClick="selectCountry('<?php echo $country["catName"]; ?>');"><?php echo $country["catName"]; ?></li>
<?php } ?>
</ul>
