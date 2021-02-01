<?php
$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank", "Fred", "Sam", "Diane", "Sven", "Ferd", "Gene", "Paul", "Mark");
$rand_keys = array_rand($input, 3);
foreach ($rand_keys as $v) {
  echo "Current value of \$a: $input[$v].\n";
}
?>
