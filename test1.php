<?php
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#write-a-date-or-time-into-a-cell
// https://phpspreadsheet.readthedocs.io/en/latest/topics/accessing-cells/#beware-cells-assigned-to-variables-as-a-detached-reference

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getCell('A1')->setValue('a')->getStyle()->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
$sheet->getCell('B1')->setValue('b');

echo "---- foreach ----\n";
foreach ($sheet->getRowIterator()->current()->getCellIterator() as $cell) {
    printf("%s\t%s\n", $cell->getValue(), $cell->getStyle()->getNumberFormat()->getFormatCode());
}

echo "---- EnumeratesValues::each ----\n";
collect($sheet->getRowIterator()->current()->getCellIterator())->each(function (Cell $cell) {
    printf("%s\t%s\n", $cell->getValue(), $cell->getStyle()->getNumberFormat()->getFormatCode());
});

// $php test1.php
// ---- foreach ----
// a	yyyy-mm-dd
// b	General
// ---- EnumeratesValues::each ----
// a	General        <-- expected 'yyyy-mm-dd'
// b	General
