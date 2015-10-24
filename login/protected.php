<html>
<head>
	<title>Next Episodes My Shows</title>
	<link rel="icon" sizes="any" mask href="http://van-der-noord.nl/nextepisodeslogo.svg">
<link rel="apple-touch-icon" sizes="57x57" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="http://van-der-noord.nl/whensmyshow/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="http://van-der-noord.nl/whensmyshow/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="http://van-der-noord.nl/whensmyshow/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="http://van-der-noord.nl/whensmyshow/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="http://van-der-noord.nl/whensmyshow/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="http://van-der-noord.nl/whensmyshow/manifest.json">
<link rel="shortcut icon" href="http://van-der-noord.nl/whensmyshow/favicon.ico">
<meta name="apple-mobile-web-app-title" content="Next Episodes">
<meta name="application-name" content="Next Episodes">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="http://van-der-noord.nl/whensmyshow/mstile-144x144.png">
<meta name="msapplication-config" content="http://van-der-noord.nl/whensmyshow/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
</head>
<style>
#content {
    position: relative;
}
#content img {
    position: absolute;
    top: 0px;
    right: 0px;
}
#content2 {
    position: relative;
}
#content2 img {
    position: absolute;
    top: 0px;
    right: 45px;
}
</style><a href="index.php?logout=true">
<div id="content">
    <img width="40px" height="40px" src="https://cdn2.iconfinder.com/data/icons/network-roundline/512/logout-512.png" class="ribbon"/>
</div></a><a href="http://robinvandernoord.github.io/nextepisodes"><div id="content2">
		<img width="40px" height="40px" src="http://i.imgur.com/WcYCPBJ.png" class="ribbon"/>
</div></a>

<?php require_once 'includes/User.class.php';
require_once 'includes/main.php';

$user = new User();

if(!$user->loggedIn()){
	redirect('index.php');
}

$id = $_SESSION['loginid'];

mysql_connect("db.WEBSI.TE", "USER1", "PASS1") or die(mysql_error());
mysql_select_db("NAME1") or die(mysql_error());

$query = mysql_query("SELECT * FROM reg_users WHERE id = $id");
$rows = array();
while($row = mysql_fetch_assoc($query)) {
    $rows[] = $row;
}


$toJs = json_encode($rows);

function del() {
	$id = $_SESSION['loginid'];
	mysql_connect("db.WEBSI.TE", "USER1", "PASS1") or die(mysql_error());
	mysql_select_db("NAME1") or die(mysql_error());
	$query = mysql_query("DELETE FROM reg_users WHERE id = $id");
	mysql_query($query);
}

if (isset($_GET['del'])) {
	del();
}
?><script>
function delred(){
	var really = confirm("are you sure you want to remove your account?")
	if(really){
window.location.replace("http://van-der-noord.nl/login/demo/protected.php?del=true");
}
//	alert("hi");

}
</script>
<script type="text/javascript" src="http://van-der-noord.nl/whensmyshow/themoviedb.js"></script>
<script type="text/javascript" src="http://van-der-noord.nl/scripts/time.to.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="style.css">
<body><center overflow: hidden;>
	<form action="upload.php" method="post">
	<?php print "<input type='text' name='id' value='{$id}' style='display:none'>";?>
  <input class="form" type="text" name="show1">
	<div class="replace" id="replace1"></div>
	<input class="form" type="text" name="show2">
	<div class="replace" id="replace2"></div>
	<input class="form" type="text" name="show3">
	<div class="replace" id="replace3"></div>
	<input class="form" type="text" name="show4">
	<div class="replace" id="replace14"></div>
	<input class="form" type="text" name="show5">
	<div class="replace" id="replace5"></div>
	<input class="form" type="text" name="show6">
	<div class="replace" id="replace6"></div>
	<input class="form" type="text" name="show7">
	<div class="replace" id="replace7"></div>
	<input class="form" type="text" name="show8">
	<div class="replace" id="replace8"></div>
	<input class="form" type="text" name="show9">
	<div class="replace" id="replace9"></div>
	<input class="form" type="text" name="show10">
	<div class="replace" id="replace10"></div>
	<input style="float:center" type="submit" class="button"></input>
</form>	<button  type="submit" onclick="delred()">!! Delete my info !!</button></center>
	<script>
	var PHPdata = '<?php print $toJs; ?>'
	var JSONdata = JSON.parse(PHPdata)
		for(var i = 1; i < 11; i++){
			vara = i;
	//		console.log(vara)
			vara = vara.toString()
		//	console.log(vara)
			var equals = eval("JSONdata[0].show" + vara)
			document.getElementsByName("show" + i)[0].value = equals;
		}


//here's the TVDB part
// delete(), reset(), save(), del, load() etc are not needed because of PHP
function setText(text,i){
  document.getElementById("replace" + i).innerHTML = text;
  document.getElementById("replace" + i).style.display = "block";

}

function tvdb(serie, i, u) {
var today = formatDate(new Date());
theMovieDb.search.getTv({"query":serie}, function(data) {
  var data = JSON.parse(data)
  data = data.results[0]
    if(data == undefined){setText("Show not found", i)}
  var id = data.id
  theMovieDb.tv.getById({"id":id}, function(data) {
    var data = JSON.parse(data)
    var name = data.name;
//    localStorage.setItem("show" + i, name)
    document.getElementsByName("show" + i)[0].value = name
    var LAD = data.last_air_date;
    var seasons = data.seasons
    if(Boolean(data.seasons[data.seasons.length - 1].air_date)){
    var nextSeason = data.seasons[data.seasons.length - 1].air_date} else {
      var nextSeason = data.seasons[data.seasons.length - 2].air_date
    }
if(nextSeason > today){ // new season
  var days = "";
  var months = "";
  var weeks = "";
  var years = "";
  var nextSeason = nextSeason.toString();
  var countdownJSON = time.until(nextSeason)
  if(countdownJSON.days == 1){var days = "1 day."}else if(countdownJSON.days == 0){}else{var days = countdownJSON.days + " days."}
  if(countdownJSON.weeks == 1){var weeks = "1 week "}else if(countdownJSON.weeks == 0){}else{var weeks = countdownJSON.weeks + " weeks "}
  if(countdownJSON.months == 1){var months = "1 month "}else if(countdownJSON.months == 0){}else{var months = countdownJSON.months + " months "}
  if(countdownJSON.years == 1){var years = "1 year "}else if(countdownJSON.years == 0){}else{var years = countdownJSON.years + " years "}
var countDown = years + months + weeks + days;
  var text = "the next season of " + name + " airs in " + countDown;
  setText(text,i)
}
else if(nextSeason < today){
  if(data.status = "Canceled" && data.in_production === false){
  var text = name + " is over. :(";
  setText(text,i)
}else{
  theMovieDb.tvSeasons.getById({"id":data.id, "season_number": data.seasons[data.seasons.length - 1].season_number},
  function(data){
    var data = JSON.parse(data)
   //console.log(data)
   for(var i = data.episodes.length ; i > 0; i--){
     if(Boolean(data.episodes[i])){
     //console.log(data.episodes[i].air_date + today)
     if(data.episodes[i].air_date > today) {
       var latest = data.episodes[i].air_date
     }
   }
   }
   if(Boolean(latest)){
  // console.log(latest + name)
   var days = "";
   var months = "";
   var weeks = "";
   var years = "";
   var latest = latest.toString();
   var countdownJSON = time.until(latest)
   if(countdownJSON.days == 1){var days = "1 day."}else if(countdownJSON.days == 0){}else{var days = countdownJSON.days + " days."}
   if(countdownJSON.weeks == 1){var weeks = "1 week "}else if(countdownJSON.weeks == 0){}else{var weeks = countdownJSON.weeks + " weeks "}
   if(countdownJSON.months == 1){var months = "1 month "}else if(countdownJSON.months == 0){}else{var months = countdownJSON.months + " months "}
   if(countdownJSON.years == 1){var years = "1 year "}else if(countdownJSON.years == 0){}else{var years = countdownJSON.years + " years "}
inshow = "the next episode of " + name + " airs in " + years + months + weeks + days;
//console.log(i)
setText(inshow, u)
}
else{
  var tooBad = "We don't know when the next episode of " + name + " airs.."
  setText(tooBad, u)
}
  },function(error){})
}
}
  }, function(error){})
},function(error){})
 }
  function update(){
    for(var i = 1; i < 11; i++){
      if(Boolean(document.getElementsByName("show" + i))){
				var PHPdata = '<?php print $toJs; ?>'
				var JSONdata = JSON.parse(PHPdata)

    var show = "show" + i;
		var nr = "show" + i.toString();
		console.log(nr)
		var jsondat = "JSONdata[0]." + nr
var value = eval(jsondat)
    tvdb(value, i, i)
  }
}
  }
	update()
	</script>
</body>
</html>
<?php mysql_close(); ?>
