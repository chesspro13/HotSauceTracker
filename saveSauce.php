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
		$sql = 'INSERT INTO sauces VALUES("' . $_COOKIE['Name'] . '", "' . $_COOKIE['Company'] . '", "' . $_COOKIE['Cost'] . '", "' . $_COOKIE['Ingredients'] . '", "' . $_COOKIE['Stars'] . '", "' . $_COOKIE['URL'] . '", "' . $_COOKIE['ImgURL'] . '")';
		echo $sql;
				$getSql = 'SELECT * FROM sauces WHERE Name = "' . $_COOKIE['Name'] . '"';
			try{
					$cnt = $_SESSION['conn']->prepare( $getSql );
					$cnt->execute();
					$result = $cnt->setFetchMode(PDO::FETCH_ASSOC);
					$result = $cnt->fetchAll();

					$runResult = shell_exec( 'python3 pageUpdater.py'  );
					echo 'Result of pageUpdater call: ' . $runResult;
					
					if( sizeof($result) > 0  )
						echo '<h3>' . $_COOKIE['Name'] . " is already in database.</h3>";
					else
					{
						echo "Thing?: " . $_SESSION['conn']->exec($sql);
						echo '<h3>' . $_COOKIE['Name'] . ' Saved!<h3>';
					#	$arr = array('Name' => $_COOKIE['Name'], 'Company' => $_COOKIE['Company'], 'Cost' => $_COOKIE['Cost'], 'Stars' => $_COOKIE['Stars'], 'Ingredients' => $_COOKIE['Ingredients'], 'URL' => $_COOKIE['URL'], 'ImgURL' => $_COOKIE['ImgURL']);
					#	$jsonobj = json_encode( $arr );
					}

				}catch( Exception $e)
				{
				}

			?> 
			
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
	</body>
</html>
