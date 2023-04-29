function debug(name, data) {
    console.log(name + String(data))
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
let dates = {
    "2023": {
        "4": {
            "30": ["semi", "hello"]
        },
        "5": {
            "12": ["busy", "hi"],
            "30": ["semi", "hello"],
            "7": ["semi", "hello"]
        }
    }
}
let frad
let msg

function getmonth(date, tmonth, tyear) {

    current = new Date()
    firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    firstdayw = firstDay.getDay()
    lastdayd = lastDay.getDate()
    dayofweek = firstdayw
    console.log(mcalendar)
    mcalendar = [
        [0, 0, 0, 0, 0, 0, 0]
    ]

    console.log(mcalendar)

    day = 1
    week = 1
    month = []
    while (day <= lastdayd) {

        debug("day", day)
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

    console.log(mcalendar)

    mcalendar.forEach(el => {
        let y = 0
        el.forEach(elen => {
            if (elen > 0) {
                let today = false

                if (elen == current.getDate() && tmonth - 1 == current.getMonth() && tyear == current.getFullYear()) { today = true }
                free = "free"
                msg = ""
                try {
                    console.log(elen)
                    frad = dates[String(tyear)][String(tmonth)][String(elen)]
                    console.log("yes")
                    free = frad[0]
                    msg = frad[1]
                } catch {
                    free = "free"
                }


                month[month.length] = { "day": elen, "today": today, "free": free, "msg": msg }
            } else {
                month[month.length] = "X"
            }

            y++
        });
        month[month.length] = "E"
    });
    console.log(month)
    return month
}
let cal = []
let year = dat.getFullYear()
let m = dat.getMonth() + 1
const months = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
let x = 0
while (x < 13) {
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
        onc = ""
        if (el == "E") {
            tx += "</tr><tr>"
        } else if (el == "X") {
            tx += "<td></td>"
        } else {
            if (el["free"] == "free") {
                fr = "free"
            } else if (el["free"] == "busy") {
                fr = "busy"
                onc = 'alert("' + el["msg"] + '")'
            } else {
                fr = "semi"
                onc = 'alert("' + el["msg"] + '")'
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
console.log(cal)

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