<?php

//echo "<p>PHP COTD: Hello</p>";

// Step 1 : Get a random word
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://rapidapi.p.rapidapi.com/words/?random=true",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
	"x-rapidapi-host: wordsapiv1.p.rapidapi.com",
	"x-rapidapi-key: 45a82a25bemshffdcfa8c7ccfc68p1f399ajsn65386f375185"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	//echo "cURL Error #:" . $err;
  $word = "foo";
} else {
	//echo "Response: " . $response. "<br>";
  //$type = gettype($response);
  //echo "Type:". $type . "<br>";
  $obj = json_decode($response);
  $UCword = ucfirst($obj->{'word'});
  //echo "Word: ". $obj->{'word'} . ", UCword: " . $UCword . "<br>";
}

// Step 2 : Get a random color from a remote files
$fileRGB = explode("\n", file_get_contents("https://mossor.org/static/dlm-rgb.txt"));
$line = $fileRGB[array_rand($fileRGB)];
//echo "Random RBG Line: " . $line . "</br>";
list($rgbColorHexValue, $rgbR, $rgbG, $rgbB, $rgbColorName) = explode("|", $line);

//echo "RGB Hex: " . $rgbColorHexValue . ", R: " . $rgbR . ", G: " . $rgbG . ", B: " . $rgbB . ", Name: " . $rgbColorName . "<br>";

// Step 3 : Do the same for the resene color
$fileRGB = explode("\n", file_get_contents("https://mossor.org/static/dlm-resene.txt"));
$line = $fileRGB[array_rand($fileRGB)];
//echo "Random Resene Line: " . $line . "</br>";
list($reseneColorHexValue, $reseneColorName) = explode("|", $line);

//echo "Resene Hex: " . $reseneColorHexValue . ", Resene Name: " . $reseneColorName . "<br>";

# Step 4 : Generate the random/nonsense value
$randValR = rand(0, 255);
$randValG = rand(0, 255);
$randValB = rand(0, 255);

// Debug Test : $randValR = 0; $randValG = 10; $randValB = 255;
# Convert to Hex with leading 0 if needed

$randValRHex = sprintf("%02x", $randValR);
$randValGHex = sprintf("%02x", $randValG);
$randValBHex = sprintf("%02x", $randValB);

//echo "randValRHex: " . $randValR . ", randValRHex: " . $randValRHex . "<br>";
//echo "randValGHex: " . $randValG . ", randValGHex: " . $randValGHex . "<br>";
//echo "randValBHex: " . $randValB . ", randValBHex: " . $randValBHex . "<br>";
//echo "randColorHex: ". $randColorHex . "\n";
$randColorHexValue = "#".$randValRHex.$randValGHex.$randValBHex;
$randColorName = $UCword;

# Step 5 : Generate some HTML to be included in an existing page

// Pre-Block
echo "<div class=\"title\">";
echo "  <h2>Random Colors of the Day</h2>";
echo "</div>";
echo "<p style=\"color:black; font-size:140%;\">";
echo "  Find some inspiration to brighten your colorspace!  The three options below are based on trying to assign names to colors as they are represented on a computer screen, typically via a hex value like this: \"#546789\".  Each pair represents the strength of the Red, Green and Blue value.  Back in the day, the X11 Consortium declared that colors would be stored in a file called \"rgb.txt\" and many had names associated with them.  Additionally, I found a list of colors and names based on Resene colors.  The third one is what happens if you pick a random value and call it a random name.  Very useful and highly scientific.";
echo "</p>";
echo "<div class=\"row justify-content-center\">";

// Pre-col
echo "<div class=\"col\">";
echo "  <div class=\"card card-profile\">";

echo "    <div class=\"card-cover\" style=\"background-color: " . $rgbColorHexValue . "\"></div>\n";
echo "      <div class=\"card-body\">\n";
echo "        <h4 class=\"card-title\">" . $rgbColorName . "</h4>\n";
echo "        <h6 class=\"card-category\">" . $rgbColorHexValue . "</h6>\n";
echo "        <p class=\"card-description\">From the classic X11 file rgb.txt </p>\n";
// Post-col
echo "     </div>";
echo "  </div>";
echo "</div> <!-- end card -->";

// Pre-col
echo "<div class=\"col\">";
echo "  <div class=\"card card-profile\">";

echo "    <div class=\"card-cover\" style=\"background-color: " . $reseneColorHexValue . "\"></div>\n";
echo "      <div class=\"card-body\">\n";
echo "        <h4 class=\"card-title\">" . $reseneColorName . "</h4>\n";
echo "        <h6 class=\"card-category\">" . $reseneColorHexValue . "</h6>\n";
echo "        <p class=\"card-description\">From the set of Resene colors. </p>\n";
// Post-col
echo "     </div>";
echo "  </div>";
echo "</div> <!-- end card -->";
// Pre-col
echo "<div class=\"col\">";
echo "  <div class=\"card card-profile\">";

echo "    <div class=\"card-cover\" style=\"background-color: " . $randColorHexValue . "\"></div>\n";
echo "      <div class=\"card-body\">\n";
echo "        <h4 class=\"card-title\">" . $randColorName . "</h4>\n";
echo "        <h6 class=\"card-category\">" . $randColorHexValue . "</h6>\n";
echo "        <p class=\"card-description\">A unique color and name, created just for you! </p>\n";
// Post-col
echo "     </div>";
echo "  </div>";
echo "</div> <!-- end card -->";

// Post-Block
echo "</div>";
?>
