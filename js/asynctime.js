setInterval(function ()
{ 
var d = new Date();
var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
var hours = d.getHours();
var minutes = d.getMinutes();
var seconds = d.getSeconds();
var meridiem = null;
var greetings = null;
if((hours>18 && hours <= 23)||(hours >= 0 && hours <= 3)){greetings = "Good Evening";}
else if( hours > 3 && hours <= 11 ){greetings = "Good Morning";}
else if( hours > 11 && hours <= 18 ){greetings = "Good Afternoon";}
else{greetings = "Good Day";}
if( hours == 0 ){hours =12;meridiem = "am";}
else if ( hours > 0 && hours <= 11 ){meridiem = "am";}
else if ( hours == 12) { hours =12; meridiem = "pm";}
else{hours = hours - 12; meridiem = "pm";}
if(minutes<=9)
{
minutes="0"+minutes;
	}
if(seconds<=9)
{
seconds="0"+seconds;
	}

document.getElementById('lotus-txt-time').innerHTML = "<b>"+hours+"</b>"+":"+minutes+" " + meridiem;
document.getElementById('get_day').innerHTML = days[d.getDay()] + ",";
document.getElementById('get_date').innerHTML = month[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
document.getElementById('splashgreet').innerHTML = greetings;
document.getElementById('current_time').innerHTML = "<b>"+hours+"</b>"+":"+minutes+":<span id='smallsecond'>" + seconds + "</span> " + meridiem;
},1000);
