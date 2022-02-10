<?php
require __DIR__ . '/plugins/escpos/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

date_default_timezone_set("Asia/Bangkok");

try {
    //$connector = new WindowsPrintConnector("WebPrint");
    $connector = new NetworkPrintConnector("172.16.43.142", 9100);
    $printer = new Printer($connector);

    $currentTime = date('d-M-Y H:i:s A');
    $qNumber = $_GET['qNumber'];

    /* header */
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_FONT_A);
    $printer->text("Savan Resorts Queue\n");
    $printer -> setUnderline(true);
    $printer->selectPrintMode();
    $printer->feed();

    /* body */
    $printer->setTextSize(8, 8);
    $printer->bold(1);
    $printer->text($qNumber);
    $printer->text("\n");
    $printer->feed();

    /* Footer */
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1, 1);
    $printer->text($currentTime);
    $printer->feed(2);
    $printer->text("Thank you\n");

    $printer->cut();
    $printer->close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}
