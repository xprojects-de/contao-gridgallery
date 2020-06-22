<?php

namespace XProjects\Gridgallery\Classes;

use XProjects\Gridgallery\GridgalleryUtils;

class Gridgallery extends \ContentElement {

  protected $strTemplate = 'gridgallery_overview';

  public function generate() {
    if (TL_MODE == 'BE') {
      $objTemplate = new \BackendTemplate('be_wildcard');
      $images = $this->renderGallery();
      $data = "";
      foreach ($images as $image) {
        $data .= '<div style="background:#ccc;margin-bottom:5px;padding:10px;">';
        $data .= '<img src="' . $image['thumb'] . '" width="100" style="margin-right:5px;margin-bottom:5px;" />';
        $data .= '<img src="' . $image['image'] . '" width="200" style="margin-right:5px;margin-bottom:5px;" />';
        $data .= '</div>';
      }
      $objTemplate->wildcard = $data;
      return $objTemplate->parse();
    }
    return parent::generate();
  }

  protected function compile() {
    $assetsDir = 'bundles/gridgallery';
    $GLOBALS['TL_JAVASCRIPT'][] = $assetsDir . '/js/gridgallery.js|static';
    $GLOBALS['TL_CSS'][] = $assetsDir . '/css/gridgallery.css|static';
    $this->Template->xdata = $this->renderGallery();
  }

  private function renderGallery() {
    $data = array();
    $optionsObj = \Database::getInstance()->prepare("SELECT * FROM tl_fieldpalette WHERE pid=? AND pfield=? AND published=? ORDER BY sorting ASC")->execute($this->id, 'xextendedgallerydata', 1);
    if ($optionsObj->numRows > 0) {
      $sum = 0;
      while ($optionsObj->next()) {
        $thumb = '';
        $thumbImage = GridgalleryUtils::xGetImage($optionsObj->xextendedgallerydata_thumb);
        if ($thumbImage['imgsrc'] != '') {
          $thumb = $thumbImage['imgsrc'];
        }
        $image = '';
        $mageData = GridgalleryUtils::xGetImage($optionsObj->xextendedgallerydata_image);
        if ($mageData['imgsrc'] != '') {
          $image = $mageData['imgsrc'];
        }
        $tmp = array();
        $tmp['thumb'] = $thumb;
        $tmp['thumburl'] = \Environment::get('base') . $thumb;
        $tmp['image'] = $image;
        $tmp['lightbox'] = ' data-lightbox="lb' . $this->id . '"';
        $tmp['text'] = $optionsObj->xextendedgallerydata_text;
        $tmp['grid'] = $optionsObj->xextendedgallerydata_grid;
        $tmp['gridstart'] = false;
        $tmp['gridstop'] = false;
        if ($sum == 0) {
          $tmp['gridstart'] = true;
        }
        $sum += intval($optionsObj->xextendedgallerydata_grid);
        if ($sum >= 99) {
          $tmp['gridstop'] = true;
          $sum = 0;
        }
        array_push($data, $tmp);
      }
    }
    //dump($data);
    //die;
    return $data;
  }

}
