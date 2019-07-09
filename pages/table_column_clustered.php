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
  $section->addTitle('2. Last year', 1);
  $section->addTitle('2.1 Table', 2);

  // Table

  // Table - head
  $table = $section->addTable('Report');
  $table->addRow();
  $table->addCell()->addText('Expensive new kW');
  $table->addCell()->addText('Expensive old kW');
  $table->addCell()->addText('Expensive');
  $table->addCell()->addText('Cheap new kW');
  $table->addCell()->addText('Cheap old kW');
  $table->addCell()->addText('Cheap');
  $table->addCell()->addText('Sum kW');
  $table->addCell()->addText('Period');
  $table->addCell()->addText('Operater');

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
  $table->addCell()->addText('Expensive: ' . $sumExpensive . ' kw');
  $table->addCell()->addText('Cheap: ' . $sumCheap . ' kw');
  $table->addCell()->addText('Total: ' . $total . ' kw');
  $table->addCell(null);
  $table->addCell(null);
  $table->addCell(null);
  $table->addCell(null);
  $table->addCell(null);
  $table->addCell(null);

  $section->addPageBreak();

  // title

  $title = $section->addTitle('2.2 Charts', 2);

  // Column clustered chart

  $styleColumnClustered = array(
    'title' => 'last-year-column-clustered',
    // 'showLegend' => true,
    'width' => Converter::inchToEmu(6),
    'height' => Converter::inchToEmu(4),
    'showAxisLabels' => true,
    'dataLabelOptions' => array(
      'showVal' => true,
      'showCatName' => false
    )
  );

  echo "<br/>";

  $chartColumnClustered = $section->addChart('column', $c4, $s4['expensive'], $styleColumnClustered, 'Expensive');

  $chartColumnClustered->addSeries($c4, $s4['cheap'], 'Cheap');

  $section->addTextBreak();

  $section = $phpWord->addSection(array('breakType' => 'continuous'));

  $section->addPageBreak();
 ?>
