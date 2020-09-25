<?php
function pageTitle()
{
 global $title;
 if ((isset($title)) and (!empty($title))) {
  $tarray = str_split($title);
  $c      = count($tarray);
  $carex  = 0;
  for ($i = 0; (($i < $c) and ($carex == 0)); $i++) {
   if ($tarray[$i] != " ") {
    $carex++;
   }
  }
  if ($carex == 1) {
   echo $title;
  } else {
   echo "No Title";
  }
 } else {
  echo "No Title";
 }
}
