<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test-avalability</title>
    <link rel="stylesheet" href="http://127.0.0.1:5500/style.css">
    <style>
        .busy {
    background-color: red;
    color: white;
}

.semi {
    background-color: orange;
    color: white;
}

.free {
    background-color: #f5f5f5;
}

table:last-child {
    width: 100%;
    height: 90%;
}

table:first-child {
    width: 100%;
}

table:last-child * {
    text-align: center;
    border-radius: 10px;
    border: 1px solid white;
}

.top button {
    width: 90%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    font-size: larger;
}

.top button:hover {
    background-color: white;
}

.top button:active {
    background-color: black;
}

.today {
    background-color: rgb(131, 131, 255);
    color: white;
}

html {
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

@media only screen and (min-width: 700px) {
    .task {
        width: 500px;
        height: 500px;
        margin: auto;
    }

}

@media only screen and (max-width: 699px) {
    .task {
        width: 100vw;
        height: 100vw;
        margin: auto;
    }

}

.top {
    display: grid;
    grid-template-columns: 1fr 0.5fr 1fr 1fr 1fr;
    align-items: center;
    font-size: 30px;
    height: 10%;
}

.radio{
    width: 70%;
margin: auto;
    padding: 10px;

}
.radio:hover{
    width: 80%;
    padding: 15px;
}
.select{
    width: 90%;
    padding: 20px;
    margin: auto;
}
    </style>
</head>
<h1>Admin Portal</h1><br>
<body>

    <div class="task" id="task"></div>
    <div class="side">
        <table style="width:70%;"><tr>
            <th>Code</th>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
        <?php $scode = json_decode(file_get_contents("../codes.json"),true);
            foreach($scode as $co => $name){
                $form = "";
                $form .= "<form action='del.php' method='get'><input name='code'".'style="display: none;"'." value='".$co."'>";
                $form .= '<input name="codes" style="display: none;" value="'.$_GET["code"].'">';
                $form .= "<input type='submit' value='delete'></form>";
                echo "<tr><td>".$co."</td><td>".$name[0]."</td><td>".$form."<td></tr>";
            }
            
        
        ?>
    <form action="adduser.php" method="post">
        <input name="name" placeholder="Name" required>
        <button type="submit">Add user</button>
        <input name="code" style="display: none;" value="<?php echo $_GET["code"];?>">
    </form>    
    </table>
 <div id="side"></div>

    </div>

</body>	

<script>
    <?php
$codes = json_decode(file_get_contents("codea.json"),true); 
$code = $_GET["code"];
function fail(){
echo 'alert("Incorect Code");
window.location.href = "../admin";';
}
set_error_handler("fail");
$name = $codes[$code];

$dates = file_get_contents("../dates.json");
echo 'let dates = '.$dates.";";

?>
function debug(name, data) {
    console.log(name+" " + String(data))
}
let task = document.getElementById("task")

// get first and last day of monnth
let dat = new Date();

let current
let firstDay
let lastDay
    // get day of week of first day 
let firstdayw
let lastdayd
let dayofweek
let mcalendar
let day
let week
let month
let am
let pm

let frad
let msg

function getmonth(date, tmonth, tyear) {

    current = new Date()
    firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    firstdayw = firstDay.getDay()
    lastdayd = lastDay.getDate()
    dayofweek = firstdayw

    mcalendar = [
        [0, 0, 0, 0, 0, 0, 0]
    ]



    day = 1
    week = 1
    month = []
    while (day <= lastdayd) {

     
        mcalendar[week - 1][dayofweek - 1] = day
        if (dayofweek == 7) {
            dayofweek = 1
            mcalendar[week] = [0, 0, 0, 0, 0, 0, 0]
            week += 1
        } else {
            dayofweek += 1
        }

        day += 1

    }

  

    mcalendar.forEach(el => {
        let y = 0
        el.forEach(elen => {
            if (elen > 0) {
                let today = false

                if (elen == current.getDate() && tmonth - 1 == current.getMonth() && tyear == current.getFullYear()) { today = true }
                free = "free"
                msg = ""
                try {
                  
                    frad = dates[String(tyear)][String(tmonth)][String(elen)]
        
                    free = frad[0]
                    msg = frad[1]
                } catch {
                    free = "free"
                }


                month[month.length] = { "day": elen,"month":tmonth,"year":tyear ,"today": today, "free": free, "msg": msg }
            } else {
                month[month.length] = "X"
            }

            y++
        });
        month[month.length] = "E"
    });
    return month
}
let cal = []
let year = dat.getFullYear()
let m = dat.getMonth() + 1
const months = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
let x = 0
while (x < 100) {
    cal[x] = { "date": getmonth(new Date(year, m, 0), m, year), "month": m, "year": year }
    if (m == 12) {
        m = 1
        year += 1
    } else {
        m++
    }
    x++
}
let button = ["<button onclick='back()'><</button>", "<button onclick='forwards()'>></button>"]
let tx
let fr
let final = []
let onc
x = 0
cal.forEach(element => {
    tx = ""
    tx += "<div class='top'><div>" + months[element["month"] - 1] + "</div><div>-</div><div>" + element["year"] + "</div><div>" + button[0] + "</div><div>" + button[1] + "</div></div>"
    tx += "<table><tr><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th><th>S</th></tr>"
    tx += "<tr>"
    element["date"].forEach(el => {
        onc = "place("+String(el["day"])+","+String(el["month"])+","+String(el["year"])+")"
        if (el == "E") {
            tx += "</tr><tr>"
        } else if (el == "X") {
            tx += "<td></td>"
        } else {
            if (el["free"] == "free") {
                fr = "free"
            } else if (el["free"] == "busy") {
                fr = "busy"
                
            } else {
                fr = "semi"
              
            }
            if (el["today"]) {
                fr += " today"
            }


            tx += "<td onclick='" + onc + "' class='" + fr + "'>"
            tx += el["day"]
            tx += "</td>"
        }

    });
    tx += "</tr></table>"
    final[x] = tx
    x++


});

function back() {
    if (displaym > 0) {
        displaym -= 1
        task.innerHTML = final[displaym]
    }
}

function forwards() {
    if (displaym < final.length - 1) {
        displaym += 1
        task.innerHTML = final[displaym]
    }
}
let displaym = 0
task.innerHTML = final[displaym]
let side = document.getElementById("side")
let form
let opc
let s
let a
function change(l,op){
        op[l].classList.remove("radio")
        op[l].classList.add("select")
        op[s].classList.remove("select")
        op[s].classList.add("radio")
        op[4].value =  arr[l]
        s = l
        }
let arr = ["free","semi","busy"]
function place(day,month,year){
    try{
var exisitng = dates[year][month][day]
console.log(exisitng[0])
a = arr.indexOf(exisitng[0])
}catch{
    exisitng = ["free",""]
    a = 0
}
        
        s=a
  
      
    

    form = "<form action='save.php' method='post'>"
    form+= '       <div id="op1" class="radio free" onclick="change(0,opc)">Free</div><div id="op2" class="radio semi" onclick="change(1,opc)">semi</div><div id="op3" class="radio busy" onclick="change(2,opc)">busy</div>'
    form+= '<textarea name="text">'+exisitng[1]+'</textarea>'
    form+='<span style="display:none;"> <input name="year" value="'+year+'"><input name="month" value="'+month+'"><input name="day" value="'+day+'"><input name="type" id="type"><input name="code" value="<?php echo $_GET["code"];?>">   </span>'
    form+= '<button type="submit">Save</button>'
    side.innerHTML = form
    opc = [document.getElementById("op1"),document.getElementById("op2"),document.getElementById("op3"),document.getElementById("text"),document.getElementById("type")]
    opc[a].classList.remove("radio")
        opc[a].classList.add("select")

  
}

</script>
<script></script>
<style>


</style>
</html>
