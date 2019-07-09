<?php
  require_once('./app/connection.php');

  require_once('./vendor/autoload.php');

  // Check customer_id
  if(!isset($_GET['customer_id']) || empty($_GET['customer_id'])) die('Customer id is required');

  $customer_id = (int)$_GET['customer_id'];

  use PhpOffice\PhpWord\PhpWord;

  $phpWord = new PhpWord(array());
  $phpWord->getSettings()->setUpdateFields(true);

  // Styles for title
  $phpWord->addTitleStyle(1, array('size' => 20, 'bold' => true));
  $phpWord->addTitleStyle(2, array('size' => 16, 'bold' => true));

  $section = $phpWord->addSection();

  // Main page
  $section->addText(
    'REPORT',
    array('size' => 32),
    array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(150))
  );

  $section->addPageBreak();

  // Table of content
  $section->addTOC();
  $section->addPageBreak();

  $section = $phpWord->addSection(array('pageNumberingStart' => 3));

  // Header
  $header = $section->addHeader();
  $header->addPreserveText('Report {DATE}');

  // Footer
  $footer = $section->addFooter();
  $footer->addPreserveText('Page {PAGE} of {NUMPAGES}.');

  // Font Styles
  $boldFontStyle = new \PhpOffice\PhpWord\Style\Font();
  $boldFontStyle->setBold(true);
  $boldFontStyle->setName('Tahoma');
  $boldFontStyle->setSize(16);

  // Table Styles
  $styleTable = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 80);
  $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => 'DDDDDD', 'bgColor' => 'CCCCCC');

  $styleChartTable = array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);

  $phpWord->addTableStyle('Report', $styleTable, $styleFirstRow);
  $phpWord->addTableStyle('Chart', $styleChartTable);

  // Text and pie chart - Page 1
  require_once('./pages/text_pie_chart.php');

  // Table and column clustered chart - Page 2
  require_once('./pages/table_column_clustered.php');

  // Pie and column charts - Page 3
  require_once('./pages/pie_column_charts.php');

  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
  $objWriter->save('./reports/report.docx');

  echo "<hr>";
  echo "Report generated";
  echo "<hr>";

  // Test
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
  $objWriter->save('./reports/report.html');

  require_once('./reports/report.html');

 ?>
