<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<div class="banner_container">
			<img src="banner.jpg" alt="Not sauce" style="width:100%">
			<div class="header_text">
				The Mauldin's Hot.net
			</div>
		</div>
		<div class="tab">
			<form method = "POST">
				<input class="tablinks" type="submit" name = "View" value="View">
				<input class="tablinks" type="submit" name = "Add" value="Add">
				<input class="tablinks" type="submit" name = "Share" value="Share">
				<input class="tablinks" type="submit" name = "Other" value="Other">
			</form>
		</div>
	</head>
	
	
	<body>
		<form action="saveSauce.php"  method="POST">
			<table class="parent_table"  border = "1" size = 25>
				<td rowspan = '6'>
					<img src = "sauce.jpg" alt= "Not sauce" height="256" width = "170" >		
				</td>
				<tr>
					<td>Name:</td>
					<td>Butt Hole Hair Singe-r</td>
				</tr>
				<tr>
					<td>Company:</td>
					<td>Yo Mama Productions</td>
				</tr>
				<tr>
					<td>Cost:</td>
					<td>$2*(arm & leg)</td>
				</tr>
				<tr>
					<td>Stars:</td>
					<td>7/5</td>
				</tr>
				<tr>
					<td>Ingredients:</td>
					<td class="last_element" >You don't want to know</td>
				</tr>
			</table>
			<input class="button" name='butt' style="float:right" type = "submit" value ="Add to sauce-ionary!">
		</form>
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
