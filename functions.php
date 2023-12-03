<?php
function getSeason(){
       $day = date("z");

       $spring_starts = date("z", strtotime("March 21"));
       $spring_ends   = date("z", strtotime("June 20"));

       $summer_starts = date("z", strtotime("June 21"));
       $summer_ends   = date("z", strtotime("September 22"));

       $autumn_starts = date("z", strtotime("September 23"));
       $autumn_ends   = date("z", strtotime("December 20"));

       if( $day >= $spring_starts && $day <= $spring_ends ){
               $season = "spring";
       } elseif( $day >= $summer_starts && $day <= $summer_ends ){
               $season = "summer";
       } elseif( $day >= $autumn_starts && $day <= $autumn_ends ){
               $season = "autumn";
       } else {
               $season = "winter";
       }
       return $season;
}

function getsize($img){
  global $max_width;
  global $max_height;
  list($width_img, $height_img) = getimagesize($img);
  if($width_img > $max_width){
    $width =  $max_width.'px';
  } else {
    $width =  $width_img.'px';
  }
  if($height_img > $max_height){
    $height =  $max_height.'px';
  } else {
    $height =  $height_img.'px';
  }
  return " width=\"".$width."\" height=\"".$height."\" ";
}

function getAllImgs($dir) {
  $resizedFilePath = array();
    foreach (glob('{'.$dir . '*.{jpg,jpeg,png,gif},'.$dir.getSeason().'/*.{jpg,jpeg,png,gif}}', GLOB_BRACE) as $filename) {
        array_push($resizedFilePath, $filename);
    }
  return $resizedFilePath;
}
?>
