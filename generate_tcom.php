<?php

  function percentage($value, $total){
    return round(($value * 100) / $total, 2);
  }

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

  $cellValign = array('valign' => 'center');

  // Page 1
  $section = $phpWord->addSection();

  // Title
  $section->addTitle('Broj brojila i citaca po ispostavama', 2);
  $section->addTextBreak();

  // Table
   $table1 = $section->addTable('Table');
   $table1->addRow();
   $table1->addCell(null, $cellValign)->addText('Ispostava', [], $textCenter);
   $table1->addCell(null, $cellValign)->addText('Broj citaca', [], $textCenter);
   $table1->addCell(null, $cellValign)->addText('Broj brojila', [], $textCenter);
   $table1->addCell(null, $cellValign)->addText('Prosecno brojila po citacu', [], $textCenter);

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
     $table1->addCell(null, $cellValign)->addText($city, [], $textCenter);
     $table1->addCell(null, $cellValign)->addText($n1, [], $textCenter);
     $table1->addCell(null, $cellValign)->addText($n2, [], $textCenter);
     $table1->addCell(null, $cellValign)->addText($n3, [], $textCenter);
  }

   $table1->addRow();
   $table1->addCell(null, $cellValign)->addText('Ukupno', $textBold, $textCenter);
   $table1->addCell(null, $cellValign)->addText($sumN1, $textBold, $textCenter);
   $table1->addCell(null, $cellValign)->addText($sumN2, $textBold, $textCenter);
   $table1->addCell(null, $cellValign)->addText(($sumN3 / $count), $textBold, $textCenter);

  $section->addTextBreak();

  // Chart 1

  $styleChart1 = array(
    'width' => Converter::inchToEmu(6),
    'height' => Converter::inchToEmu(4),
    'title' => 'Broj citaca po ispostavama',
    'showLegend' => true,
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
   $table2->addCell(null, $cellValign)->addText('Ispostava', [], $textCenter);
   $table2->addCell(null, $cellValign)->addText('Ukupno dodeljeno brojila', [], $textCenter);
   $table2->addCell(null, $cellValign)->addText('Broj ocitanih brojila', [], $textCenter);
   $table2->addCell(null, $cellValign)->addText('Broj neocitanih - nepristupacnih brojila', [], $textCenter);
   $table2->addCell(null, $cellValign)->addText('Broj neocitanih brojila', [], $textCenter);
   $table2->addCell(null, $cellValign)->addText('Ukupno neocitanih brojila', [], $textCenter);

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
     $table2->addCell(null, $cellValign)->addText($city, [], $textCenter);
     $table2->addCell(null, $cellValign)->addText($n1, [], $textCenter);
     $table2->addCell(null, $cellValign)->addText($n2, [], $textCenter);
     $table2->addCell(null, $cellValign)->addText($n3, [], $textCenter);
     $table2->addCell(null, $cellValign)->addText($n4, [], $textCenter);
     $table2->addCell(null, $cellValign)->addText($n3 + $n4, [], $textCenter);
  }

   $table2->addRow();
   $table2->addCell(null, $cellValign)->addText('Ukupno', $textBold, $textCenter);
   $table2->addCell(null, $cellValign)->addText($sumN1, $textBold, $textCenter);
   $table2->addCell(null, $cellValign)->addText($sumN2, $textBold, $textCenter);
   $table2->addCell(null, $cellValign)->addText($sumN3, $textBold, $textCenter);
   $table2->addCell(null, $cellValign)->addText($sumN4, $textBold, $textCenter);
   $table2->addCell(null, $cellValign)->addText($sumN5, $textBold, $textCenter);

   $section->addTextBreak();

   // Chart 2

   $styleChart2 = array(
     'width' => Converter::inchToEmu(6),
     'height' => Converter::inchToEmu(4),
     'title' => 'Ocitanost brojila po ispostavama',
     'showAxisLabels' => true,
     'showLegend' => true,
     'dataLabelOptions' => array(
       'showCatName' => false
     )
   );

   $chart2 = $section->addChart('column', $c2, $s2['r'], $styleChart2, 'Broj ocitanih brojila');
   $chart2->addSeries($c2, $s2['na'], 'Broj neocitanih - nepristupacnih brojila');
   $chart2->addSeries($c2, $s2['n'], 'Broj neocitanih brojila');



  $section->addPageBreak();

  // End Page 2

  // Page 3

  // Table

  $table3Values = array(213, 211, 2, 90563, 83266, 3868, 3429);
  $sumN = $table3Values[5] + $table3Values[6];

  $table3 = $section->addTable('Table');
  $table3->addRow();
  $table3->addCell(null, $cellValign)->addText('Ukupno dodeljenih citackih listi', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('Ocitanih ciackih listi', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('Neocitahih citackih listi', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('Ukupno dodeljenih brojila', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('Ocitana brojila', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('Neocitana - Nepristupacna brojila', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('Neocitana brojila', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('Ukupno neocitanih brojila', [], $textCenter);
  $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);

  $table3->addRow();
  $table3->addCell(null, $cellValign)->addText($table3Values[0], [], $textCenter);
  $table3->addCell(null, $cellValign)->addText($table3Values[1], [], $textCenter);
  $table3->addCell(null, $cellValign)->addText($table3Values[2], [], $textCenter);
  $table3->addCell(null, $cellValign)->addText($table3Values[3], [], $textCenter);
  $table3->addCell(null, $cellValign)->addText($table3Values[4], [], $textCenter);
  $table3->addCell(null, $cellValign)->addText(percentage($table3Values[4], $table3Values[3]), [], $textCenter);
  $table3->addCell(null, $cellValign)->addText($table3Values[5], [], $textCenter);
  $table3->addCell(null, $cellValign)->addText(percentage($table3Values[5], $table3Values[3]), [], $textCenter);
  $table3->addCell(null, $cellValign)->addText($table3Values[6], [], $textCenter);
  $table3->addCell(null, $cellValign)->addText(percentage($table3Values[6], $table3Values[3]), [], $textCenter);
  $table3->addCell(null, $cellValign)->addText($sumN, [], $textCenter);
  $table3->addCell(null, $cellValign)->addText(percentage($sumN, $table3Values[3]), [], $textCenter);

  $section->addTextBreak();

  // Chart 3
  $section = $phpWord->addSection(array('colsNum' => 2, 'breakType' => 'continuous'));

  $c3 = array('Ocitanih citackih listi', 'Neocitanih citackih listi');
  $s3 = array($table3Values[1], $table3Values[2]);

  $styleChart3 = array(
    'width' => Converter::inchToEmu(3),
    'height' => Converter::inchToEmu(2.5),
    '3d' => true,
    'title' => 'Pregled ocitanih listi',
    'showLegend' => true,
    'dataLabelOptions' => array(
      'showCatName' => false
    )
  );

  $section->addChart('pie', $c3, $s3, $styleChart3);

  $section->addTextBreak();

  $c4 = array('Ocitana brojila', 'Ukupno neocitanih brojila');
  $s4 = array($table3Values[4], $sumN);

  // Chart 4
  $styleChart4 = array(
    'width' => Converter::inchToEmu(2.8),
    'height' => Converter::inchToEmu(2.5),
    '3d' => true,
    'title' => 'Pregled ocitanih brojila',
    'showLegend' => true,
    'dataLabelOptions' => array(
      'showCatName' => false
    )
  );

  $section->addChart('pie', $c4, $s4, $styleChart4);

  $section->addTextBreak();

  $section = $phpWord->addSection(array('breakType' => 'continuous'));

  // Chart 5
  $c5 = array(
    '05.00-06.00', '06.00-07.00', '07.00-08.00', '08.00-09.00',
    '09.00-10.00', '10.00-11.00', '11.00-12.00', '12.00-13.00',
    '13.00-14.00', '14.00-5.00', '15.00-16.00', '16.00-17.00',
    '17.00-18.00', '18.00-19.00', '19.00-20.00', '20.00-21.00',
    '21.00-22.00', '22.00-23.00', '23.00-00.00', '00.00-01.00',
    '01.00-02.00', '02.00-03.00', '03.00-04.00', '04.00-05.00',
  );
  $s5 = array(56, 406, 938, 1557, 1950, 2075, 1927, 2268, 2025, 1539, 1513, 1817, 1822, 1945, 1463, 682, 265, 107, 39, 0, 0, 0, 0, 3);

  $styleChart5 = array(
    'width' => Converter::inchToEmu(6.5),
    'height' => Converter::inchToEmu(4),
    'title' => 'Broj citanja u odredjenom vremenskom intervalu - 01.07.2019',
    'showAxisLabels' => true,
    'showLegend' => false,
    'dataLabelOptions' => array(
      'showCatName' => false
    )
  );

  $section->addChart('column', $c5, $s5, $styleChart5);

  $section->addTextBreak();

  $section->addPageBreak();

  // End Page 3

  // Page 4

  // Chart 6
  $c6 = array(
    '01.07.2019.', '02.07.2019.', '03.07.2019.', '04.07.2019.',
    '05.07.2019.', '07.07.2019.', '07.07.2019.'
  );
  $s6 = array(24397, 21080, 18239, 12789, 7898, 2701, 30);

  $styleChart6 = array(
    'width' => Converter::inchToEmu(6.5),
    'height' => Converter::inchToEmu(4),
    'showAxisLabels' => true,
    'title' => '#no-title',
    'showLegend' => false,
    'dataLabelOptions' => array(
      'showCatName' => false,
    )
  );

  $section->addChart('column', $c6, $s6, $styleChart6);

  $section->addTextBreak();

  // Chart 7
  $chart7Values = array(
    array('01.07.2019.', 11761, 7123, 5513),
    array('02.07.2019.', 10283, 6212, 4585),
    array('03.07.2019.', 9264, 4933, 4042),
    array('04.07.2019.', 5763, 4041, 2985),
    array('05.07.2019.', 4264, 1369, 1905),
    array('06.07.2019.', 1769, 697, 235),
    array('07.07.2019.', 29, 0, 1)
  );

  $c7 = array();
  $s7 = array();

  $cities = array('Smederevo', 'Smederevska Palanka', 'Velika Plana');

  foreach($chart7Values as $v){
     $c7[] = $v[0];

     $s7[0][] = $v[1];
     $s7[1][] = $v[2];
     $s7[2][] = $v[3];
  }

  $styleChart7 = array(
    'width' => Converter::inchToEmu(6.5),
    'height' => Converter::inchToEmu(4),
    'title' => 'Broj citanja po ispostavi po danima',
    'showAxisLabels' => true,
    'showLegend' => true,
    'dataLabelOptions' => array(
      'showCatName' => false,
      'showVal' => false
    )
  );

  $chart7 = $section->addChart('column', $c7, $s7[0], $styleChart7, $cities[0]);
  $chart7->addSeries($c7, $s7[1], $cities[1]);
  $chart7->addSeries($c7, $s7[2], $cities[2]);

  // End Page 4

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
