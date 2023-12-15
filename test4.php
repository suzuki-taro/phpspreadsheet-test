<?php
require './vendor/autoload.php';

/*
 * cell format test
 */

function readValue(\PhpOffice\PhpSpreadsheet\Cell\Cell $cell)
{
    return $cell->isFormula() ? $cell->getOldCalculatedValue() : $cell->getValue();
}

$spreadsheet = (new \PhpOffice\PhpSpreadsheet\Reader\Xlsx())->load("test4.xlsx");

// General
var_dump(readValue($spreadsheet->getActiveSheet()->getCell('B2'))); // string(1) "A"
var_dump(readValue($spreadsheet->getActiveSheet()->getCell('C2'))); // int(1)
var_dump(readValue($spreadsheet->getActiveSheet()->getCell('D2'))); // double(2)

// Text
var_dump(readValue($spreadsheet->getActiveSheet()->getCell('B3'))); // string(1) "A"
var_dump(readValue($spreadsheet->getActiveSheet()->getCell('C3'))); // string(1) "1"
var_dump(readValue($spreadsheet->getActiveSheet()->getCell('D3'))); // string(4) "=1+1"
