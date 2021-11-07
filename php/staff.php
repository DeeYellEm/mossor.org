<?php

$debug = 0;

if ($debug) {echo "DEBUG: PHP Staff: Hello\n";};

$numCards = 4;

#Mock Data
$people = array(0 => array("url" => "https://www.mossor.org", "gender" => "female", "background" => "https://www.mossor.org", "name" => "Jane Doe", "hometown" => "ABC, NY", "quote" => "This is not a quote", "author" => "John Doe", "role" => "Thinker"),
                1 => array("url" => "https://www.mossor.org", "gender" => "female", "background" => "https://www.mossor.org", "name" => "Sue Doe", "hometown" => "DEF, NY", "quote" => "This is not a quote", "author" => "John Doe", "role" => "Doer"),
                2 => array("url" => "https://www.mossor.org", "gender" => "female", "background" => "https://www.mossor.org", "name" => "Stacy Doe", "hometown" => "GHI, NY", "quote" => "This is not a quote", "author" => "John Doe", "role" => "Watcher"),
                3 => array("url" => "https://www.mossor.org", "gender" => "female", "background" => "https://www.mossor.org", "name" => "Sandra Doe", "hometown" => "JKL, NY", "quote" => "This is not a quote", "author" => "John Doe", "role" => "Maker"),
                4 => array("url" => "https://www.mossor.org", "gender" => "female", "background" => "https://www.mossor.org", "name" => "Barbara Doe", "hometown" => "MNO, NY", "quote" => "This is not a quote", "author" => "John Doe", "role" => "Runner"));

#echo "===\n";
#var_dump($people);
#echo "===\n";

# DEBUG
$enable_1 = 1; # Faces & Gender
$enable_2 = 1; # Backgrounds
$enable_3 = 1; # Identities
$enable_4 = 1; # Quotes
$enable_5 = 1; # Roles
$enable_6 = 1; # Gen HTML

// Step 1 : Get $numCards random faces
if ($debug) {echo "Step 1: Random Faces.\n";};

if ($enable_1) {

  $genderList = array("Female", "Male");
  $femFile = "static/StaffSpotlight/StaffSpotlight-Female-List.txt";
  $maleFile = "static/StaffSpotlight/StaffSpotlight-Male-List.txt";
  $count = 0;

  while ($count < $numCards) {
    # Pick a gender - used for generating name below
    $gender = array_rand($genderList);
    $people[$count]['gender'] = $gender;
    # Pick a headshot from the appropriate list
    if ($gender == "Female") {
      $file = $femFile;        
      $picDir = "static/StaffSpotlight/Female/";
      if (file_exists($file)) {
        $f_contents = file($file); 
        $url = $f_contents[rand(0, count($f_contents) - 1)];
        $url = rtrim($url, " \n\r\t\v\0");
        $people[$count]['url'] = $picDir.$url;
      } else {
        $cwd = getcwd();
        echo "ERROR: File not found [" .$cwd.$file."].\n";
      }

    } else {
      $file = $maleFile;        
      $picDir = "static/StaffSpotlight/Male/";
      if (file_exists($file)) {
        $f_contents = file($file); 
        $url = $f_contents[rand(0, count($f_contents) - 1)];
        $url = rtrim($url, " \n\r\t\v\0");
        $people[$count]['url'] = $picDir.$url;
      } else {
        $cwd = getcwd();
        echo "ERROR: File not found [" .$cwd."/".$file."].\n";
      }

    }

    $count++;
  }

}

// Step 2 : Get $numCards random backgrounds
if ($debug) {echo "Step 2: Backgrounds.\n";};

if ($enable_2) {

  // Generate a random page in the first 10 - Note page=0 is bad.
  $randomPage = rand(1,10);
  // Generate a list of random pics - effectively 0-19 randomized
  // List numbers 1 to 20
  $picList = range(0,19);
  // Shuffle numbers
  shuffle($picList);

  $curl = curl_init();
  
  $pixabay_url = "https://pixabay.com/api/?key=18841169-1f29b08e7049dcf74a6b65a71&image_type=\"photo\"&safesearch=\"true\"&orientation=\"landscape\"&category=\"places\"&page=$randomPage";
  #echo "Pixabay URL: [".$pixabay_url."]\n";
  curl_setopt_array($curl, [
    CURLOPT_URL => "$pixabay_url",
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
    echo "cURL Error #:" . $err. ".\n";
  } else {
    #echo "Response: " . $response. "<br>";
    #$type = gettype($response);
    #echo "Type:". $type . "<br>";

    $obj = json_decode($response, true);
    if (is_null($obj)) { 
       echo "ERROR: OBJ is null from pixabay\n";
       echo "URL: [". $pixabay_url . "]\n";
       echo "Response: [".$response."]\n";
    };

    #echo "===\n";
    #print_r($obj);
    #echo "===\n";
    
    $count = 0;
    while ($count < $numCards) {
        $picNum = $picList[$count];

        $people[$count]['background'] = $obj['hits'][$picNum]['webformatURL'];
        
        $count++;
    }

  }
}


// Step 3 : Get $numCards random Identities
if ($debug) {echo "Step 3: Get Random Identities\n";};

if ($enable_3) {
  $count = 0;
  while ($count < $numCards) {
    $gender = 2;
    if ($people[$count]['gender'] == "female") {
       $gender = 1;
    }

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://helloacm.com/api/rig/?c=1&g=$gender",
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
        $identity = "Jane Doe\n1122 Boogie Boogie Ave.\nKenosha, WI 53141\n(262) xxx-xxxx";
    } else {
        $identity = json_decode($response);
    }
    #echo "Identity: [". $identity ."]\n";
    $parts = explode("\n", $identity);
    $people[$count]['name'] = $parts[0];
    $people[$count]['hometown'] = substr($parts[2], 0, -7);

    $count++;
  } // while

}

// Step 4 : Get $numCards Favorite Quotes -- DLM: Is this API really slow or is it just me?
if ($debug) {echo "Step 4: Quotes.\n";};

if ($enable_4) {
    $count = 0;
    while ($count < $numCards) {

        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.quotable.io/random?maxLength=160",
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
	    #echo $response;
        }

        $data = json_decode($response);

        #echo "Response: " . $response. "\n";
        #echo "===\n";
        #print_r($data);
        #echo "===\n";

        $people[$count]['quote'] = $data->{'content'};
        $people[$count]['author'] = $data->{'author'};

        $count++;

    } // While
}


// Step 5 : Get $numCards Roles
if ($debug) {echo "Step 5: Roles.\n";}

if ($enable_5) {

   $file = "static/StaffSpotlight/StaffSpotlight-roles.txt";
   $count=0;
   while ($count < $numCards) {
     if (file_exists($file)) {
       $f_contents = file($file); 
       $role = $f_contents[rand(0, count($f_contents) - 1)];
       $role = rtrim($role, " \n\r\t\v\0");
       $people[$count]['role'] = $role;
       
       //echo "Line: [".$line."]\n";

     } else {
       $cwd = getcwd();
       echo "ERROR: File not found [" .$cwd.$file."].\n";
     }

     $count++;
   }
}

#echo "Dump People:\n";
#echo "===\n";
#$count = 0;
#while ($count < $numCards) {
#  var_dump($people[$count]);
#  $count++;
#}
#echo "===\n";

// Step 6 : Generate the HTML to be included in the page
if ($debug) {echo "Step 6: Generate HTML.\n";}

if ($enable_6) {

  // Pre- card stuff

  echo "      <h2 class=\"title\">Staff Spotlight</h2>\n";
  echo "      <p style=\"color:black; font-size:140%;\">\n";
  echo "        This is our Staff Spotlight where we focus on some of the folks who help make us who we are!\n";
  echo "      </p>\n";
  echo "      <center>\n";

  echo "        <div class=\"row\">\n";

  $count = 0;
  while($count < $numCards) {

// Generate a card

    echo "           <div class=\"col-md-3 col-sm-6\">\n";
    echo "             <div class=\"card card-profile\">\n";
    echo "               <div class=\"card-cover\" style=\"background-image: url('". $people[$count]['background']. "')\">\n";
    echo "               </div>\n";
    echo "               <div class=\"card-avatar border-white\">\n";
    echo "                 <a href=\"#avatar\">\n";
    echo "                   <img src=\"". $people[$count]['url']. "\" alt=\"...\" />\n";
    echo "                 </a>\n";
    echo "               </div>\n";
    echo "               <div class=\"card-body\">\n";
    echo "                 <h4 class=\"card-title\">". $people[$count]['name'] ."</h4>\n";
    echo "                 <h6 class=\"card-category\">". $people[$count]['role'] . "</h6>\n";
    echo "                 <p style=\"color:black\" align=\"left\" class=\"card-description\">\n";
    echo "                   <b>Quote:</b> \"" .$people[$count]['quote']. "\" - <i>" .$people[$count]['author']. "</i>.<br>\n";
    echo "                   Home Town: ". $people[$count]['hometown'] .".\n";
    echo "                 </p>\n";
    echo "               </div>\n";
    echo "             </div> <!-- end card -->\n";
    echo "           </div> <!-- end col- col- -->\n";

    $count++;
  }
  // Post- card
  echo "        </div>\n"; // end Row
  echo "        <div class=\"card bg-info text-white\">\n";
  echo "          <p style=\"color:black; font-size:100%;\">Credit to <a href=\"https://helloacm.com/rig/\">HelloACM</a> for the random identity generator, <a href=\"https://generated.photos/\">Generated.photos</a> for the AI generated headshots and <a href=\"https://pixabay.com/\">Pixabay</a> for the random backgrounds and <a href=\"https://api.quotable.io\">api.quoteable.io</a> for the quotes api.</p>\n";
  echo "        </div>\n";

  echo "        </center>\n";


}

?>
