<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test-avalability</title>
    <link rel="stylesheet" href="style.css">
</head>
<h1>Test Avalabilitys</h1><br>
<body>

    <div class="task" id="task"></div>
    <div class="side">
<h1>KEY</h1>
<div class="today key">Current Day</div>
        <div class="busy key">Fully booked</div>
        <div class="semi key">semi-booked(click on date for details)</div>
        <div class="free key">Free</div>
        
        <h2> <b>! Must Give 24hrs notice before test !</b>
        </h2>
        <h3><u>Site Made By Oliver Crebbin</u></h3>

    </div>
</body>	

<script>
    <?php
$codes = json_decode(file_get_contents("codes.json"),true); 
$code = $_GET["code"];
$go = true;
function fail(){
echo 'alert("Incorect Code");window.location.href = "index.html";';
$go = false;
}
set_error_handler("fail");
$name = $codes[$code];

$dates = file_get_contents("dates.json");
echo 'let dates = '.$dates;

?>

</script>
<script src="main.js"></script>

</html>