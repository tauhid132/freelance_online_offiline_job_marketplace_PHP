<?php


date_default_timezone_set("Asia/Dhaka");


$sample = "2022-05-13 19:20:41";

$convertedTime = date('Y-m-d H:i:s', strtotime('+50 minutes', strtotime($sample)));

$current = date("Y-m-d H:i:s");


$start = strtotime($current);
$end   = strtotime($convertedTime);

if($end > $start) {
 echo "Yes";
}
else{
    echo "No";
}
echo $current;
echo $convertedTime;
?>