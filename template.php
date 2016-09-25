<?php
	if( !IN_YOUTUBE_EMBEDDER )
	{
		// Prevent direct access to the template file
		// Not really a big problem, but good practice
		exit( "Prohibited access" );
	}

	echo <<<HTML

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Media Detector</title>
<style type="text/css">
* {
	margin:0;
	padding:0;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
}
body {
	background: url( "./background_stripe.png" );
}

#wrapper {
	margin:15px auto;
	padding:20px;
	width: 760px;
	background:#FFF;
	border-radius: 15px;
}
input,textarea {
	padding:3px;
	
}
.error {
	background:#ff6666;
	border: 1px solid #cc3333;
	margin: 5px;
	padding:5px;
	border-radius:3px;
}
#top {
	background:#fff1d1;
	padding:5px;
	margin:-20px;
	margin-bottom:5px;
	border-radius:10px;
}

#top h1,#top h1 a,#top h1 a:visited {
	color:#000;
	font-size:18px;
	text-decoration:none;

}
#top p {
	padding-left:10px;
	margin-bottom:5px;
}
#top b {
	color: #6c5213;	
	font-style: normal;
	font-weight:bold;
}
#result a,#result a:visited {
	color:#000;
	text-decoration:none;
}
#result a:hover {
	color:#CCC;
}
ul {
	margin:10px;
}
li {
	padding:2px;
}
li:hover {
	border: 1px solid #EEE;
	padding:1px;
}
img {
float:inline;	
}
</style>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>

 
 <script>
 $(document).ready(function(){
       $("#errorMessage").mouseover(function(event){
         $("#errorMessage").hide("slow");
       });
	   $("#replaceText").mouseover(function () {
      		$("#submit").effect("highlight", {}, 400);
		});
		  $("#detectText").mouseover(function () {
      		$("#detect").effect("highlight", {}, 400);
		});
		
     });
	</script>

</head>

<body>
<div id="wrapper">

<div id="top">
    <h1><a href="{$_SERVER['PHP_SELF']}">Media Detection Script</a></h1>
    <p>By Dharik Patel, 2012</p>
    
    <p>This script will detect forms of media in a text input. For example, a YouTube video or image (ending in .gif,.jpg, or .png) will be detected. 
    The <b id="replaceText">Detect & Replace</b> button will attempt to replace the detected media with an embedded version of it, whereas the <b id="detectText">List detected media</b> button will output a list of media. 
    
    <p>In the future I may make results update in realtime (perhaps with every few keystrokes) using jQuery's AJAX functions. Furthermore, I could use the Youtube API to fetch
    the video title and description. </p>
    
    <p>If you'd like to see the regular expressions I used, click <a href="regexp.txt" >here.</a></p>
</div>

 <form action="{$_SERVER['PHP_SELF']}?submit=1" method="post">
    {$error}
	<textarea name="theText" id="theText" rows="4" cols="100" >
Hey! Check out this video http://www.youtube.com/watch?v=dQw4w9WgXcQ&ob=av3e
Also look at how cute these kittens are:http://i.imgur.com/vM8ds.jpg</textarea>
    <br />
    <input name="submit" type="submit" value="Detect & Replace" id="submit"/>
    <input name="detect" type="submit" value="List detected media" id="detect"/>
 </form>
    
   {$result}
  
</div>

</body>
</html>

    
HTML;
?>