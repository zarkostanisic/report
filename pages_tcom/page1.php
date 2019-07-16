<?php
  use PhpOffice\PhpWord\Shared\Converter;

  $section = $phpWord->addSection($sectionAutoFit);

  // Title
  $section->addTitle('Broj brojila i citaca po ispostavama', 2);
  $section->addTextBreak();

  // Table

   // $table1 = $section->addTable('Table');
   // $table1->addRow();
   // $table1->addCell(null, $cellValign)->addText('Ispostava', [], $textCenter);
   // $table1->addCell(null, $cellValign)->addText('Broj citaca', [], $textCenter);
   // $table1->addCell(null, $cellValign)->addText('Broj brojila', [], $textCenter);
   // $table1->addCell(null, $cellValign)->addText('Prosecno brojila po citacu', [], $textCenter);

   $table1Values = array(
    array('Smederevo', 55, 44017, 800.31),
    array('Smederevska Palanka', 49, 26373, 538.22),
    array('Velika Plana', 30, 20173, 672.43)
  );

  $sumN1 = 0;
  $sumN2 = 0;
  $sumN3 = 0;

  $section = $phpWord->addSection(array('breakType' => 'continuous'));
  // Data for chart
  $c1 = array();
  $s1 = array();

  $count = 0;

  $rows = [];
  $rows[] = ['Ispostava', 'Broj citaca', 'Broj brojila', 'Prosecno brojila po citacu'];

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

     // $table1->addRow();
     // $table1->addCell(null, $cellValign)->addText($city, [], $textCenter);
     // $table1->addCell(null, $cellValign)->addText($n1, [], $textCenter);
     // $table1->addCell(null, $cellValign)->addText($n2, [], $textCenter);
     // $table1->addCell(null, $cellValign)->addText($n3, [], $textCenter);
     $rows[] = [$city, $n1, $n2, $n3];
  }

   // $table1->addRow();
   // $table1->addCell(null, $cellValign)->addText('Ukupno', $textBold, $textCenter);
   // $table1->addCell(null, $cellValign)->addText($sumN1, $textBold, $textCenter);
   // $table1->addCell(null, $cellValign)->addText($sumN2, $textBold, $textCenter);
   // $table1->addCell(null, $cellValign)->addText(($sumN3 / $count), $textBold, $textCenter);

   $rows[] = [
     ['value' => 'Ukupno', 'bold' => true],
     ['value' => $sumN1, 'bold' => true],
     ['value' => $sumN2, 'bold' => true],
     ['value' => $sumN3 / $count, 'bold' => true],
   ];

  $table1 = new Table($rows);
  $section->addTextBreak();

  // Chart 1

  // $styleChart1 = array(
  //   'width' => Converter::inchToEmu(6),
  //   'height' => Converter::inchToEmu(4),
  //   'title' => 'Broj citaca po ispostavama',
  //   'showLegend' => true,
  //   'showAxisLabels' => true,
  //   'dataLabelOptions' => array(
  //     'showCatName' => false
  //   )
  // );
  //
  // $chart1 = $section->addChart('column', $c1, $s1, $styleChart1, 'Broj citaca');

  $chart1 = new Chart('Broj citaca po ispostavama', Converter::inchToEmu(6.5), Converter::inchToEmu(4), false, true, true);
  $chart1->column($c1, $s1, 'Broj citaca');

  $section->addPageBreak();
 ?>
