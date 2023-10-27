<?php
require './vendor/autoload.php';

/*
 * Sheet cannot be read if '_rels/.rels' file exists
 */
mkdir('_rels');
touch('_rels/.rels');
try {
    $spreadsheet = (new \PhpOffice\PhpSpreadsheet\Reader\Xlsx())->load("test3.xlsx");
    echo $spreadsheet->getSheetCount(); // => 0  <-- expected 1
} finally {
    if (file_exists('_rels/.rels')) unlink('_rels/.rels');
    if (file_exists('_rels')) rmdir('_rels');
}
