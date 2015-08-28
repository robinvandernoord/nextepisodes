/*
CHANGELOG: MONDAY 27 JULY 2015:
Fixed indention
Removed old parts
Used parseInt() instead of '- 1 + 1'
Added semi-colons
*/
/*
CHANGELOG: SUNDAY 26 JULY 2015:
Added time.today: current Date
Added time.tomorrow: next Date
Added time.today(object): current date as an object
Added time.tomorrow(object): next date as an object
Removed time.from
*/




var object = "object";

function formatDate(date) { // get the date in proper format
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    monthT = month;
    yearT = year;
    dayT = day;

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

var time = {};
time.until = function (date) {
    var currentTime = formatDate(new Date());
    var year = parseInt(date.substring(0, 4), 10);
    var month = parseInt(date.substring(5, 7), 10);
    var day = parseInt(date.substring(8, 10), 10);

    var curMonth = monthT;
    var curDay = dayT;
    var curYear = yearT;

    var monthBefor = month - 1;

    var difDay = day - curDay;
    var difMonth = month - curMonth;
    var difWeek = 0;
    if (difDay < 0) {
        difMonth--;
        if (monthBefor === 0) {
            monthBefor = 12;
        }
        switch (monthBefor) {
            case 1:
            case 3:
            case 5:
            case 8:
            case 7:
            case 10:
            case 12:
                difDay = difDay + 31;
                break;
            case 4:
            case 6:
            case 9:
            case 8:
            case 11:
                difDay = difDay + 30;
                break;
            case 2:
                if (year % 4 === 0) {
                    difDay = difDay + 29;
                } else {
                    difDay = difDay + 28;
                }
                break;
            default:
                console.log("error");
                break;

        }
    }
    if (difMonth < 0) {
        difMonth += 12;
        year--;
    }
    while (difDay >= 7) {
        difDay = difDay - 7;
        difWeek++;
    }

    var difYear = year - curYear;
    return {
        days: difDay,
        weeks: difWeek,
        months: difMonth,
        years: difYear
    };

},
time.today = function (object) {
    var today = formatDate(new Date());
    if (object == "object") {
        var obj = {};
        var yearO = parseInt(today.substring(0, 4), 10);
        var monthO = parseInt(today.substring(5, 7), 10);
        var dayO = parseInt(today.substring(8, 10), 10);
        obj = {
            _when: "today",
            year: yearO,
            month: monthO,
            day: dayO
        };
        return obj;
    } else {
        return today;
    }
};
time.tomorrow = function (object) {
    var tomorrow = formatDate(new Date());
    if (object == "object") {
        var obj = {};
        var yearO = parseInt(tomorrow.substring(0, 4), 10);
        var monthO = parseInt(tomorrow.substring(5, 7), 10);
        var dayO = parseInt(tomorrow.substring(8, 10), 10) + 1;
        obj = {
            _when: "tomorrow",
            year: yearO,
            month: monthO,
            day: dayO
        };
        return obj;
    } else {

        var tomorrowBegin = tomorrow.substring(0, 8);
        var tomorrowEnd = parseInt(dayT, 10) + 1;
        tomorrow = tomorrowBegin + tomorrowEnd;
        return tomorrow;
    }
};
