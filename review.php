<html>
	<head>
		<?php include 'header.php'; ?>
		<?php 
			include 'session_details.php';
				
			if( !isset($_SESSION) )
				session_start();
			
			try{
				$conn = new PDO('mysql:host=127.0.0.1:3306; dbname=sauces', $username, $password);
				if( $conn->connect_error)
					die( "Connection failed: " . $conn->connect_error);
				
				$_SESSION['conn'] = $conn;
				echo "Darn";
			}catch( Exception $e )
			{
				echo "<br> " . $e . "<br>";
			}
			echo " Pillows<br>";
			
			function getUsersReviews($named)
			
			{
				
				#$sql = 'SELECT * FROM Reviews WHERE Sauce="' . $_COOKIE['Name'] . '" AND Reviewer="' . $named . '";';
				$sql = 'SELECT * FROM Reviews WHERE Sauce="Stargazer" AND Reviewer="' . $named . '";';

				#echo $sql . '<br>';

				$output =  $_SESSION['conn']->query($sql);
				$result = $output->fetch();
				#echo 'output from search: ' . $result . '<br>';
				#echo var_dump( $result ) . "<br>";
				if( !isset( $result['HeatLevel'] ))
					$result['HeatLevel'] = 1;
				if( !isset( $result['Stars'] ))
					$result['Stars'] = 1;
				if( !isset( $result['GoesWellWith'] ))
					$result['GoesWellWith'] = "";
				if( !isset( $result['Review'] ))
					$result['Review'] = "";
				return $result;
			}
			
			$brandonHolder = getUsersReviews('brandon');
			$jenniferHolder = getUsersReviews('jennifer');
			$violetHolder = getUsersReviews('violet');
			
			
			echo '<br>Brandon: ' . ( $brandonHolder['HeatLevel'] ) . '<br>';
			echo '<br>Jennifer: ' . ( $jenniferHolder['HeatLevel'] ) . '<br>';
			echo '<br>Violet: ' . ( $violetHolder ) . '<br>';
			echo '<br>Cokkie: ' . $_COOKIE['ImgURL'];
		?>

	</head>
	
	
	<body onresize="updateFont()" >
	<! TODO: bring in informatoin for sauce so i can use name&stuff !>
		<link rel="stylesheet" href="css/review.css">
		<div style="display:flex;">
			<div>
				<form action="saveSauce.php"  method="POST">
					<table  border = "1" >
						<td rowspan = '6' >
							<img src = <?php echo $_COOKIE['ImgURL'];?> alt= "Not sauce" height="512" width = "340" >		
						</td>
						<tr>
							<td id="output_name">Name:</td>
							<td style="width: 222px"><?php echo str_replace("_", " ", $_COOKIE['Name']); ?></td>
						</tr>
						<tr>
							<td>Company:</td>
							<td><?php echo $_COOKIE['Company']; ?></td>
						</tr>
						<tr>
							<td>Cost:</td>
							<td><?php echo $_COOKIE['Cost']; ?></td>
						</tr>
						<tr>
							<td>Stars:</td>
							<td><?php echo $_COOKIE['Stars']; ?></td>
						</tr>
						<tr>
							<td>Ingredients:</td>
							<td><?php echo $_COOKIE['Ingredients']; ?></td>
						</tr>
					</table>
				</form>
			</div>
-			<div>
				<form id="user_review_form" action="submitReviews.php" method="POST">
					<table class="review_table" style="border:none;">
						<tr class="review_row">
							<td id="output_name" >Name:</td>
							<td class="review_item" >
								<select id="reviewer_names" name="Name" onchange="changeReview()">
									<option value="brandon">Brandon</option>
									<option value="jennifer">Jennifer</option>
									<option value="violet">Violet</option>
								</select>
							</td>
						</tr>
						<tr class="review_row">
							<td>Heat Level:</td>
							<td class="review_item" >
								<select id="heat_scale" name="Heat">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>/10
							</td>
						</tr>
						<tr class="review_row">
							<td>Stars:</td>
							<td class="review_item" >
								<select id="stars" name="Stars">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>/5
							</td>						
						</tr>
						<tr class="review_row">
							<td>Tags:</td>
							<td class="review_item" ><input type="text" id="input_tags"></input></td>
						</tr>
						<tr class="review_row">
							<td>Current Tags:</td>
							<td><textarea id="tags_output" cols="100" row="1" name="Tags" readonly></textarea></td>
							<!-- <td><p id="tags_output" name="Tags"></p></td> -->
						</tr>
						<tr class="review_row">
							<td>Review</td>
							<td><textarea id="review" style="width: 100%;" rows="8" name="Review"></textarea></td>
						</tr>
					</table>
					<input class="submit_button" type='submit' value="Add review!" style="padding: 5px 5px;" ></input>
				</form>
			</div>
		</div>

			<script>
				console.log("Butts");
				let tags = document.getElementById("input_tags");
				tags.onkeypress = function(e){
					let key = e.charCode || e.keyCode || 0;
					if( key == 13)
					{
						e.preventDefault();
						let input = document.getElementById("input_tags");
						let output = document.getElementById("tags_output");
						if( output.value == "" )
							output.value += " " + input.value;
						else
							output.value += ", " + input.value;
					
						input.value = "";
					}
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
			}
			function changeReview()
			{
				console.log("Somehting");
				let curName = document.getElementById("reviewer_names");
				let heatScale = document.getElementById("heat_scale");
				let stars = document.getElementById("stars");
				let tags = document.getElementById("tags_output");
				let review = document.getElementById("review");

				switch( curName.value )
				{
					case "brandon":
						console.log("Brandon!");
						heatScale.value = <?php if( isset($brandonHolder["HeatLevel"]) ) echo $brandonHolder["HeatLevel"]; else echo 1; ?>;
						stars.value = <?php if( isset($brandonHolder["Stars"]) ) echo $brandonHolder["Stars"]; else echo 1; ?>;
						tags.innerHTML = <?php if( isset($brandonHolder['GoesWellWith'])) echo '"' . $brandonHolder["GoesWellWith"] . '"'; else echo ''; ?>;
						review.innerHTML = <?php if( isset($brandonHolder['Review'])) echo '"' . $brandonHolder["Review"] . '"'; else echo ''; ?>;
						break;
					case "jennifer":
						console.log("Jennifer!");
						heatScale.value = <?php if( isset($jenniferHolder["HeatLevel"]) ) echo $jenniferHolder["HeatLevel"]; else echo 1; ?>;
						stars.value = <?php if( isset($jenniferHolder["Stars"]) ) echo $jenniferHolder["Stars"]; else echo 1; ?>;
						tags.innerHTML = <?php if( isset($jenniferHolder['GoesWellWith'])) echo '"' . $jenniferHolder["GoesWellWith"] . '"'; else echo ''; ?>;
						review.innerHTML = <?php if( isset($jenniferHolder['Review'])) echo '"' . $jenniferHolder["Review"] . '"'; else echo ''; ?>;
						break;
					case "violet":
						console.log("Violet");
						heatScale.value = <?php if( isset($violetHolder["HeatLevel"]) ) echo $violetHolder["HeatLevel"]; else echo 1; ?>;
						stars.value = <?php if( isset($violetHolder["Stars"]) ) echo $violetHolder["Stars"]; else echo 1; ?>;
						tags.innerHTML = <?php if( isset($violetHolder['GoesWellWith'])){ echo '"' . $violetHolder["GoesWellWith"] . '"';} else {echo '';} ?>;
						review.innerHTML = <?php if( isset($violetHolder['Review'])) echo '"' . $violetHolder["Review"] . '"'; else echo ''; ?>;
						break;
					default:
						console.log("Who the fuck are you?");
				}
			}

			updateFont();
			changeReview();
				</script>
	</body>


</html>
