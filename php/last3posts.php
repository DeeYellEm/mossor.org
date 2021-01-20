<?php

//echo "<p>PHP last3posts: Hello</p>";
// Step 1 : Get a random word
$curl = curl_init();

# Step 1: This will use the Wordpress REST API to get information from the blog
# Note: The per_page=3 will just get us the last three, which is fine
curl_setopt_array($curl, [
  CURLOPT_URL => "https://www.mossor.org/blog/wp-json/wp/v2/posts?per_page=3",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;

} else {
	//echo "Response: " . $response. "<br>";
  //$type = gettype($response);
  //echo "Type: ". $type . "<br>";
  $obj = json_decode($response);
  //echo "Object: " .$obj. "<br>";


  //echo "viewURL: " . $viewURL . ", Title: " . $titleRendered . ", Excerpt: " . $excerptRendered . ", mediaURL: " . $mediaURL . "<br>";

  //echo "GUID: " . $obj[0]->guid . ", Title: " . $obj[0]->title . ", Excerpt: " . $obj[0]->excerpt . "<br>\\\\\\\\\\\\\\<br>";
  //var_dump($obj[1]->excerpt);

}

# Step 3: Write the preBlock
echo "    <div class=\"title\">";
echo "      <h2>Recent Blog Posts</h2>";
echo "    </div>";
echo "    <div class=\"row justify-content-center\">";

# Step 4: Write the column info
foreach ($obj as $item) {
  // Pre-col
  echo "  <div class=\"col\">\n";
  echo "    <div class=\"card card-blog\">\n";

  $viewURL = $item->guid->rendered;
  $titleRendered = $item->title->rendered;
  $excerpt = $item->excerpt;

  $excerptRendered = $item->excerpt->rendered;
  $mediaURL = $item->jetpack_featured_media_url;
  //echo "viewURL: " . $viewURL . ", Title: " . $titleRendered . ", mediaURL: " . $mediaURL . ", Excerpt: " . $excerptRendered .  "<br>";

  // Column Code
  echo "                      <div class=\"card-image\" >\n";
  echo "                        <a href=\"javascript:;\">\n";
  echo "                          <img class=\"img\" src=\"" .$mediaURL. "\">\n";
  echo "                        </a>\n";
  echo "                      </div>\n";
  echo "                      <div class=\"card-body text-center\">\n";
  echo "                        <h4 class=\"card-title\">\n";
  echo "                          ". $titleRendered ."\n";
  echo "                        </h4>\n";
  echo "                        <div class=\"card-description\">\n";
  echo "                          ". $excerptRendered ."\n";
  echo "                        </div>\n";
  echo "                        <div class=\"card-footer\">\n";
  echo "                          <a href=\"" .$viewURL. "\" class=\"btn btn-danger btn-round\">View Article</a>\n";
  echo "                        </div>\n";

  // Post-col
  echo "      </div>\n";
  echo "    </div> <!-- end card -->\n";
  echo "  </div>\n";

}
# Step 5: Write the postBlock and close
echo " ";
echo "  </div>\n";

?>
