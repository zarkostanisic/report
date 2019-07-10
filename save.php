<?php
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
