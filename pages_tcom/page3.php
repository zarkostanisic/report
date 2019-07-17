<?php
  use PhpOffice\PhpWord\Shared\Converter;
  use App\Table;
  use App\Chart;

  $section = $phpWord->addSection($sectionAutoFit);
  $section->addTitle('Pregled broja očitanih čitačkih listi i brojila', 2);

  // Table

  $table3Values = array(213, 211, 2, 90563, 83266, 3868, 3429);
  $sumN = $table3Values[5] + $table3Values[6];

  // $table3 = $section->addTable('Table');
  // $table3->addRow();
  // $table3->addCell(null, $cellValign)->addText('Ukupno dodeljenih citackih listi', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('Ocitanih ciackih listi', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('Neocitahih citackih listi', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('Ukupno dodeljenih brojila', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('Ocitana brojila', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('Neocitana - Nepristupacna brojila', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('Neocitana brojila', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('Ukupno neocitanih brojila', [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText('%', [], $textCenter);

  // $table3->addRow();
  // $table3->addCell(null, $cellValign)->addText($table3Values[0], [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText($table3Values[1], [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText($table3Values[2], [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText($table3Values[3], [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText($table3Values[4], [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText(percentage($table3Values[4], $table3Values[3]), [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText($table3Values[5], [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText(percentage($table3Values[5], $table3Values[3]), [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText($table3Values[6], [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText(percentage($table3Values[6], $table3Values[3]), [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText($sumN, [], $textCenter);
  // $table3->addCell(null, $cellValign)->addText(percentage($sumN, $table3Values[3]), [], $textCenter);

  $rows = [];
  $rows[] = [
    'Ukupno dodeljenih citackih listi', 'Ocitanih ciackih listi', 'Neocitahih citackih listi',
    'Ukupno dodeljenih brojila', 'Ocitana brojila', '%',
    'Neocitana - Nepristupacna brojila', '%', 'Neocitana brojila',
    '%', 'Ukupno neocitanih brojila', '%'
  ];

  $rows[] = [
    $table3Values[0], $table3Values[1], $table3Values[2],
    $table3Values[3], $table3Values[4], percentage($table3Values[4], $table3Values[3]),
    $table3Values[5], percentage($table3Values[5], $table3Values[3]), $table3Values[6],
    percentage($table3Values[6], $table3Values[3]), $sumN, percentage($sumN, $table3Values[3])
  ];

  $table3 = new Table($rows);

  $section->addTextBreak();

  // Chart 3
  $section = $phpWord->addSection(array('colsNum' => 2, 'breakType' => 'continuous'));

  $c3 = array('Ocitanih citackih listi', 'Neocitanih citackih listi');
  $s3 = array($table3Values[1], $table3Values[2]);

  // $styleChart3 = array(
  //   'width' => Converter::inchToEmu(3),
  //   'height' => Converter::inchToEmu(2.5),
  //   '3d' => true,
  //   'title' => 'Pregled ocitanih listi',
  //   'showLegend' => true,
  //   'dataLabelOptions' => array(
  //     'showCatName' => false,
  //   )
  // );
  //
  // $section->addChart('pie', $c3, $s3, $styleChart3);

  $chart3 = new Chart('Pregled ocitanih listi', Converter::inchToEmu(3), Converter::inchToEmu(2.5), true);
  $chart3->pie($c3, $s3);

  $section->addTextBreak();

  // Chart 4
  $c4 = array('Ocitana brojila', 'Ukupno neocitanih brojila');
  $s4 = array($table3Values[4], $sumN);
  // $styleChart4 = array(
  //   'width' => Converter::inchToEmu(2.88),
  //   'height' => Converter::inchToEmu(2.5),
  //   '3d' => true,
  //   'title' => 'Pregled ocitanih brojila',
  //   'showLegend' => true,
  //   'dataLabelOptions' => array(
  //     'showCatName' => false
  //   )
  // );
  //
  // $section->addChart('pie', $c4, $s4, $styleChart4);

  $chart4 = new Chart('Pregled ocitanih brojila', Converter::inchToEmu(3), Converter::inchToEmu(2.5), true);
  $chart4->pie($c4, $s4);

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

  // $styleChart5 = array(
  //   'width' => Converter::inchToEmu(6.5),
  //   'height' => Converter::inchToEmu(4),
  //   'title' => 'Broj citanja u odredjenom vremenskom intervalu - 01.07.2019',
  //   'showAxisLabels' => true,
  //   'showLegend' => false,
  //   'dataLabelOptions' => array(
  //     'showCatName' => false
  //   )
  // );
  //
  // $section->addChart('column', $c5, $s5, $styleChart5);

  $chart = new Chart('Broj citanja u odredjenom vremenskom intervalu - 01.07.2019', Converter::inchToEmu(6.5), Converter::inchToEmu(4), false, false, true);
  $chart->column($c5, $s5);

  $section->addTextBreak();

  $section->addPageBreak();
 ?>
