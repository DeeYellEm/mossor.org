#! /usr/bin/python3

# This will get the last three blog posts and generate Blog cards for them

import requests, json, base64
import getpass
from datetime import datetime

# Static
ROOTDIR = "/var/www/html"
fileOut = ROOTDIR + "/Include/lastThreeBlogPosts.html"
logName = ROOTDIR + "/scripts/log.out"
logStatus = 0

# Go
preBlock = """
        <div class="title">
          <h2>Recent Blog Posts</h2>
        </div>
        <div class="row justify-content-center">
"""

postBlock = """
          
        </div>
"""

preCol = """
          <div class="col">
            <div class="card card-blog">
"""
postCol = """
              </div>
            </div> <!-- end card -->
          </div>
"""



# Step 1: This will use the Wordpress REST API to get information from the blog
# Note: The per_page=3 will just get us the last three, which is fine
url = "https://www.mossor.org/blog/wp-json/wp/v2/posts?per_page=3"
user = "darrin"
password = "Jiya C5id yqNh mo8K aS6s ZcYU"
credentials = user + ':' + password
token = base64.b64encode(credentials.encode())
header = {'Authorization': 'Basic ' + token.decode('utf-8')}
r = requests.get(url , headers=header)
#print(r.status_code)
#print(r.encoding)
#print(r.text)
#print(r. json())
#print(type(r.json()))

json_formatted_str = json.dumps(r.json(), indent=4, sort_keys=True)
#print("DEBUG ===\n")
#print(json_formatted_str)
#print("DEBUG ===\n")

json_object = json.loads(json_formatted_str)
#print (type(json_object))

# Step 2 : Open the file we're going to write out
fo = open(fileOut, "w")

# Step 3: Write the preBlock
fo.write(preBlock)

# Step 4: Write the column info

# Okay, now we're going to iterate through the json object, which is a list, and pluck out the info we need
for item in json_object:
    # Write out the preCol
    fo.write(preCol)

    #print (type(item))
    #print("id", ":", item["id"])
    #for key,value in item.items() :
    #    print (key, " : ", value)

    guid = item["guid"]
    viewURL = guid["rendered"]
    #print("viewURL: ", viewURL)
    link = item["link"]

    title = item["title"]
    titleRendered = title["rendered"].strip()
    #print("titleRendered: ", titleRendered)

    excerpt = item["excerpt"]
    excerptOriginal = excerpt["rendered"]
    excerptRendered = excerptOriginal.encode()
#    print("typeEncode: ", type(excerptRendered), excerptRendered)
    excerptRenderedStr = excerptRendered.decode()
#    print("typeDecode: ", type(excerptRenderedStr), excerptRenderedStr)

    mediaURL = item["jetpack_featured_media_url"]
    #print("mediaURL: ", mediaURL)

    fo.write("              <div class=\"card-image\" >\n")
    fo.write("                <a href=\"javascript:;\">\n")
#    fo.write("                  <img class=\"img\" src=\"" +mediaURL+ "\" style=\"width:300px;\">\n")
    fo.write("                  <img class=\"img\" src=\"" +mediaURL+ "\">\n")
    fo.write("                </a>\n")
    fo.write("              </div>\n")

    fo.write("              <div class=\"card-body text-center\">\n")
    fo.write("                <h4 class=\"card-title\">\n")
    fo.write("                  "+ titleRendered +"\n")
    fo.write("                </h4>\n")
    fo.write("                <div class=\"card-description\">\n")
    fo.write("                  "+ excerptRenderedStr +"\n")
    fo.write("                </div>\n")
    fo.write("                <div class=\"card-footer\">\n")
    fo.write("                  <a href=\"" +link+ "\" class=\"btn btn-danger btn-round\">View Article</a>\n")
    fo.write("                </div>\n")

    # Write postCol
    fo.write(postCol)


# Step 5: Write the postBlock and close
fo.write(postBlock)

fo.close

### Log some stuff from the run of the script
logUser = getpass.getuser()
logDateTime = str(datetime.now())
logScriptname = __file__
fLog = open(logName, "a")
fLog.write(logDateTime + ":" + logScriptname + ":" + logUser + ":" + str(logStatus) + "\n")
fLog.close
