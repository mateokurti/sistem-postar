<?php

namespace App\Core;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter; 
use Picqer\Barcode\BarcodeGeneratorPNG;
use HTTP_Request2;
use HTTP_Request2_Exception;

class Helpers
{
    public static function createQRCode($name, $content) {
        $qr = QrCode::create($content);
        $writer = new PngWriter();
        $filename = "assets/qr-codes/" . $name . ".png";
      
        if (!file_exists($filename)) {
          $writer->write($qr)->saveToFile($filename);
        }
        return $filename;
      }
      
    public static function createBarcode($name, $content) {
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($content, $generator::TYPE_CODE_128, 3, 50);
        $filename = "assets/barcodes/" . $name . ".png";
        
        if (!file_exists($filename)) {
            file_put_contents($filename, $barcode);
        }
        return $filename;
    }

    public static function hide($string) {
        $length = strlen($string);
        $hidden = substr($string, 0, 1);
        $hidden .= str_repeat('*', $length - 2);
        $hidden .= substr($string, $length - 1, 1);
        return $hidden;
    }

    public static function calculateDistance($startAddress, $endAddress) {
        $apiKey = $_ENV['GOOGLE_API_KEY'];

        $request = new HTTP_Request2();
        $request->setUrl("https://maps.googleapis.com/maps/api/directions/json?origin=$startAddress&destination=$endAddress&alternatives=false&sensor=false&key=$apiKey");
        $request->setMethod(HTTP_Request2::METHOD_GET);
        $request->setConfig(array('follow_redirects' => TRUE));
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $data = json_decode($response->getBody(), true);
                return $data['routes'][0]['legs'][0]['distance']['value'] ?? 999999999;
            }
            else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public static function generateRandomString($numOfCharacters) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+{}|:<>?~';
        $randomString = '';
        for ($i = 0; $i < $numOfCharacters; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}