<?php

require_once '../bootstrap.php';

if (!empty($_POST)) {
    $text = htmlspecialchars($_POST['text']);

    try {
        $e = User::EmailAvailable($text);
        if (filter_var($text, FILTER_VALIDATE_EMAIL)) {
            if ($e == false) {
                $result = [
                    'status' => 'copy',
                    'message' => 'Email exist',
                    ];
            } else {
                $result = [
                    'status' => 'success',
                    'message' => "Email is an email & doesn't exist",
                    ];
            }
        } else {
            $result = [
                'status' => 'mistake',
                'message' => "Email isn't a email",
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
