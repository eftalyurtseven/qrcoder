<?php

    /* QRCoder */
    require_once 'QRCoder.php';

    $karekod = new QRCoder();

    /*
        $karekod -> url('http://e-yurtseven.net');
        $karekod -> bookmark('Eftal Yurtseven', 'http://e-yurtseven.net');
        $karekod -> contact('Eftal Yurtseven', 'Isparta', '0551 259 1019', 'eftalyurtseven@gmail.com');
        $karekod -> wifi(null, 'eftal','123');

    */

    $karekod -> text('Hello QRCoder!');

    $karekod -> draw(200);



?>