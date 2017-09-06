var err = [
  "File is not an image",
  "Please insert a username",
  "Sorry, file already exists.",
  "Sorry, your file is too large.",
  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.",
  "Sorry, your file was not uploaded.",
  "Your file was successfully uploaded! Good luck ^_^"
  ]
function $_GET(q,s) {
    s = (s) ? s : window.location.search;
    var re = new RegExp('&amp;'+q+'=([^&amp;]*)','i');
    return (s=s.replace(/^\?/,'&amp;').match(re)) ?s=s[1] :s='';
}
$(document).ready(function() {
  if($_GET("output").length==1) {
  var errType = parseInt($_GET("output"));
  if(errType != 6) {
    $("#output").addClass("alert-danger");
  }
  else{
    $("#output").addClass("alert-success");
  }
  $("#output").text(err[errType]);
  $("#output").show();
  }
})
