<?php
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$spreadsheet = new Spreadsheet();
Calculation::getInstance($spreadsheet)->disableCalculationCache();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', "year");
$sheet->setCellValue('A2', "2023");

$sheet->setCellValue('B2', '="RC[" & MATCH("year", $1:$1, 0) - COLUMN() & "]"');
echo $sheet->getCell('B2')->getValue() . "\n";
echo $sheet->getCell('B2')->getCalculatedValue() . "\n"; // => 'RC[-1]'

$sheet->setCellValue('B2', '=INDIRECT("RC[-1]", false)');
echo $sheet->getCell('B2')->getValue() . "\n";
echo $sheet->getCell('B2')->getCalculatedValue() . "\n"; // => '2023'

/*
 * |   | A    | B                                                              |
 * |---|------|----------------------------------------------------------------|
 * | 1 | year |                                                                |
 * | 2 | 2023 | =INDIRECT("RC[" & MATCH("year", $1:$1, 0) - COLUMN() & "]", 0) |
 */
$sheet->setCellValue('B2', '=INDIRECT("RC[" & MATCH("year", $1:$1, 0) - COLUMN() & "]", false)');
echo $sheet->getCell('B2')->getValue() . "\n";
echo $sheet->getCell('B2')->getCalculatedValue() . "\n"; // => #REF!  <-- expected '2023'
