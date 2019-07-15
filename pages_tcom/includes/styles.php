<?php
  // Text
  $textCenter = array('align' => 'center', 'spaceAfter' => 0);
  $textBold = array('bold'=> true);

  // Title
  $phpWord->addTitleStyle(
    2,
    array('size' => 16, 'bold' => true),
    array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER)
  );

  // Table
  $styleTable = array('cellMarginLeft' => 50, 'cellMarginRight' => 50, 'cellMarginTop' => 20, 'cellMarginBottom' => 20, 'borderSize' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
  $phpWord->addTableStyle('Table', $styleTable);
  $cellValign = array('valign' => 'center');

  // Section
  $sectionAutoFit = array('marginLeft'=>500, 'marginRight'=>500);
 ?>
