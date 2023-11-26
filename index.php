<?php
$title = "SlideShow"; //Title of pagina
$refresh_in_sec = '25'; //Number of seconds for next image

$dir = 'images/'; //Directory where the images are located
$max_width = ''; //Max screen width
$max_height = ''; //Max screen height


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
    foreach (glob($dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $filename) {
        array_push($resizedFilePath, $filename);
    }
  return $resizedFilePath;
}

$allimages = getAllImgs($dir);
shuffle($allimages);
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
        <meta http-equiv="Expires" content="604800">
        <meta http-equiv="Pragma" content=" must-revalidate">
        <meta http-equiv="Cache-Control" content=" must-revalidate">
        <style type="text/css">
          html,body {
            background-color: #000;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
          }
          #center {
            height: <?php echo $max_height; ?>px;
            width: <?php echo $max_width; ?>px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
          }
          .img_slide {
            background-size:  <?php echo $max_width; ?>px <?php echo $max_height; ?>px cover;
            background-color: #000;
            height: <?php echo $max_height; ?>px;
            width: <?php echo $max_width; ?>px;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            display: none;
          }
          .img_slide img {
            vertical-align: middle;
            height: <?php echo $max_height; ?>px;
            width: <?php echo $max_width; ?>px;
            object-fit: contain;
          }
        </style>
    </head>
    <body>
      <div id="center">
          <?php
          foreach ($allimages as $key => $image_url) {
              if($key == 0){echo "\t<div class=\"img_slide\">\n";} else
              echo "\t\t\t<div class=\"img_slide\">\n";
              echo "\t\t\t\t<img src=\"".$image_url."\" ".getsize($image_url)." />\n";
              echo "\t\t\t</div>\n";
          } ?>
      </div>
      <script type="text/javascript">
            let slide_index = 1;
            slidesShow();
            function slidesShow() {
              let i;
              let slides = document.getElementsByClassName("img_slide");
              for (i = 0; i < slides.length; i++) {
                now = slide_index;
                old = slide_index-1;
                slides[now].style.display = "table";
                slides[old].style.display = "none";
              }
              slide_index++;
              if (slide_index == slides.length) {
                window.location.reload();
              }
              setTimeout(slidesShow, <?php echo $refresh_in_sec."000"; ?>);
            }
      </script>
  </body>
</html>
