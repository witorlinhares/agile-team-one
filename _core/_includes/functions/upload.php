<?php

if( !function_exists( 'imagecreatefrombmp' ) ){
   function imagecreatefrombmp($fileName) {
       $file = fopen($fileName, "rb");
       $read = fread($file, 10);
       while (!feof($file) && ($read <> ""))
           $read .= fread($file, 1024);
       $temp = unpack("H*", $read);
       $hex = $temp[1];
       $header = substr($hex, 0, 108);
       if (substr($header, 0, 4) == "424d") {
           $parts = str_split($header, 2);
           $width = hexdec($parts[19] . $parts[18]);
           $height = hexdec($parts[23] . $parts[22]);
           unset($parts);
       }
       $x = 0;
       $y = 1;
       $image = imagecreatetruecolor($width, $height);
       $body = substr($hex, 108);
       $body_size = (strlen($body) / 2);
       $header_size = ($width * $height);
       $usePadding = ($body_size > ($header_size * 3) + 4);
       for ($i = 0; $i < $body_size; $i+=3) {
           if ($x >= $width) {
               if ($usePadding)
                   $i += $width % 4;
               $x = 0;
               $y++;
               if ($y > $height)
                   break;
           }
           $i_pos = $i * 2;
           $r = hexdec($body[$i_pos + 4] . $body[$i_pos + 5]);
           $g = hexdec($body[$i_pos + 2] . $body[$i_pos + 3]);
           $b = hexdec($body[$i_pos] . $body[$i_pos + 1]);
           $color = imagecolorallocate($image, $r, $g, $b);
           imagesetpixel($image, $x, $height - $y, $color);
           $x++;
       }
       fclose($file);
       unset($body);
       return $image;
   }
}

function upload_image( $relpath,$image ) {

   global $rootpath;
   global $image_max_width;
   global $image_max_height;

   // $image

   if( isset( $image ) ){

      $datepathy = date("Y");
      $datepathm = date("m");
      $datepath = $datepathy."/".$datepathm;
      $uploadpath = $rootpath."/_core/_uploads/";
      $uploadpathfull = $rootpath."/_core/_uploads/".$relpath."/".$datepath;
      $uploadpathreturn = $relpath."/".$datepath;
      if( !file_exists($uploadpathfull) ) {
          mkdir($uploadpath."/".$relpath, 0777);
          mkdir($uploadpath."/".$relpath."/".$datepathy, 0777);
          mkdir($uploadpath."/".$relpath."/".$datepathy."/".$datepathm, 0777);
      }
      $uploadinfo = array();
      $file_name = $image['name'];
      $file_size = $image['size'];
      $file_tmp = $image['tmp_name'];
      $file_type = $image['type'];
      $file_ext = explode('.',$file_name);
      $file_ext = strtolower(end($file_ext));
      $random_key = @random_key(10);
      $new_name = date('Hidmy').$random_key;
      
      $extensions= array("jpeg","jpg","png","gif","bmp");
      
      if( in_array($file_ext,$extensions) === false ){

         $uploadinfo['errors'][] = "Extensão não permitida (jpeg,jpg,png,gif,bmp)";

      }
      
      if($file_size > 5242880){

         $uploadinfo['errors'][] = 'O arquivo deve ser inferior a 5 megabytes';

      }
      
      if( empty( $uploadinfo['errors'] ) == true ){

         if( $file_ext == "jpg" ) {
            $newimage = imagecreatefromjpeg($file_tmp);
            $new_name .= ".jpg";
         } 

         if( $file_ext == "jpeg" ) {
            $newimage = imagecreatefromjpeg($file_tmp);
            $new_name .= ".jpeg";
         } 

         if( $file_ext == "png" ) {
            $newimage = imagecreatefrompng($file_tmp);
            $new_name .= ".png";
         } 

         if( $file_ext == "gif" ) {
            $newimage = imagecreatefromgif($file_tmp);
            $new_name .= ".gif";
         }

         if( $file_ext == "bmp" ) {
            $newimage = imagecreatefrombmp($file_tmp);
            $new_name .= ".jpg";
         }

         // Target dimensions
         $max_width = $image_max_width;
         $max_height = $image_max_height;

         // Get current dimensions
         $old_width  = imagesx($newimage);
         $old_height = imagesy($newimage);

         if($old_width > $max_height) {

            // Calculate the scaling we need to do to fit the image inside our frame
            $scale = min($max_width/$old_width, $max_height/$old_height);

            // Get the new dimensions
            $new_width  = ceil($scale*$old_width);
            $new_height = ceil($scale*$old_height);

            // Create new empty image
            $new = imagecreatetruecolor($new_width, $new_height);

            if( $file_ext == "png" ) {
               imagealphablending($new, false);
               imagesavealpha($new,true);
               $transparent = imagecolorallocatealpha($new, 255, 255, 255, 127);
               imagefilledrectangle($new, 0, 0, $new_width, $new_height, $transparent); 
            }

            // Resize old image into new
            imagecopyresampled($new, $newimage, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

         } else {

            $new = $newimage;

            if( $file_ext == "png" ) {
               imagealphablending($new, false);
               imagesavealpha($new,true);
               $transparent = imagecolorallocatealpha($new, 255, 255, 255, 127);
               imagefilledrectangle($new, 0, 0, $new_width, $new_height, $transparent); 
            }

         }

         if( $file_ext == "jpg" ) {

            if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         } 

         if( $file_ext == "jpeg" ) {

            if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         } 

         if( $file_ext == "png" ) {

            if( imagepng( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         } 

         if( $file_ext == "gif" ) {

            if( imagegif( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         }

         if( $file_ext == "bmp" ) {

            if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         }         

      } else {

         $uploadinfo['status'] = "2";
         return $uploadinfo;

      }

   }

} 

function upload_image_direct( $relpath,$file_name,$file_size,$file_tmp,$file_type ) {

   global $rootpath;
   global $image_max_width;
   global $image_max_height;
   $image = true;

   // $image

   if( isset( $image ) ){

      $datepathy = date("Y");
      $datepathm = date("m");
      $datepath = $datepathy."/".$datepathm;
      $uploadpath = $rootpath."/_core/_uploads/";
      $uploadpathfull = $rootpath."/_core/_uploads/".$relpath."/".$datepath;
      $uploadpathreturn = $relpath."/".$datepath;
      if( !file_exists($uploadpathfull) ) {
          mkdir($uploadpath."/".$relpath, 0777);
          mkdir($uploadpath."/".$relpath."/".$datepathy, 0777);
          mkdir($uploadpath."/".$relpath."/".$datepathy."/".$datepathm, 0777);
      }
      $uploadinfo = array();
      $file_ext = explode('.',$file_name);
      $file_ext = strtolower(end($file_ext));
      $random_key = @random_key(10);
      $new_name = date('Hidmy').$random_key;
      
      $extensions= array("jpeg","jpg","png","gif","bmp");
      
      if( in_array($file_ext,$extensions) === false ){

         $uploadinfo['errors'][] = "Extensão não permitida (jpeg,jpg,png,gif,bmp)";

      }
      
      if($file_size > 5242880){

         $uploadinfo['errors'][] = 'O arquivo deve ser inferior a 5 megabytes';

      }
      
      if( empty( $uploadinfo['errors'] ) == true ){

         if( $file_ext == "jpg" ) {
            $newimage = imagecreatefromjpeg($file_tmp);
            $new_name .= ".jpg";
         } 

         if( $file_ext == "jpeg" ) {
            $newimage = imagecreatefromjpeg($file_tmp);
            $new_name .= ".jpeg";
         } 

         if( $file_ext == "png" ) {
            $newimage = imagecreatefrompng($file_tmp);
            $new_name .= ".png";
         } 

         if( $file_ext == "gif" ) {
            $newimage = imagecreatefromgif($file_tmp);
            $new_name .= ".gif";
         }

         if( $file_ext == "bmp" ) {
            $newimage = imagecreatefrombmp($file_tmp);
            $new_name .= ".jpg";
         }

         // Target dimensions
         $max_width = $image_max_width;
         $max_height = $image_max_height;

         // Get current dimensions
         $old_width  = imagesx($newimage);
         $old_height = imagesy($newimage);

         if($old_width > $max_height) {

            // Calculate the scaling we need to do to fit the image inside our frame
            $scale = min($max_width/$old_width, $max_height/$old_height);

            // Get the new dimensions
            $new_width  = ceil($scale*$old_width);
            $new_height = ceil($scale*$old_height);

            // Create new empty image
            $new = imagecreatetruecolor($new_width, $new_height);

            if( $file_ext == "png" ) {
               imagealphablending($new, false);
               imagesavealpha($new,true);
               $transparent = imagecolorallocatealpha($new, 255, 255, 255, 127);
               imagefilledrectangle($new, 0, 0, $new_width, $new_height, $transparent); 
            }

            // Resize old image into new
            imagecopyresampled($new, $newimage, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

         } else {

            $new = $newimage;

            if( $file_ext == "png" ) {
               imagealphablending($new, false);
               imagesavealpha($new,true);
               $transparent = imagecolorallocatealpha($new, 255, 255, 255, 127);
               imagefilledrectangle($new, 0, 0, $new_width, $new_height, $transparent); 
            }

         }

         if( $file_ext == "jpg" ) {

            if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         } 

         if( $file_ext == "jpeg" ) {

            if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         } 

         if( $file_ext == "png" ) {

            if( imagepng( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         } 

         if( $file_ext == "gif" ) {

            if( imagegif( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         }

         if( $file_ext == "bmp" ) {

            if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
               $uploadinfo['status'] = "1";
               $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
               return $uploadinfo;
            } else {
               $uploadinfo['status'] = "2";
               return $uploadinfo;
            }

         }         

      } else {

         $uploadinfo['status'] = "2";
         return $uploadinfo;

      }

   }

} 

function uploadpath() {

   global $just_url;

   return $just_url."/_core/_uploads/";

}

function gera_thumb( $file,$largura,$altura ) {

  global $rootpath;
  $uploadpath = $rootpath."/_core/_uploads";

  $image_max_width = $largura;
  $image_max_height = $altura;

  $file_tmp = $uploadpath."/".$file;

  if( file_exists($file_tmp) ){

    $file_info = explode(".", $file);
    
    $file_name = $file_info[0];
    $file_ext = $file_info[1];
    $uploadpathfull = str_replace($file_name.".".$file_ext, "", $file_tmp);

    $random_key = @random_key(10);
    $new_name = $file_name."_thumb";

     if( $file_ext == "jpg" ) {
        $newimage = imagecreatefromjpeg($file_tmp);
        $new_name .= ".jpg";
     } 

     if( $file_ext == "jpeg" ) {
        $newimage = imagecreatefromjpeg($file_tmp);
        $new_name .= ".jpeg";
     } 

     if( $file_ext == "png" ) {
        $newimage = imagecreatefrompng($file_tmp);
        $new_name .= ".png";
     } 

     if( $file_ext == "gif" ) {
        $newimage = imagecreatefromgif($file_tmp);
        $new_name .= ".gif";
     }

     if( $file_ext == "bmp" ) {
        $newimage = imagecreatefrombmp($file_tmp);
        $new_name .= ".jpg";
     }

     // Target dimensions
     $max_width = $image_max_width;
     $max_height = $image_max_height;

     // Get current dimensions
     $old_width  = imagesx($newimage);
     $old_height = imagesy($newimage);

     if($old_width > $max_height) {

        // Calculate the scaling we need to do to fit the image inside our frame
        $scale = min($max_width/$old_width, $max_height/$old_height);

        // Get the new dimensions
        $new_width  = ceil($scale*$old_width);
        $new_height = ceil($scale*$old_height);

        // Create new empty image
        $new = imagecreatetruecolor($new_width, $new_height);

        if( $file_ext == "png" ) {
           imagealphablending($new, false);
           imagesavealpha($new,true);
           $transparent = imagecolorallocatealpha($new, 255, 255, 255, 127);
           imagefilledrectangle($new, 0, 0, $new_width, $new_height, $transparent); 
        }

        // Resize old image into new
        imagecopyresampled($new, $newimage, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

     } else {

        $new = $newimage;

        if( $file_ext == "png" ) {
           imagealphablending($new, false);
           imagesavealpha($new,true);
           $transparent = imagecolorallocatealpha($new, 255, 255, 255, 127);
           imagefilledrectangle($new, 0, 0, $new_width, $new_height, $transparent); 
        }

     }

     if( $file_ext == "jpg" ) {

        if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
           $uploadinfo['status'] = "1";
           $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
           return $uploadinfo;
        } else {
           $uploadinfo['status'] = "2";
           return $uploadinfo;
        }

     } 

     if( $file_ext == "jpeg" ) {

        if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
           $uploadinfo['status'] = "1";
           $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
           return $uploadinfo;
        } else {
           $uploadinfo['status'] = "2";
           return $uploadinfo;
        }

     } 

     if( $file_ext == "png" ) {

        if( imagepng( $new,$uploadpathfull."/".$new_name ) ) {;
           $uploadinfo['status'] = "1";
           $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
           return $uploadinfo;
        } else {
           $uploadinfo['status'] = "2";
           return $uploadinfo;
        }

     } 

     if( $file_ext == "gif" ) {

        if( imagegif( $new,$uploadpathfull."/".$new_name ) ) {;
           $uploadinfo['status'] = "1";
           $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
           return $uploadinfo;
        } else {
           $uploadinfo['status'] = "2";
           return $uploadinfo;
        }

     }

     if( $file_ext == "bmp" ) {

        if( imagejpeg( $new,$uploadpathfull."/".$new_name ) ) {;
           $uploadinfo['status'] = "1";
           $uploadinfo['url'] = $uploadpathreturn."/".$new_name;
           return $uploadinfo;
        } else {
           $uploadinfo['status'] = "2";
           return $uploadinfo;
        }

     }         

  } else {

     $uploadinfo['status'] = "2";
     return $uploadinfo;

  }

} 

function thumber( $img,$width ) {

  global $rootpath;
  $uploadpath = $rootpath."/_core/_uploads/";
  $width = "512";

  $thumb = explode( ".",$img );
  $thumb_name = $thumb[0]."_thumb";
  $thumb_extension = $thumb[1];
  $thumb = $thumb_name.".".$thumb_extension;
  $file = $uploadpath.$thumb;

  if( file_exists($file) ) {
    $thumburl = $thumb;
  } else {
    $newthumb = gera_thumb($img,$width,$width);
    $thumburl = $img;
  }

  global $just_url;
  global $app;
  if( isset($app['url']) ) {
    $just_url = $app['url'];
  }
  $thumburl = "/_core/_uploads/".$thumburl;
  $thumburl = str_replace("//", "/", $thumburl);
  $thumburl = $just_url.$thumburl;
  return $thumburl;

}

function imager( $img ) {

  global $just_url;
  $imagerurl = $just_url."/_core/_uploads/".$img;
  return $imagerurl;

}

function deletedir($path) {
    return is_file($path) ?
      @unlink($path) :
      array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
}

?>