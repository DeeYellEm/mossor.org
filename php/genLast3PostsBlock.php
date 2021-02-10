<?php

#echo "<p>PHP last3posts: Hello</p>";
# Step 1 : Open the file to be written to
$user = get_current_user();
if ($user == "darrinmossor")
{
  $filename = "/Users/darrinmossor/Sites/mossor.org/php/generated-last3PostsBlock.php";
} else {
  $filename = "/home/u202802032/domains/mossor.org/public_html/php/generated-last3PostsBlock.php";
}
$file = fopen( $filename, "w+" );

if( $file == false ) {
  echo ( "Error in opening new file: $filename" );
  exit();
}

# Step 2: This will use the Wordpress REST API to get information from the blog
# Note: The per_page=3 will just get us the last three, which is fine
$curl = curl_init();

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
	fwrite($file, "cURL Error #:" . $err);

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
fwrite($file, "    <div class=\"title\">\n");
fwrite($file, "      <h2>Recent Blog Posts</h2>\n");
fwrite($file, "    </div>\n");
fwrite($file, "    <div class=\"row justify-content-center\">\n");

# Step 4: Write the column info
foreach ($obj as $item) {
  // Pre-col
  fwrite($file, "      <div class=\"col\">\n");
  fwrite($file, "        <div class=\"card card-blog\">\n");

  $viewURL = $item->guid->rendered;
  $titleRendered = $item->title->rendered;
  $excerpt = $item->excerpt;

  $excerptRendered = chop($item->excerpt->rendered);
  $mediaURL = $item->jetpack_featured_media_url;
  //echo "viewURL: " . $viewURL . ", Title: " . $titleRendered . ", mediaURL: " . $mediaURL . ", Excerpt: " . $excerptRendered .  "<br>";

  // Column Code
  fwrite($file, "          <div class=\"card-image\" >\n");
  fwrite($file, "            <a href=\"javascript:;\">\n");
  fwrite($file, "              <img class=\"img\" src=\"" .$mediaURL. "\" alt=\"Blog Image\">\n");
  fwrite($file, "            </a>\n");
  fwrite($file, "          </div>\n");
  fwrite($file, "          <div class=\"card-body text-center\">\n");
  fwrite($file, "            <h4 class=\"card-title\">". $titleRendered . "</h4>\n");
  fwrite($file, "            <div class=\"card-description\">". $excerptRendered ."</div>\n");
  fwrite($file, "            <div class=\"card-footer\">\n");
  fwrite($file, "              <a href=\"" .$viewURL. "\" class=\"btn btn-danger btn-round\">View Article</a>\n");
  fwrite($file, "            </div>\n");

  // Post-col
  fwrite($file, "          </div>\n");
  fwrite($file, "        </div> <!-- end card -->\n");
  fwrite($file, "      </div> <!-- end col -->\n");

}
# Step 5: Write the postBlock and close
fwrite($file, " ");
fwrite($file, "   </div>\n");

# Step 6 : Close File
fclose($file);

?>

