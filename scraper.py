#!usr/bin/env python3
from bs4 import BeautifulSoup as bs
from requests import get
import json
import sys



#if debug == False:
url = sys.argv[1]
#else:
#url = "https://heatonist.com/collections/hot-ones-hot-sauces/products/hot-ones-brain-burner?variant=31274773545058"

#print("Success so far")
response = get(url)
html = bs(response.text, 'html.parser')

name = html.find("h1",class_= "product-details-product-title")
temp = name.getText().split(" | ")
name = temp[1]
company = temp[0]
cost = html.find("span", class_ = "money")
ingrediants = html.find("div", class_ = "product-description rte")
for i in range( 6 ):
    ingrediants = ingrediants.find_next("span")

stars = html.find("span", class_ = "spr-starrating spr-summary-starrating")
starCount = str( 5 - str( stars ).count("empty") ) + "/5"

imgURL = html.find("img", class_="product-single__photo wow fadeIn")['src']
imgURL = "http:" + imgURL[: imgURL.find(".jpg") + 4]
#wget.download( "http://" + imgURL, '/var/www/html/temp/temp.png')

#print( name.getText() )
#print( cost.getText() )
#print( ingrediants.getText() )
#print( starCount )

def getIngredients(soup):
    scripts = soup.find_all("script")
    cnt = 0
    for i in scripts:
        if "Ingredients" in i.text:
			#print( cnt )
            cnt = cnt + 1
        else:
            cnt = cnt + 1
			
    ingPos = scripts[38].text.find("Ingredients")
    newPos = scripts[38].text.find("strong", ingPos + 1)
    if abs(newPos - ingPos) <= 25:
        ingPos = newPos
			
    output = scripts[38].text[ingPos+6: scripts[38].text.find("/span", ingPos )]
	
    output2 = output.replace("\\", ' ').replace( "u003c", " ").replace( "u003e", " ").replace('/b', ' ').replace( 'span style= "font-weight: 400; "', " "  ).replace("ients:     ", ' ').replace( '/p   n  p', " ").replace( 'b    i  :    /i', ' ' ).replace('ients', ' ' ).replace('  span  ', '' ).replace("Size", '').replace("/strong", '').strip()
	
    optA = output2.find("span")
    optB = output2.find("strong")
    optC = output2.find("div")
    optD = output2.find(":")


#	if output2.find('"') < 10:
#		output3 = output2[ output2.find('"') +1: min( optA, optB) ]
#	else:
#		output3 = output2[ : min( optA, optB) ]
#	return output3.strip()

    if output2.find('"') < 10:
        output3 = output2[ output2.find('"') +1: min( optA, optB, optC, optD ) ].replace("strong", '')
        if output3.find(':') > 5:
            output3 = output3[:output3.find(':')]
    else:
        output3 = output2[ : min( optA, optB, optC, optD ) ].replace("strong", '')
        if output3.find(':') > 5:
            output3 = output3[:output3.find(':')]
    
    return output3.strip()
	
	
#def min( a,b ):
#	#print("\nA: " + str(a) + "\nB: " + str(b) + "\n")
 #   if a < b:
  #      return a
   # else:
    #    return b

data = {}
data["URL"] = str(url)
data["Name"] = name.replace(" ","_")
data["Company"] = company.replace(" ","_")
data["Cost"] = str(cost.getText())
data["Ingredients"] = getIngredients( html )
data["Stars"] = str(starCount)
data["ImgURL"] = imgURL

#if debug == True:
#    print( json.dumps( data, indent = 2 ) )
#else:
#    print( json.dumps( data ) )


print( json.dumps( data ) )

