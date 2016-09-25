<?php

	// Hide warnings
	error_reporting( 0 );
	
	// So we know we're in the script
	define( 'IN_YOUTUBE_EMBEDDER', true );
	
	// To see source code
	if( isset( $_GET['code'] ) )
	{
		die( highlight_file( __FILE__ , 1 ) );
	}
	
	/*
		 The function of this script is to locate any youtube media URLs and replace them 
		 with an embedded youtube player. Facebook does this when you paste a youtube link
		 into a status update.
	*/
	
	// Make sure the user typed something in to begin with
	if( $_POST['submit'] || $_POST['detect'] )
	{
		if( $_POST['theText'] == '' )
		{
			$error = '<p class="error" id="errorMessage" >Please enter some text to search through first!</p>';
		}
		else
		{
			$input = strip_tags( $_POST['theText'] );	
		}
	}
	
	$result = '<div id="result">' . PHP_EOL;
	
	if( $_POST['submit'] )
	{
		$new = preg_replace
		( 
			'/(http:\/\/)?(www\.)?((youtube\.com\/watch\?v=)|(youtu\.be\/))([\d\w]+)\S*/', 
			'<iframe width="560" height="315" src="http://www.youtube.com/embed/$6" frameborder="0" allowfullscreen></iframe><br />', 
			$input
		);
		
		$result = $new;	
		}
	elseif( $_POST['detect'] )
	{
		// Youtube search
		preg_match_all( '/(http:\/\/)?(www\.)?((youtube\.com\/watch\?v=)|(youtu\.be\/))([\d\w]+)/', $input, $matches);
		$count = count( $matches[6] );
		if( $count > 0 )
		{
			$result .= "Youtube($count): <br /> <ul>";
			foreach( $matches[6] as $match )
			{
				$result .= "<li>
				<a href='http://www.youtu.be/$match'>
					$match  <br />
					<img src='http://img.youtube.com/vi/$match/1.jpg' />
					<img src='http://img.youtube.com/vi/$match/2.jpg' />
					<img src='http://img.youtube.com/vi/$match/3.jpg' />
					</a>
				</li>";
			}
			$result .= "</ul>";
		}
		
		// Image search
		preg_match_all( '/(http:\/\/)[\S]+\.(jpg|gif|png|jpeg|bmp)/', $input, $matches);
		$count = count( $matches[0] );
		if( $count> 0 )
		{
			$result .= "Images($count): <br /> <ul>";
			foreach( $matches[0] as $match )
			{
				$result .= "<li><a href='$match'>$match</a></li>";
			}
			$result .= "</ul>";
		}
		
		// Vimeo search
		preg_match_all( '/(http:\/\/)?(www\.)?vimeo\.com\/([\d]+)/', $input, $matches);
		$count = count( $matches[3] );
		if( $count> 0 )
		{
			$result .= "Vimeo($count): <br /> <ul>";
			foreach( $matches[3] as $match )
			{
				$result .= "<li><a href='http://www.vimeo.com/$match'>$match</a></li>";
			}
			$result .= "</ul>";
		}
	}
	
	$result = (!$error) ? $result . PHP_EOL . '</div>' : '';
	require( 'template.php' );
	
?>
