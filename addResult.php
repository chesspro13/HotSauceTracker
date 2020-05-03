<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<?php include 'header.php'; ?>

		<?php 
			include 'session_details.php';
				
			if( !isset($_SESSION) )
				session_start();
			
			try{
				$conn = new PDO('mysql:host=' . $host . '; dbname=' . $db , $username, $password);
				if( $conn->connect_error)
					die( "Connection failed: " . $conn->connect_error);
				
				$_SESSION['conn'] = $conn;
				echo "Darn";
			}catch( Exception $e )
			{
				echo "<br> " . $e . "<br>";
			}
			echo " Pillows";
		?>
	</head>
	
	
	<body>
		<?php
			$url = $_POST['url'];
			echo $url;
				$command = escapeshellcmd('python3 scraper.py ' . $url);
				$mystring = shell_exec( $command );
				echo '<br>' . $mysting;

				$jsonobj = json_decode( $mystring, JSON_PRETTY_PRINT);

				setcookie('Name', $jsonobj['Name']);
				setcookie('Company', $jsonobj['Company']);
				setcookie('Stars', $jsonobj['Stars']);
				setcookie('Ingredients', $jsonobj['Ingredients']);
				setcookie('URL', $jsonobj['URL']);
				setcookie('ImgURL', $jsonobj['ImgURL']);
				setcookie('Cost', $jsonobj['Cost']);
				
			?> 

		<div class="viewer_table">
			<form action="saveSauce.php"  method="POST">
				<table  border = "1" class="viewing_table" >
					<td rowspan = '6' class="image_view">
						<img src = <?php echo $_COOKIE['ImgURL'];?> alt= "Not sauce" height="512" width = "340" >		
					</td>
					<tr>
						<td class="lenghten_name">Name:</td>
						<td class="view_lengthener" ><?php echo str_replace("_", " ", $_COOKIE['Name']); ?></td>
					</tr>
					<tr>
						<td class="lenghten_name">Company:</td>
						<td class="view_lengthener"><?php echo $_COOKIE['Company']; ?></td>
					</tr>
					<tr>
						<td class="lenghten_name">Cost:</td>
						<td class="view_lengthener"><?php echo $_COOKIE['Cost']; ?></td>
					</tr>
					<tr>
						<td class="lenghten_name">Stars:</td>
						<td class="view_lengthener"><?php echo $_COOKIE['Stars']; ?></td>
					</tr>
					<tr>
						<td class="lenghten_name">Ingredients:</td>
						<td class="view_lengthener_ing"><?php echo $_COOKIE['Ingredients']; ?></td>
					</tr>
				</table>
				<input class="add_sauce_button" name='butt' style="float:right" type = "submit" value ="Add to sauce-ionary!">
			</form>
		</div>
		 <script src="textScaler.js"></script> 
	</body>
	
		<script >
			
			function output( output )
			{
				document.getElementById("output").innerHTML = output;
			}
			function updateFont()
			{
				let text = document.getElementById("site_name");
				let width = window.innerWidth;
				if( width >= 1500 )
					text.style.fontSize = "80px";
				else if( width >=1350 && width < 1500 )
					text.style.fontSize = "64px";
				else if( width >=1200 && width < 1350 )
					text.style.fontSize = "55px";
				else if( width >=1050 && width < 1200 )
					text.style.fontSize = "46px";
				else if( width >=900 && width < 1050 )
					text.style.fontSize = "38px";
				else if( width >=750 && width < 900 )
					text.style.fontSize = "30px";
				else if( width >=600 && width < 750 )
					text.style.fontSize = "26px";
				else 
					text.style.fontSize = "22px";
				output( window.innerWidth );
			}
			output( window.innerWidth );
			updateFont();
		</script>
</html>
