<?php
  //Heading 1, Heading 2, Heading 3
  $phpWord->addTitleStyle(1, array('size' => 20, 'bold' => true));
  $phpWord->addTitleStyle(2, array('size' => 16, 'bold' => true));
  $phpWord->addTitleStyle(3, array('size' => 12, 'bold' => true));
  
  // Font Styles
  $boldFontStyle = new \PhpOffice\PhpWord\Style\Font();
  $boldFontStyle->setBold(true);
  $boldFontStyle->setName('Tahoma');
  $boldFontStyle->setSize(16);

  // Table Styles
  $styleTable = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 80);
  $styleFirstRow = array('borderBottomSize' => 0, 'borderBottomColor' => 'DDDDDD', 'bgColor' => 'CCCCCC');

  $styleChartTable = array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);

  $phpWord->addTableStyle('Report', $styleTable, $styleFirstRow);
  $phpWord->addTableStyle('Chart', $styleChartTable);
 ?>
