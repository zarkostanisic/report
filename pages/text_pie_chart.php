<?php
  use PhpOffice\PhpWord\Shared\Converter;

  $result = $conn->query("
    SELECT c.id, c.name, c.address, c.serial, r.expensive_new, r.expensive_old, r.cheap_new, r.cheap_old
    FROM reports r
    INNER JOIN customers c ON r.customer_id = c.id
    WHERE r.customer_id='" . $customer_id . "'
    ORDER BY CONCAT(year, '-', month, '-01') DESC
    LIMIT 1
  ");

  if($result->num_rows  == '0') die('Customer does not exist');

  $customer = $result->fetch_object();

  $name = $customer->name;
  $address = $customer->address;
  $expensive = $customer->expensive_new - $customer->expensive_old;
  $cheap = $customer->cheap_new - $customer->cheap_old;
  $consumed = $expensive + $cheap;
  $serial = $customer->serial;

  // title
  $section->addTitle('Last month', 1);

  // Text
  $section->addText('Customer id: ' . $customer->id);
  $section->addText('Serial: ' . $serial);
  $section->addText('Name: ' . $name);
  $section->addText('Address: ' . $address);
  $section->addText('Consumed ' . $consumed . ' kW last month. Expensive ' . $expensive . ' kW and cheap ' . $cheap . ' kW.');
  $section->addText("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
  $section->addText("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");

  $section->addTextBreak();

  // Pie chart
  $c3 = array('Expensive kW', 'Cheap kW');
  $s3 = array($expensive, $cheap);

  $tablePie2Charts = $section->addTable('Chart');
  $tablePie2Charts->addRow();

  $stylePie2Chart = array(
    'width' => Converter::inchToEmu(5),
    'height' => Converter::inchToEmu(4),
    'valueAxisTitle' => 'Last month consumed in kW',
    'showLegend' => true,
    'title' => '#last-month-pie',
    'dataLabelOptions' => array(
      'showCatName' => false,
      'showVal' => false,
      'showPercent' => true
    )
  );

  $c1 = $tablePie2Charts->addCell()->addChart('pie', $c3, $s3, $stylePie2Chart);

  $section->addPageBreak();
 ?>
