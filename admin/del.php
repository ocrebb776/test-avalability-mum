<?php 
$file = "../codes.json";
$data = json_decode(file_get_contents($file),true);
unset($data[$_GET["code"]]);
file_put_contents($file,json_encode($data,true));
echo "<script>window.location.href='dates.php?code=".$_GET["codes"]."'</script>"
?>
