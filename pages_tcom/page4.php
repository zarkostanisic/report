<?php
  use PhpOffice\PhpWord\Shared\Converter;
  use App\Table;
  use App\Chart;

  $section = $phpWord->addSection(array('breakType' => 'continuous'));

  // Chart 6
  $c6 = array(
    '01.07.2019.', '02.07.2019.', '03.07.2019.', '04.07.2019.',
    '05.07.2019.', '07.07.2019.', '07.07.2019.'
  );
  $s6 = array(24397, 21080, 18239, 12789, 7898, 2701, 30);

  // $styleChart6 = array(
  //   'width' => Converter::inchToEmu(6.5),
  //   'height' => Converter::inchToEmu(4),
  //   'showAxisLabels' => true,
  //   'showLegend' => false,
  //   'dataLabelOptions' => array(
  //     'showCatName' => false
  //   )
  // );
  //
  // $section->addChart('column', $c6, $s6, $styleChart6);

  $chart = new Chart('', Converter::inchToEmu(6.5), Converter::inchToEmu(4), false, false, true);
  $chart->column($c6, $s6);

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

  // $styleChart7 = array(
  //   'width' => Converter::inchToEmu(6.5),
  //   'height' => Converter::inchToEmu(4),
  //   'title' => 'Broj citanja po ispostavi po danima',
  //   'showAxisLabels' => true,
  //   'showLegend' => true,
  //   'dataLabelOptions' => array(
  //     'showCatName' => false,
  //     'showVal' => false,
  //   )
  // );
  //
  // $chart7 = $section->addChart('column', $c7, $s7[0], $styleChart7, $cities[0]);
  // $chart7->addSeries($c7, $s7[1], $cities[1]);
  // $chart7->addSeries($c7, $s7[2], $cities[2]);

  $chart7 = new Chart('Broj citanja po ispostavi po danima', Converter::inchToEmu(6.5), Converter::inchToEmu(4), false, true, true, false);
  $chart7->columnClustered($c7, $s7, $cities);
 ?>
