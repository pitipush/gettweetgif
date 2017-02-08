<?php

$url = @$_REQUEST['url'];

echo "
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='Download twitter gif' content=''>
    <meta name='author' content=''>

    <title>Download Twitter Gif</title>


    <link href='global.css' rel='stylesheet'>
    <link href='bootstrap.min.css' rel='stylesheet'>
  </head>

  <body>
";

echo "
    <div class='site-wrapper'>

      <div class='site-wrapper-inner'>

        <div class='cover-container'>

          <div class='masthead clearfix'>
            <div class='inner'>
			  <h1 class='cover-heading'>Download twitter animated gif</h1>
              <h2>If you like an animated GIF in twitter ... catch it!</h2>
            </div>
			
          </div>

          <div class='inner cover'>	
			<img src='twitterbird.gif'>
            <p class='lead'>
				<form name='actua' id='actua' method='post' action='".$_SERVER['PHP_SELF']."'>
					<label for='url' class='control-label'>Tweet url: </label>
					<div class='input-group'>
						<input type='url' class='form-control' name='url' id='url' value='".$url."' placeholder='https://twitter.com/....'>
					<span class='input-group-btn'>	
						<input type='submit' class='btn btn-large  btn-primary' value='Extract' name='extraer'>
					</span>
					</div>
				</form>
            </p>
          </div>
";


if($url){	
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');		
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,20); 
		$res=curl_exec($ch);
		curl_close($ch);
		
		
		if(!$res) {
			echo curl_error($ch);
			die();
		}else{

			$patron="/pbs.twimg.com\/tweet_video_thumb\/([\w]*)/";
			if(preg_match($patron, $res, $match)){ 

				echo "<div id='divresp' class='text-center'>
				<a href='https://pbs.twimg.com/tweet_video/".$match[1].".mp4' target=_blank> Link to video (open new window)</a> 
				<p>You can download it as .mp4 video file (left mouse & save video) or convert into an animated .gif with a online converter, like <a href='https://convertio.co/es/mp4-gif/' target='_blank'>Convertio</a></p>
				</div>";
				
			}else{
				
				echo "<div id='divresp' class='text-center'>
				<p>Sorry, the .gif could not be recovered :( </p>
				</div>";
				
			}
		}
}else{

	echo "<div class='inner-cover'>    
				  <p class='lead'>Tweet url can be obtained in \"v\" of tweet (web version), using \" Copy link to tweet\" </p>
				  <figure><img src='twitter-link.jpg'></figure>
				  <p class='lead'>Twitter not serve animated GIF really ... all is MP4 format, but they say 'It's a GIF!' </p>
				  <p class='lead'>With this tool, you can download the MP4 file and then convert it, with other service, into a GIF file...or not.</p>  
				  
		  </div>
		 ";
		 
echo "    <div class='mastfoot'>
            <div class='inner'>
              <p>Get gif from a tweet , by <a href='https://simpleini.com'>Simpleteam</a>.</p>
            </div>
          </div> ";
}
echo "
		 </div>
      </div>
    </div>
	
</body>
</html>

";


?>
