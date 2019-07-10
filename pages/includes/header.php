<?php
  // Start page numbering from page 3
  $section = $phpWord->addSection(array('pageNumberingStart' => 3));

  $header = $section->addHeader();
  $header->addPreserveText('Report {DATE}');
 ?>
