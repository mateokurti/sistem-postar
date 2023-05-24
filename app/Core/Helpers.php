<?php

namespace App\Core;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter; 
use Picqer\Barcode\BarcodeGeneratorPNG;

class Helpers
{
    public static function createQRCode($name, $content) {
        $qr = QrCode::create($content);
        $writer = new PngWriter();
        $filename = "assets/qr-codes/" . $name . ".png";
      
        if (!file_exists($filename)) {
          $writer->write($qr)->saveToFile($filename);
        }
      }
      
    public static function createBarcode($name, $content) {
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($content, $generator::TYPE_CODE_128, 3, 50);
        $filename = "assets/barcodes/" . $name . ".png";
        
        if (!file_exists($filename)) {
            file_put_contents($filename, $barcode);
        }
    }

    public static function hide($string) {
        $length = strlen($string);
        $hidden = substr($string, 0, 1);
        $hidden .= str_repeat('*', $length - 2);
        $hidden .= substr($string, $length - 1, 1);
        return $hidden;
    }
}