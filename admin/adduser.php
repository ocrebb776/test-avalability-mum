<?php 
$file = "../codes.json";
$data = json_decode(file_get_contents($file),true);
$rand = strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9));
while(true){
    if(array_key_exists($rand,$data)){
        $rand = strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9)).strval(rand(1,9));
    }else{
        break;
    }
}
$data[$rand] = [$_POST["name"],$rand];
file_put_contents($file,json_encode($data,true));
echo "<script>window.location.href='dates.php?code=".$_POST["code"]."'</script>"

?>