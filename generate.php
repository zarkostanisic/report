<?php
  require_once('./app/connection.php');

  require_once('./vendor/autoload.php');

  // Check customer_id
  if(!isset($_GET['customer_id']) || empty($_GET['customer_id'])) die('Customer id is required');

  $customer_id = (int)$_GET['customer_id'];

  //PHPWord
  use PhpOffice\PhpWord\PhpWord;

  $phpWord = new PhpWord(array());
  $phpWord->getSettings()->setUpdateFields(true);

  // Styles
  require_once('./pages/includes/styles.php');

  // Main page - Page 1
  require_once('./pages/main.php');

  // Table of content - Page 2
  require_once('./pages/toc.php');

  // Header
  require_once('./pages/includes/header.php');

  // Footer
  require_once('./pages/includes/footer.php');

  // Text and pie chart - Page 3
  require_once('./pages/text_pie_chart.php');

  // Table and column clustered chart - Pages 4 and 5
  require_once('./pages/table_column_clustered.php');

  // Pie and column charts - Page 6
  require_once('./pages/pie_column_charts.php');

  $fileName = 'report-' . $customer_id;

  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
  $objWriter->save('./reports/' . $fileName . '.docx');

  echo "<hr>";
  echo "Report generated";
  echo "<hr>";

  // Test
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
  $objWriter->save('./reports/' . $fileName . '.html');

  require_once('./reports/' . $fileName . '.html');

 ?>
