$(document).ready(function() {
var votesCasted,uploads;
var voted = 0;
class entry {
	constructor(src,name,id) {
		this.src = src;
		this.name = name;
		if(id === "ALREADY_VOTED") {
			this.id = '<button type="button" class="btn btn-primary disabled">You have already voted for this</button>'
		}
		else {
			this.id =  '<button type="button" class="btn btn-primary" onclick="vote('+id+')" id="voteFor'+id+'">Vote</button>'
		}
	}
}
var finalList = [];
var tableHTML = "";
  //RE-instating cookie in case of lots cookies or changing browser
  if(document.cookie.length === 0) {
    $.post("getUsername.php",
      function(data) {
        if(data == "USER_NOT_FOUND") {
        location.href="checkAuth0.php"
        }
        else{
        document.cookie="username="+data  + ";expires= Thu, 7 Sep 2017 00:00:00 UTC; path=/";
        }
      });
  }
  $.ajaxSetup({async: false});
  //fetching casted vote list
  $.getJSON("getVotesCasted.php",
    function(dataVote) {
	votesCasted = dataVote;
	}
  );
  //Fetching uploads
  $.getJSON("getUploads.php",
    function(dataUpload) {
	uploads = dataUpload;
    }
  );
  for(var i = 0; i < uploads.length; i++) {
	  //creating array with printable data 
	  if(votesCasted !== undefined) {
		var voted = 0;
		for(var j = 0; j < votesCasted.length; j++) {
			if(votesCasted[j].choiceId == uploads[i].choiceId){ voted=1;};
		}	
	  
		finalList.push(new entry(uploads[i][1],uploads[i][2],((voted)?"ALREADY_VOTED":uploads[i][0])));
		}
		else { finalList.push(new entry(uploads[i][1],uploads[i][2],uploads[i][0])) }
  }
  //creating table
  for(var i =0; i<finalList.length; i++) {
	 tableHTML += '<tr><td><a class="pop"><img src= ' + finalList[i].src + ' height="200" width="400" "></a></td><td>'+finalList[i].name+'</td><td>'+finalList[i].id+'</td></tr>';
  }
  //printing out the entries
  $("#entryTable tbody").html(tableHTML);
  //Opening Modal
    $('.pop').on('click', function() {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');   
    }); 
});
function vote(a) {
	$.post("vote.php", {
		"choiceId" : a
	},function(data) {
		console.log(data);
		if(data == "success") {
			$("#voteFor"+a).addClass("disabled");
			$("#voteFor"+a).removeClass("btn-primary");
			$("#voteFor"+a).addClass("btn-success");
			$("#voteFor"+a).text("You have succesfully voted for this");
			
		}
		else {
			$("#voteFor"+a).addClass("disabled");
			$("#voteFor"+a).removeClass("btn-primary");
			$("#voteFor"+a).addClass("btn-danger");
			$("#voteFor"+a).text("You couldn't vote for this");
		}
	});
}
    
