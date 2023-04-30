<?php 
$file = "../dates.json";
$data = json_decode(file_get_contents($file),true);
$year =$_POST["year"];
$month=$_POST["month"];
$day=$_POST["day"];
$type=$_POST["type"];
$text=$_POST["text"];
$data[$year][$month][$day] = [$type,$text];
file_put_contents($file,json_encode($data,true));
echo "<script>window.location.href='dates.php?code=".$_POST["code"]."'</script>"
?>
