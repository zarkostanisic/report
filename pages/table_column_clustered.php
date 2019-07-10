<?php
  use PhpOffice\PhpWord\Shared\Converter;

  $reports = $conn->query("
    SELECT r.*, o.name AS operater
    FROM reports r
    INNER JOIN operaters o ON r.operater_id = o.id
    WHERE customer_id = '" . $customer_id . "' AND CONCAT(year, '-', month, '-01') > NOW() - INTERVAL 1 YEAR
    ORDER BY CONCAT(r.year, '-', r.month, '-01') DESC
");

  // title
  $section->addTitle('Last year', 1);
  $section->addTitle('Table', 2);

  // Table

  // Table - head
  $cellFirstRowStyle = array('gridSpan' => 3, 'borderSize' => 6);
  $table = $section->addTable('Report');
  $table->addRow();
  $table->addCell(3000, $cellFirstRowStyle)->addText('Expensive');
  $table->addCell(3000, $cellFirstRowStyle)->addText('Cheap');
  $table->addCell(3000, $cellFirstRowStyle)->addText('');
  $table->addRow();

  $cellSecondRowStyle = array('bgColor' => 'DDDDDD', 'borderSize' => 6);

  $table->addCell(null, $cellSecondRowStyle)->addText('New');
  $table->addCell(null, $cellSecondRowStyle)->addText('Old');
  $table->addCell(null, $cellSecondRowStyle)->addText('Consumed');
  $table->addCell(null, $cellSecondRowStyle)->addText('New');
  $table->addCell(null, $cellSecondRowStyle)->addText('Old');
  $table->addCell(null, $cellSecondRowStyle)->addText('Consumed');
  $table->addCell(null, $cellSecondRowStyle)->addText('Sum');
  $table->addCell(900, $cellSecondRowStyle)->addText('Period');
  $table->addCell(900, $cellSecondRowStyle)->addText('Operater');

  // Table - body
  $sumExpensive = 0;
  $sumCheap = 0;
  $total = 0;
  $c4 = array();
  $s4 = array();

  while($row = $reports->fetch_object()){
    $expensive = $row->expensive_new - $row->expensive_old;
    $cheap = $row->cheap_new - $row->cheap_old;
    $sum = $expensive + $cheap;

    $sumExpensive += $expensive;
    $sumCheap += $cheap;

    // Data for column clustered chart
    $period = $row->year . '-' . $row->month;
    $c4[] = $period;
    $s4['expensive'][] = $expensive;
    $s4['cheap'][] = $cheap;

    $table->addRow();
    $table->addCell()->addText($row->expensive_old);
    $table->addCell()->addText($row->expensive_new);
    $table->addCell()->addText($expensive);
    $table->addCell()->addText($row->cheap_old);
    $table->addCell()->addText($row->cheap_new);
    $table->addCell()->addText($cheap);
    $table->addCell()->addText($sum);
    $table->addCell()->addText($period);
    $table->addCell()->addText($row->operater);
  }

  $total += ($sumExpensive + $sumCheap);

  $table->addRow();
  $table->addCell(null, array('gridSpan' => 3))->addText('Expensive: ' . $sumExpensive);
  $table->addCell(null, array('gridSpan' => 3))->addText('Cheap: ' . $sumCheap);
  $table->addCell(null, array('gridSpan' => 3))->addText('Total: ' . $total);
  $section->addText(
    'Values are in kW',
    array('size' => 10),
    array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(10))
  );

  $section->addPageBreak();

  // title

  $title = $section->addTitle('Charts', 2);
  $title = $section->addTitle('Expensive, cheap per period in kW', 3);

  // Column clustered chart

  $styleColumnClustered = array(
    'title' => '#last-year-column-clustered',
    // 'showLegend' => true,
    'width' => Converter::inchToEmu(6),
    'height' => Converter::inchToEmu(4),
    'showAxisLabels' => true,
    'dataLabelOptions' => array(
      'showVal' => true,
      'showCatName' => false
    )
  );

  // Data for column clustered chart reversed
  $c4 = array_reverse($c4);
  $s4['expensive'] = array_reverse($s4['expensive']);
  $s4['cheap'] = array_reverse($s4['cheap']);

  $chartColumnClustered = $section->addChart('column', $c4, $s4['expensive'], $styleColumnClustered, 'Expensive');

  $chartColumnClustered->addSeries($c4, $s4['cheap'], 'Cheap');

  $section->addTextBreak();

  $section = $phpWord->addSection(array('breakType' => 'continuous'));

  $section->addPageBreak();
 ?>
