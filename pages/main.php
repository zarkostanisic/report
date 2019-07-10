<?php 
  $section = $phpWord->addSection();

  $section->addText(
    'REPORT',
    array('size' => 32),
    array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(150))
  );

  $section->addPageBreak();
 ?>
