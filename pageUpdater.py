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
        print( name + ' already exists' )
    else:
        print("<br>Creating file")
        f = open( '/var/www/html/sauces/' + Name + '.php', 'w')


        b = '''<html>
        <head>
		<?php include '/var/www/html/header.php'; ?>
	</head>

	<body>
		<table  border = "1" size = 25>
			<td rowspan = '6'>
				<img src = " ''' + ImgURL + '''" alt= "Not sauce" height="256" width = "170" >		
			</td>
			<tr>
				<td>Name:</td>
				<td> " ''' + Name + '''" </td>
			</tr>
			<tr>
				<td>Company:</td>
				<td> " ''' + Company + '''" </td>
			</tr>
			<tr>
				<td>Cost:</td>
				<td> " ''' + Cost + '''" </td>
			</tr>
			<tr>
				<td>Stars:</td>
				<td> " ''' + Stars + '''" </td>
			</tr>
			<tr>
				<td>Ingredients:</td>
				<td> " ''' + Ingredients + '''" </td>
			</tr>
		</table>
		<a href="''' + URL + '''"><input type=button value='HOME'></a>
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
 
try:
    login = getInfo()
    connection = mysql.connector.connect( login['host'], login['user'], login['password'], login['db'] )

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
