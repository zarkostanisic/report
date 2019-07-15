<?php

  //require_once('./app/connection.php');

  require_once('./vendor/autoload.php');

  // Functions
  require_once('./includes/functions.php');

  //PHPWord
  use PhpOffice\PhpWord\PhpWord;

  $phpWord = new PhpWord(array());
  // $phpWord->getSettings()->setUpdateFields(true);

  // Styles
  require_once('./pages_tcom/includes/styles.php');

  // Page 1
  require_once('./pages_tcom/page1.php');

  // Page 2
  require_once('./pages_tcom/page2.php');

  // Page 3
  require_once('./pages_tcom/page3.php');

  // Page 4
  require_once('./pages_tcom/page4.php');

  $fileName = 'report-tcom';

  require_once('./includes/save.php');

 ?>
