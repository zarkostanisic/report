<?php
  namespace App;
  
  class Chart{
    private $style = array();

    // 1.title, 2.width, 3.height, 4.is3D, 5.$showLegend, 6.showAxisLabels, 7.showVal, 8.showPercent, 9.showCategoryName
    public function __construct($title, $width, $height, $is3D = false, $showLegend = true, $showAxisLabels = false, $showVal = true, $showPercent = false, $showCatName = false){
      $this->style['title'] = $title;
      $this->style['width'] = $width;
      $this->style['height'] = $height;
      $this->style['3d'] = $is3D;
      $this->style['showLegend'] = $showLegend;
      $this->style['showAxisLabels'] = $showAxisLabels;
      $this->style["dataLabelOptions"]['showCatName'] = $showCatName;
      $this->style["dataLabelOptions"]['showVal'] = $showVal;
      $this->style["dataLabelOptions"]['showPercent'] = $showPercent;
    }

    public function pie($categories, $series){
      global $section;

      $section->addChart('pie', $categories, $series, $this->style);
    }

    public function column($categories, $series, $name = ''){
      global $section;

      $section->addChart('column', $categories, $series, $this->style, $name);
    }

    public function columnClustered($categories, $series, $names){
      global $section;
      $chart = $section->addChart('column', $categories, $series[0], $this->style, $names[0]);

      unset($series[0]);
      unset($names[0]);

      for($i = 1; $i <= count($series); $i++){
        $chart->addSeries($categories, $series[$i], $names[$i]);
      }
    }
  }
 ?>
