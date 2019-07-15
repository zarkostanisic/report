<?php
  use PhpOffice\PhpWord\Shared\Converter;

  $section = $phpWord->addSection($sectionAutoFit);

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

   $section = $phpWord->addSection(array('breakType' => 'continuous'));

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
 ?>
