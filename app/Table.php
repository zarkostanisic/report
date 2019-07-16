<?php
  namespace App;
  
  class Table{
    private $style = array(
      'cellMarginLeft' => 50,
      'cellMarginRight' => 50,
      'cellMarginTop' => 20,
      'cellMarginBottom' => 20,
      'borderSize' => 1,
      'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER
    );

    private $vAlign = array('valign' => 'center');
    private $center = array('align' => 'center', 'spaceAfter' => 0);
    private $bold = array('bold'=> true);

    public function __construct($rows){
      global $section;
      global $phpWord;

      $phpWord->addTableStyle('Table', $this->style);

      $table = $section->addTable('Table');

      foreach($rows as $row){
        $table->addRow();

        foreach($row as $cell){
          if(is_array($cell) && $cell['bold'] == true){
            $table->addCell(null, $this->vAlign)->addText($cell['value'], $this->bold, $this->center);
          }else{
            $table->addCell(null, $this->vAlign)->addText($cell, [], $this->center);
          }
        }
      }
    }
  }
 ?>
