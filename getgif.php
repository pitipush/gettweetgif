<?php

$url = @$_REQUEST['url'];

echo "

<!DOCTYPE HTML>
<html lang='es-ES'>
<head>
<title>Get Tweet Gif</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>

</head>
<body>
";
	

echo "<div id='divactua' class='text-center'> 
	<h1>Get tweet gif</h1>
	<h3>If you like a GIF in Tweet ... catch it!</h3>
	<p>	Tweet url can be obtained in \"...\" of tweet (web version), using \" Copy tweet link \" </p>
	<form name='actua' id='actua' method='post' action='".$_SERVER['PHP_SELF']."'>
	<label for='url' class='control-label'>Tweet url: </label>
	<input type='url' class='form-control' name='url' id='url' value='".$url."' placeholder='https://twitter.com/.....'>
	<p></p>
	<input type='submit' class='btn btn-large  btn-primary' value='Extract' name='extraer'>
	</form>
	</div>";	

if($url){	
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');		
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'dapargelrss:BMbiYJ8fyV');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,20); 
		curl_setopt($ch, CURLOPT_PROXY, 'proxy.eroski.es:8081');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
				<p>You can download it as .mp4 video file (left mouse & Save video) or convert into an animated .gif with a online converter</p>
				</div>";
				
			}else{
				
				echo "<div id='divresp' class='text-center'>
				<p>Sorry, the .gif could not be recovered :( </p>
				</div>";
				
			}
		}
}

?>
</body>
</html>