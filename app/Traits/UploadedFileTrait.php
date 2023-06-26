<?php 

namespace App\Traits;
use RandomLib\Factory;
use SecurityLib\Strength;

trait UploadedFileTrait {


  public function uploaded_file($file, $path) : bool|string
  {
    $fileName = $file['name'];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    if (in_array($fileType, $GLOBALS['config']->get('file.image.extension'))){

      if ($file['size'] < 500000) {

        $file_tmp = $file['tmp_name'];
        $generator = (new Factory)->getGenerator(new Strength(Strength::MEDIUM));
        $hashName = $generator->generateInt(100, 99999999) . '_photo_' . md5($generator->generateString(5)) . '.' . $fileType;
        $uploaded_path = IMAGES . $path . DIRECTORY_SEPARATOR . $hashName;

        $uploaded = move_uploaded_file($file_tmp,  $uploaded_path);

        return $uploaded ? $hashName : false;
      }
    }

    return false;
  }

}