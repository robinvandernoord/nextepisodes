var movie = prompt("name a movie");
function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
var Movie = toTitleCase(movie)
var currentTime = formatDate(new Date())

function similar(id,data){
  if(data == undefined){
document.getElementById("bottom").innerHTML = "<h1 onclick='search(movie)'><- I meant another \"" + Movie + "\"<br></h1>"}else{document.getElementById("bottom").innerHTML = ""}
theMovieDb.movies.getSimilarMovies({"id":id }, function(data){
var data = JSON.parse(data)
for(var i = 0; i < data.results.length; i++){
var future = "<span style='color:red'>"
if(data.results[i].release_date > currentTime){
var til = time.until(data.results[i].release_date)
    if(til.years > 0) if(til.years == 1) future += til.years + " year "; else future += til.years + " years "
if(til.months > 0) if(til.months == 1) future += til.months + " month "; else future += til.months + " months "
if(til.weeks > 0) if(til.weeks == 1) future += til.weeks + " week "; else future += til.weeks + " weeks "
if(til.days > 0) if(til.days == 1) future += til.days + " day"; else future += til.days + " days"
}
document.getElementById("bottom").innerHTML += (data.results[i].title +" (" + data.results[i].release_date.substring(0,4)+ "): " + data.results[i].overview +"<br>"+future+ "</span><br><br>")}
}, function(error){})
}
function search(movie){
theMovieDb.search.getMovie({"query":movie}, function(data) {

var data = JSON.parse(data)
if(data.results.length === 0) {document.getElementById("bottom").innerHTML = "<h1>We couldn't find \"" + Movie + "\"</h1>"}else{
  document.getElementById("bottom").innerHTML = ""
  document.getElementById("bottom").innerHTML += "<h1>Which \"" + Movie + "\" do you mean?"
for(var i = 0; i < data.results.length; i++){
if(data.results[i].release_date != null){
var date = data.results[i].release_date.substring(0,4)
var message = data.results[i].overview
if(data.results.length === 0) {document.innerHTML += "<div>We couldn't find " + Movie + "</div>"}
else if(data.results.length == 1) {similar(data.results[i].id,data);} else {

document.getElementById("bottom").innerHTML += ("<div title='"+message+"' onclick='similar("+data.results[i].id+")'>" +
data.results[i].title + "&nbsp(" + date + ")<br></div>")
}

}}}
},function(error){
  var error = JSON.parse(error)
})
}
search(movie)
