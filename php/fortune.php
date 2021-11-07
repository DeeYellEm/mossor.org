<?php

//echo "<p>PHP COTD: Hello</p>";

// Step 1 : Get a random fortune
// Step 1 : Get a random word
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.justyy.workers.dev/api/fortune",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET"
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	//echo "cURL Error #:" . $err;
  $fortune = "This is not a fortune.";
} else {
  $fortune = json_decode($response);
}
#echo "Fortune: [". $fortune ."]\n";

# Step 5 : Generate some HTML to be included in an existing page

// Pre-Block
#echo "<div class=\"title\">\n";
#echo "          <h2>Fortune</h2>\n";
#echo "        </div>\n";
#echo "        <p style=\"color:black; font-size:140%;\">\n";
#echo "Once upon a time, in the Before Times (call it the 1990s), software engineers would add to an otherwise boring login by displaying additional things like time, date or weather.  One such way was to display a random fortune.  Some are movie quotes, some are literary quotes and some are just fortunes.  This bit of code accesses an online API to generate a fortune and display it.\n";
#echo "        </p>\n";
#echo "        <p style=\"color:black; font-size:100%;\">Credit to <a href=\"https://helloacm.com/fortune/\">HelloACM</a>, which provides and hosts the API for this and many other cool things.</p>\n";
#echo "        <div class=\"row justify-content-center\">\n";
#echo "          <form class=\"form-inline\" role=\"search\" action=\"\" method=\"GET\">\n";
#echo "            <fieldset>\n";
#echo "              <legend><label for=\"url\">Random Adage</label></legend>\n";
#echo "                <pre>". $fortune . "</pre>\n";
#echo "                <div class=\"mb-3\">\n";
#echo "                  <input class=\"form-control\" type=\"submit\" value=\"Get Random Adage\">\n";
#echo "                </div>";
#echo "            </fieldset>\n";
#echo "          </form>\n";

// Pre-Block
echo "<div class=\"title\">\n";
echo "          <h2>Fortune</h2>\n";
echo "        </div>\n";
echo "        <div class=\"row justify-content-center\">\n";

echo "          <form class=\"form-inline\" role=\"search\" action=\"\" method=\"GET\">\n";
echo "            <fieldset>\n";
echo "              <legend><label for=\"url\">Random Adage</label></legend>\n";
echo "              <pre>". $fortune . "</pre>\n";
echo "              <div class=\"col text-center\">";
echo "                <button type=\"submit\" class=\"btn btn-primary\">Get Random Adage</button>\n";
echo "              </div>";
echo "            </fieldset>\n";
echo "          </form>\n";

// Post-Block
echo "        </div>\n";
echo "        <p style=\"color:black; font-size:140%;\">\n";
echo "Once upon a time, in the Before Times (call it the 1990s), software engineers would add to an otherwise boring login by displaying additional things like time, date or weather.  Another was to display a random fortune.  Some are movie quotes, some are literary quotes and some are just fortunes.  Some are profane and some are a little profound.  This bit of code accesses an online API to generate a fortune and display it.\n";
echo "        </p>\n";
echo "        <p style=\"color:black; font-size:100%;\">Credit to <a href=\"https://helloacm.com/fortune/\">HelloACM</a>, which provides and hosts the API for this and many other cool things.</p>\n";


?>
