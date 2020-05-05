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
			echo 'Sauce name: ' .$_COOKIE['Name'] . '<br>' ;
			echo 'Your name: ' . $_POST['Name'] . '<br>' ;
			echo 'Heat: ' . $_POST['Heat'] . '<br>' ;
			echo 'Stars: ' . $_POST['Stars'] . '<br>' ;
			echo 'Tags: ' . $_POST['Tags'] . '<br>' ;
			echo "Review: " . $_POST['Review'] . '<br>' ;
			

			$sqlInsert = 'INSERT INTO Reviews VALUES("' . $_COOKIE['Name'] . '", "' . $_POST['Name'] . '", "' . $_POST['Review'] . '", "' . $_POST["Heat"] . '", "' . $_POST['Tags'] . '", "' . $_POST['Stars'] . '")';
			$sqlDelete = 'DELETE FROM Reviews WHERE Reviewer = "' .  $_POST['Name'] . '" AND Sauce ="' . $_COOKIE['Name'] . '"' ;


			echo '<br>' . $sqlDelete . '<br>';
			echo '<br>' . $sqlInsert . '<br>';

			$_SESSION['conn']->exec($sqlDelete);
			$_SESSION['conn']->exec($sqlInsert);
		?>
	
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
