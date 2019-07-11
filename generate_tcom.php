<?php
  require_once('./app/connection.php');

  require_once('./vendor/autoload.php');

  use PhpOffice\PhpWord\Shared\Converter;

  //PHPWord
  use PhpOffice\PhpWord\PhpWord;

  $phpWord = new PhpWord(array());
  // $phpWord->getSettings()->setUpdateFields(true);
  $textCenter = array('align' => 'center', 'spaceAfter' => 0);
  $textBold = array('bold'=> true);

  $phpWord->addTitleStyle(
    2,
    array('size' => 16, 'bold' => true),
    array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER)
  );

  $styleTable = array('cellMarginLeft' => 50, 'cellMarginRight' => 50, 'cellMarginTop' => 20, 'cellMarginBottom' => 20, 'borderSize' => 1, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);

  $phpWord->addTableStyle('Table', $styleTable);

  // Page 1
  $section = $phpWord->addSection();

  // Title
  $section->addTitle('Broj brojila i citaca po ispostavama', 2);
  $section->addTextBreak();

  // Table
   $table1 = $section->addTable('Table');
   $table1->addRow();
   $table1->addCell()->addText('Ispostava', [], $textCenter);
   $table1->addCell()->addText('Broj citaca', [], $textCenter);
   $table1->addCell()->addText('Broj brojila', [], $textCenter);
   $table1->addCell()->addText('Prosecno brojila po citacu', [], $textCenter);

   $table1Values = array(
    array('Smederevo', 55, 44017, 800.31),
    array('Smederevska Palanka', 49, 26373, 538.22),
    array('Velika Plana', 30, 20173, 672.43)
  );

  $sumN1 = 0;
  $sumN2 = 0;
  $sumN3 = 0;

  // Data for chart
  $c1 = array();
  $s1 = array();

  $count = 0;
  foreach( $table1Values as $v){
    $count++;

    $city = $v[0];
    $n1 = $v[1];
    $n2 = $v[2];
    $n3 = $v[3];

    $sumN1 += $n1;
    $sumN2 += $n2;
    $sumN3 += $n3;

    $c1[] = $city;
    $s1[] = $n1;

     $table1->addRow();
     $table1->addCell()->addText($city, [], $textCenter);
     $table1->addCell()->addText($n1, [], $textCenter);
     $table1->addCell()->addText($n2, [], $textCenter);
     $table1->addCell()->addText($n3, [], $textCenter);
  }

   $table1->addRow();
   $table1->addCell()->addText('Ukupno', $textBold, $textCenter);
   $table1->addCell()->addText($sumN1, $textBold, $textCenter);
   $table1->addCell()->addText($sumN2, $textBold, $textCenter);
   $table1->addCell()->addText(($sumN3 / $count), $textBold, $textCenter);

  $section->addTextBreak();

  // Chart

  $styleChart1 = array(
    'width' => Converter::inchToEmu(6),
    'height' => Converter::inchToEmu(4),
    'title' => 'Broj citaca po ispostavama',
    'showAxisLabels' => true,
    'dataLabelOptions' => array(
      'showCatName' => false
    )
  );

  $section->addChart('column', $c1, $s1, $styleChart1, 'Broj citaca');

  $section->addPageBreak();

  // End Page 1

  // Page 2

  // Table
   $table2 = $section->addTable('Table');
   $table2->addRow();
   $table2->addCell()->addText('Ispostava', [], $textCenter);
   $table2->addCell()->addText('Ukupno dodeljeno brojila', [], $textCenter);
   $table2->addCell()->addText('Broj ocitanih brojila', [], $textCenter);
   $table2->addCell()->addText('Broj neocitanih - nepristupacnih brojila', [], $textCenter);
   $table2->addCell()->addText('Broj neocitanih brojila', [], $textCenter);
   $table2->addCell()->addText('Ukupno neocitanih brojila', [], $textCenter);

   $table2Values = array(
    array('Smederevo', 44017, 41387, 2106, 524),
    array('Smederevska Palanka', 26373, 23631, 744, 1998),
    array('Velika Plana', 20173, 18248, 1018, 907)
  );

  $sumN1 = 0;
  $sumN2 = 0;
  $sumN3 = 0;
  $sumN4 = 0;
  $sumN5 = 0;

  $c2 = array();
  $s2 = array();

  foreach( $table2Values as $v){

    $city = $v[0];
    $n1 = $v[1];
    $n2 = $v[2];
    $n3 = $v[3];
    $n4 = $v[4];

    $c2[] = $city;

    $s2['r'][] = $n2;
    $s2['na'][] = $n3;
    $s2['n'][] = $n4;

    $sumN1 += $n1;
    $sumN2 += $n2;
    $sumN3 += $n3;
    $sumN4 += $n4;
    $sumN5 += ($n3 + $n4);

     $table2->addRow();
     $table2->addCell()->addText($city, [], $textCenter);
     $table2->addCell()->addText($n1, [], $textCenter);
     $table2->addCell()->addText($n2, [], $textCenter);
     $table2->addCell()->addText($n3, [], $textCenter);
     $table2->addCell()->addText($n4, [], $textCenter);
     $table2->addCell()->addText($n3 + $n4, [], $textCenter);
  }

   $table2->addRow();
   $table2->addCell()->addText('Ukupno', $textBold, $textCenter);
   $table2->addCell()->addText($sumN1, $textBold, $textCenter);
   $table2->addCell()->addText($sumN2, $textBold, $textCenter);
   $table2->addCell()->addText($sumN3, $textBold, $textCenter);
   $table2->addCell()->addText($sumN4, $textBold, $textCenter);
   $table2->addCell()->addText($sumN5, $textBold, $textCenter);

   $section->addTextBreak();

   //Chart

   $styleChart2 = array(
     'width' => Converter::inchToEmu(6),
     'height' => Converter::inchToEmu(4),
     'title' => 'Ocitanost brojila po ispostavama',
     'showAxisLabels' => true,
     'dataLabelOptions' => array(
       'showCatName' => false
     )
   );

   $chart2 = $section->addChart('column', $c2, $s2['r'], $styleChart2, 'Broj ocitanih brojila');
   $chart2->addSeries($c2, $s2['na'], 'Broj neocitanih - nepristupacnih brojila');
   $chart2->addSeries($c2, $s2['n'], 'Broj neocitanih brojila');



  $section->addPageBreak();

  // End Page 2

  $fileName = 'report-tcom';

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
