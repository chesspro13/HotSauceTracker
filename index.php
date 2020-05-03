<html>
	<head>
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
	
	
	<body onresize="updateFont()">
		<p id="output"> Script not running </p>
		<?php

		 $_COOKIE["width"];			
				if( isset($_POST['View'] ) || (!isset($_POST['View']) && !isset($_POST['Add']) && !isset($_POST['Share']) && !isset($_POST['Other']) ) )
				{
					try{
						$query = "SELECT * FROM sauces";
						$result = $_SESSION['conn']->query( $query );
						$data = $_SESSION['conn']->query($query)->fetchAll();

						
						$result = $_SESSION['conn']->query( "SELECT COUNT(*) FROM sauces");

						$count = $result->fetchColumn();
						echo '<br>There are ' . $count . ' items in the database.<br>';
						$_COOKIE[ 'rowCount' ] = strval($count);

						echo '<div class="sauces" >';
						foreach( $data as $row )
						{
							echo '<a href="sauces/' . $row['Name'] . '.php">';
							echo '<div class="sauce_element" ><table><tr><td rowspan="2"><img src="' . $row["ImgURL"] . '" width="85" height="128" alt="Not sauce"></td><td>' . str_replace( '_', ' ', $row['Name'] ) . '</td></tr><tr><td>' . str_replace( '_', ' ', $row["Company"] ) . '</td></tr></table></div>';
							echo '</a>';
							#echo '<div><table><tr><td rowspan="2"><img src="' . 'sauce.jpg' . '" width="85" height="128" alt="Not sauce></td><td>' . $row['Name'] . '</td></tr><tr><td>' . $row["Company"] . '</td></tr></table></div>';
							
							#$table += '<div><table class="sauce_table"><tbody><tr><td rowspan="2"><img src="' + row['ImgURL'] + '" width ="85" height="128" alt="Not sauce"></td><td>' + row['Name'] + '</td></tr><tr><td> ' + row['Company'] + ' </td></tr></tbody> </table></div>';

						}
						echo '</div>';
						#echo $table;
						#echo json_encode( $arry );
						#$output  = str_replace('"', '\"', substr($arry, 0, -4));
						#$_COOKIE['sauceJson'] = 
						#$_SESSION['sauceJson'] = $output;
						#echo $_SESSION['sauce1'];
					}catch( Exception $e )
					{
						echo "<h1> " . $e . " </h1>";
					}
				}
				else if( isset( $_POST['Add'] ))
				{
					echo "<h2> Get Saucey </h2>";
					echo '<div class="add_div"><form action="addResult.php" method="POST" accept-charset="UTF-8">';
						echo '<table class="add_table"><tbody><tr><td>Product Page</td><td><input name="url" type="text" value=""/></td></tr></tbody></table><input type="submit" value="Submit Hotness!"/> </form></div>';
				}
				else if( isset( $_POST['Share'] ))
					echo "Sharing";
				else if( isset( $_POST['Other'] ))
					echo "Othering";
		?>
		
		<div id="tbl">
		</div>
		
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
</htm
