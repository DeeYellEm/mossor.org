#!/usr/bin/python3

import http.client
import json 
import random
import getpass
from datetime import datetime

# Static
ROOTDIR = "/var/www/html"
rgbFileInput = ROOTDIR + "/static/dlm-rgb.txt"
reseneFileInput = ROOTDIR + "/static/dlm-resene.txt"
fileOut = ROOTDIR + "/Include/COTD.html"
logName = ROOTDIR + "/scripts/log.out"
logStatus = 0

# Generate the Random Color of the Day code to include on another page.

# Step 1 : Get a word for the made up color
conn = http.client.HTTPSConnection("wordsapiv1.p.rapidapi.com")

headers = {
    'x-rapidapi-host': "wordsapiv1.p.rapidapi.com",
    'x-rapidapi-key': "45a82a25bemshffdcfa8c7ccfc68p1f399ajsn65386f375185"
    }

conn.request("GET", "/words/?random=true", headers=headers)

res = conn.getresponse()
data = res.read()
dataString = data.decode("utf-8", "backslashreplace")

#print (dataList["word"])
#print (type(data))

dictData = json.loads(dataString)
randWord = dictData["word"].capitalize()
#print ("Random word is : " + randWord + ".")

# Step 2 : Get text from rgb.txt, pick a random line/value
# Open a file
fi = open(rgbFileInput, "r")

allLines = fi.readlines()
pickLine = random.choice(allLines)
lineValues = pickLine.split("|")
rgbColorHexValue = lineValues[0]
rgbColorName = lineValues[4].rstrip().capitalize()

fi.close()

#print("Debug: RGB is " + rgbColorName + " : " + rgbColorHexValue + ".")

# Step 3 : Do the same for the resene color
fi = open(reseneFileInput, "r")

allLines = fi.readlines()
pickLine = random.choice(allLines)
lineValues = pickLine.split("|")
reseneColorHexValue = lineValues[0]
reseneColorName = lineValues[1].rstrip().capitalize()

fi.close()

#print("Debug: Resene is " + reseneColorName + " : " + reseneColorHexValue + ".")

# Step 4 : Generate the random/nonsense value
randValR = random.randint(0, 255)
randValG = random.randint(0, 255)
randValB = random.randint(0, 255)

# Convert to Hex with leading 0 if needed
randValRHex = '{0:02x}'.format(randValR)
randValGHex = '{0:02x}'.format(randValG)
randValBHex = '{0:02x}'.format(randValB)

#print ("randValR: " + str(randValR) + "randValRHex: " + randValRHex)
#print ("randValG: " + str(randValG) + "randValGHex: " + randValGHex)
#print ("randValB: " + str(randValB) + "randValBHex: " + randValBHex)

randColorHexValue = "#"+randValRHex+randValGHex+randValBHex

randColorName = randWord

#print ("Debug: Random is " + randColorName + " : " + randColorHexValue + ".")

# Step 5 : Generate some HTML to be included in an existing page

fo = open(fileOut, "w")
preBlock = """
        <div class="title">
          <h2>Random Colors of the Day</h2>
        </div>
        <p style="color:black; font-size:140%;">
          Find some inspiration to brighten your colorspace!  The three options below are based on trying to assign names to colors as they are represented on a computer screen, typically via a hex value like this: "#546789".  Each pair represents the strength of the Red, Green and Blue value.  Back in the day, the X11 Consortium declared that colors would be stored in a file called "rgb.txt" and many had names associated with them.  Additionally, I found a list of colors and names based on Resene colors.  The third one is what happens if you pick a random value and call it a random name.  Very useful and highly scientific.
        </p>
        <div class="row justify-content-center">
"""

postBlock = """
          
        </div>
"""

preCol = """
          <div class="col">
            <div class="card card-profile">
"""
postCol = """
              </div>
            </div> <!-- end card -->
          </div>
"""

fo.write(preBlock)
fo.write(preCol)
fo.write("              <div class=\"card-cover\" style=\"background-color: " + rgbColorHexValue + "\"></div>\n")
fo.write("              <div class=\"card-body\">\n")
fo.write("                <h4 class=\"card-title\">" + rgbColorName + "</h4>\n")
fo.write("                <h6 class=\"card-category\">" + rgbColorHexValue + "</h6>\n")
fo.write("                <p class=\"card-description\">From the classic X11 file rgb.txt </p>\n")
fo.write(postCol)
fo.write(preCol)
fo.write("              <div class=\"card-cover\" style=\"background-color: " + reseneColorHexValue + "\"></div>\n")
fo.write("              <div class=\"card-body\">\n")
fo.write("                <h4 class=\"card-title\">" + reseneColorName + "</h4>\n")
fo.write("                <h6 class=\"card-category\">" + reseneColorHexValue + "</h6>\n")
fo.write("                <p class=\"card-description\">From the resene series of colors/names.</p>\n")
fo.write(postCol)
fo.write(preCol)
fo.write("              <div class=\"card-cover\" style=\"background-color: " + randColorHexValue + "\"></div>\n")
fo.write("              <div class=\"card-body\">\n")
fo.write("                <h4 class=\"card-title\">" + randColorName + "</h4>\n")
fo.write("                <h6 class=\"card-category\">" + randColorHexValue + "</h6>\n")
fo.write("                <p class=\"card-description\">Complete random name for this completely random color!</p>\n")
fo.write(postCol)
fo.write(postBlock)

fo.close

### Log some stuff from the run of the script
logUser = getpass.getuser()
logDateTime = str(datetime.now())
logScriptname = __file__
fLog = open(logName, "a")
fLog.write(logDateTime + ":" + logScriptname + ":" + logUser + ": [" + randWord + "] :" + str(logStatus) + "\n")
fLog.close
