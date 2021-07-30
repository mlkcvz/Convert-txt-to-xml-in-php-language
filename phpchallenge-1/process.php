<?php
$sonuc = file_exists('input/input.txt');
//echo $sonuc;
if ($sonuc == 1) {
    //echo 'Dosyada dizin var';
    $read = fopen("input/input.txt", "r");
    //unset($read[1]);

    $lines = file(__DIR__ . '/input/input.txt', FILE_IGNORE_NEW_LINES);

    $dizi = explode(";", $lines[0]);

    $dizi2 = explode(";", $lines[1]);


//print_r($lines);

    $xml_ = new XMLWriter();
    $xml_->openUri(__DIR__ . '/output/output.xml');
    $xml_->setIndent(true);
    $xml_->startDocument('1.0');
    $xml_->startElement('order');
    $xml_->startElement('header');

    for ($i = 0; $i < count($dizi); $i++) {
        $xml_->writeElement($dizi[$i], $dizi2[$i]);
    }
    $xml_->endElement();//header

    $dizi3 = explode(";", $lines[2]);
    $xml_->startElement('lines');
    for ($i = 3; $i < count($lines); $i++) {

        $xml_->startElement('line');

        $details = explode(";", $lines[$i]);

        for ($j = 0; $j < 8; $j++) {


                $xml_->writeElement($dizi3[$j], $details[$j]);


        }
        $xml_->endElement();//line

    }
    $xml_->endElement();//lines
    $xml_->endElement();//order
    exit;
}
else {
    echo 'Dosyada dizin yok,processi bitir';
    exit();
}


//$xmldata = "output.xml";
//touch($xmldata);
//$document->save('output.xml');
//fclose($dizi);


# input dizinin içerisinde dosya var mı bak, yoksa process i bitir

# input dizininindeki her dosyayı tek tek bir döngü halinde oku

# dosya 0 : read
# boş xml oluştur
# header title & header value -> merge

# xml -> \order\header altındaki tüm keyleri yaz [xpath]

# detail title & detail value -> merge / 3 ve sonraki her satır için

# xml -> \order\lines altındaki her bir line ı yaz

# xml'i output dizinine yaz

