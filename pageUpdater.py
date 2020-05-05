import mysql.connector
from mysql.connector import Error
#import mysql
#import pymysql
#import MyQWLdb
import json
import sys
import os

debug = False

def fileCreator( Name, Company, Cost, Stars, Ingredients, ImgURL, URL ):
    if os.path.exists( 'sauces/' + Name + '.php'):
        print( Name + ' already exists' )
        return
    else:
        print("<br>Creating file")
        f = open( '/var/www/html/sauces/' + Name + '.php', 'w')


        b = '''<?php 

			include 'fetchReview.php';

			$name = "''' + Name + '''";
			$company = "''' + Company + '''";
			$cost = "''' + Cost + '''";
			$stars = "''' + Stars + '''";
			$ingredients = "''' + Ingredients + '''";
			$url = "''' + URL + '''";
			$imgurl = "''' + ImgURL + '''";

			setCookie('SauceName', $name, time() + ( 60 * 60 * 24 * 365 * 1000), '/');
			setCookie('Company', $company, time() + ( 60 * 60 * 24 * 365 * 1000), '/');
			setCookie('Cost', $cost, time() + ( 60 * 60 * 24 * 365 * 1000), '/');
			setCookie('Stars', $stars, time() + ( 60 * 60 * 24 * 365 * 1000), '/');
			setCookie('Ingredients', $ingredients, time() + ( 60 * 60 * 24 * 365 * 1000), '/');
			setCookie('URL', $url, time() + ( 60 * 60 * 24 * 365 * 1000), '/');
			setCookie('ImgURL', $imgurl, time() + ( 60 * 60 * 24 * 365 * 1000), '/');
		?>
<html>
        <head>
		<?php include '/var/www/html/header.php'; ?>
	</head>

	<body><body onresize="updateFont()" onkeypress="handleEnter(event)">

		<link rel="stylesheet" href="css/review.css">
		<div style="display:flex;">
			<div>
				<form action="saveSauce.php"  method="POST">
					<table  border = "1" size = 25>
			<td rowspan = '6'>
				<img src =<?php echo '"' . $imgurl . '"'; ?> alt= "Not sauce" height="256" width = "170" >		
			</td>
			<tr>
				<td>Name:</td>
				<td><?php echo $name; ?></td>
			</tr>
			<tr>
				<td>Company:</td>
				<td><?php echo $company; ?></td>
			</tr>
			<tr>
				<td>Cost:</td>
				<td><?php echo $cost; ?></td>
			</tr>
			<tr>
				<td>Stars:</td>
				<td><?php echo $stars; ?></td>
			</tr>
			<tr>
				<td>Ingredients:</td>
				<td><?php echo $ingredients; ?></td>
			</tr>
		</table>
				</form>
			</div>
			<div>
				<select id="name_selector" name="Name" onchange="loadReviews()" >
					<option value="none"></option>
					<option value="brandon">Brandon</option>
					<option value="jennifer">Jennifer</option>
					<option value="violet">Violet</option>
					</select>
			</div>
		<div>
		<a href=<?php echo '"' . $url . '"'; ?>><input type=button value='Shop for this sauce!'></a>

		<div>
			<form action="/review.php">
				<table>
					<tr>
						<td>Heat:</td>
						<td id="heat_output"> 23123 </td>
					</tr>
					<tr>
						<td>Stars:</td>
						<td id="stars_output"> ***** </td>
					</tr>
					<tr>
						<td>Goes great with:</td>
						<td id="tags_output">Yo mama</td>
					</tr>
					<tr>
						<td>Personal Review:</td>
						<td id="review_output">Smells like pickles.</td>
					</tr>
				</table>
				<input type="submit" value="Add a review!"></input>
			</form>
		</div>

			<script >

			function loadReviews()
			{
				let heat = document.getElementById("heat_output");
				let stars = document.getElementById("stars_output");
				let tags = document.getElementById("tags_output");
				let review = document.getElementById("review_output");

				switch( document.getElementById("name_selector").value )
				{
					case "brandon":
						console.log("Brandon!");
						heat.innerHTML = <?php echo '"' . generateReviews('brandon', $name)["HeatLevel"] . '"'; ?> ;
						stars.innerHTML = <?php echo '"' . generateReviews('brandon', $name)["Stars"] . '"'; ?> ;
						tags.innerHTML = <?php echo '"' . generateReviews('brandon', $name)["GoesWellWith"] . '"'; ?> ;
						review.innerHTML = <?php echo '"' . generateReviews('brandon', $name)["Review"] . '"'; ?> ;
						break;
					case "jennifer":
						console.log("Jennifer!");
						heat.innerHTML = <?php echo '"' . generateReviews('jennifer', $name)["HeatLevel"] . '"'; ?> ;
						stars.innerHTML = <?php echo '"' . generateReviews('jennifer', $name)["Stars"] . '"'; ?> ;
						tags.innerHTML = <?php echo '"' . generateReviews('jennifer', $name)["GoesWellWith"] . '"'; ?> ;
						review.innerHTML = <?php echo '"' . generateReviews('jennifer', $name)["Review"] . '"'; ?> ;
						break;
					case "violet":
						console.log("Violet!");
						heat.innerHTML = <?php echo '"' . generateReviews('violet', $name)["HeatLevel"] . '"'; ?> ;
						stars.innerHTML = <?php echo '"' . generateReviews('violet', $name)["Stars"] . '"'; ?> ;
						tags.innerHTML = <?php echo '"' . generateReviews('violet', $name)["GoesWellWith"] . '"'; ?> ;
						review.innerHTML = <?php echo '"' . generateReviews('violet', $name)["Review"] . '"'; ?> ;
						break;
					default:
						console.log("Who the fuck are you?");
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
			updateFont();
		</script>
	</body>
</html>'''

        print( "Prepairing file" )
        f.write( b )
        print("File created for sauce.")
        f.close()


def getInfo():

	loginInfo = {}

	file = open("session_details.php", "r")
	lines = file.readlines()
	
	
	
	for line in lines:
		if '$host' in line:
			loginInfo["host"] = line[10:-3]
		if '$db' in line:
			loginInfo["db"] = line[8: -3]
		if '$username' in line:
			loginInfo["username"] = line[14: -3]
		if '$password' in line:
			loginInfo["password"] = line[14: -3]
			
	if debug:
		print( "[" + loginInfo['password'] + ']' )
		
	return loginInfo
 
try:
	login = getInfo()
	connection = mysql.connector.connect( host='127.0.0.1', user=login['username'], password=login['password'], db=login['db'] )
	cur = connection.cursor()
	cur.execute("SELECT * FROM sauces")

	rows = cur.fetchall()
	   #db_info = connection.get_server_info()
	#print( "Connected to MySQL server version ", db_info )
	#cursor = connection.cursor()
	#cursor.execute("select database();")
	#record = cursor.fetchone()
	#print("You're connected to database: ", record )

	#cursor.execute("SELECT * FROM sauces")
	#result = cursor.fetchall()

	for sauce in rows:
	#        print( sauce[0] )
	#        print( sauce[1] )
	#        print( sauce[2] )
	#        print( sauce[3] )
	#        print( sauce[4] )
	#        print( sauce[5] )
	#        print( sauce[6] )
		fileCreator( sauce[0], sauce[1], sauce[2], sauce[4], sauce[3], sauce[6], sauce[5] )
        

except Error as e:
    print("Error while connectiong to MySQL", e)
finally:
    cur.close()
    connection.close()
