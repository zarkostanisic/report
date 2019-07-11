<?php
  use PhpOffice\PhpWord\Shared\Converter;

  // Charts
  $section = $phpWord->addSection(array('colsNum' => 2, 'breakType' => 'continuous'));

  // Column chart

  $c1 = array('Expensive', 'Cheap');
  $s1 = array($sumExpensive, $sumCheap);

  $styleColumnChart = array(
    'title' => '#last-year-bar',
    'width' => Converter::inchToEmu(3),
    'height' => Converter::inchToEmu(2.5),
    'showAxisLabels' => true,
    'valueAxisTitle' => 'kw',
    'dataLabelOptions' => array(
      'showCatName' => false
    )
  );

  $section->addChart('column', $c1, $s1, $styleColumnChart);

  $section->addTextBreak();

  // Pie chart

  $result = $conn->query("
    SELECT SUM((expensive_new - expensive_old) + (cheap_new - cheap_old)) as sum, CONCAT(year, '-', month) AS period
    FROM reports
    WHERE customer_id='" . $customer_id . "' AND CONCAT(year, '-', month, '-01') > NOW() - INTERVAL 1 YEAR
    GROUP BY CONCAT(year, '-', month, '-01')
    ORDER BY CONCAT(year, '-', month, '-01') DESC
  ");

  $c2 = array();
  $s2 = array();
  while($row = $result->fetch_object()){
    $c2[] = $row->period;
    $s2[] = $row->sum;
  }

  $stylePieChart = array(
    'width' => Converter::inchToEmu(3),
    'height' => Converter::inchToEmu(2.5),
    '3d' => true,
    'title' => '#last-year-pie-3d',
    'showLegend' => true,
    'dataLabelOptions' => array(
      'showVal' => false,
      'showPercent' => true,
      'showCatName' => false
    )
  );

  $section->addChart('pie', $c2, $s2, $stylePieChart);

  $section->addTextBreak();

  $section = $phpWord->addSection(array('breakType' => 'continuous'));

 ?>
