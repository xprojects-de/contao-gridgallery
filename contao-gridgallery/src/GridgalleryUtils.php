<?php

namespace XProjects\Gridgallery;

class GridgalleryUtils extends \Backend {

  public static function xGetImage($name, $size = array()) {
    $returnvalue = array(
        'path' => '',
        'imgsrc' => ''
    );
    $objFile = \FilesModel::findByUUID($name);
    if (is_file(TL_ROOT . '/' . $objFile->path)) {
      $file1 = new \File($objFile->path, true);
      if ($file1->exists()) {
        $returnvalue['path'] = $objFile->path;
        if (count($size)) {
          $returnvalue['imgsrc'] = \Image::get($objFile->path, $size[0], $size[1], $size[2]);
        } else {
          $returnvalue['imgsrc'] = \Image::get($objFile->path, $file1->width, $file1->height);
        }
      }
    }
    return $returnvalue;
  }

}
