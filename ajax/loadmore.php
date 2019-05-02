<?php

require_once '../bootstrap.php';

if (!empty($_GET)) {
    try {
        $e = Post::getAll();
        if ($e == true) {
            $result = [
                    'status' => 'succes',
                    'message' => 'Hier zijn de afbeeldingen',
                    ];
        } else {
            $result = [
                    'status' => 'false',
                    'message' => 'Oepsie poepsie',
                    ];
        }
    } catch (Throwable $t) {
        $result = [
            'status' => 'error',
            'message' => 'er is iet fout gelopen',
            ];
    }

    echo json_encode($result);
}
