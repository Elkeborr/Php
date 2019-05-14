<?php

if (!empty($_POST)) {
    $user_id2 = $_POST['user_id2'];

    include_once '../bootstrap.php';

    try {
        $f = new Follow();
        $f->setUser_id2($user_id2);
        $f->save();
        var_dump($f);

        $result = [
        'status' => 'success',
        'message' => 'Follow had been saved👌🏼',
    ];
    } catch (Throwable $t) {
        $result = [
        'status' => 'error',
        'message' => 'Something went wrong 😭',
        ];
    }

    // antwoord geven aan js frontend
    //  kan geen arrays echoen => encoderen als json
    echo json_encode($result);
}
