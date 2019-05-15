<?php

include_once '../bootstrap.php';

if (!empty($_POST)) {
    $user_id2 = $_POST['user_id2'];
    $check = Follow::checkFollow($user_id2);
    if ($check == false) {
        try {
            $f = new Follow();
            $f->setUser_id2($user_id2);
            $f->save();

            $result = [
                'status' => 'successfollow',
                'message' => 'Follow had been saved👌🏼',
            ];
        } catch (Throwable $t) {
            $result = [
                'status' => 'error',
                'message' => 'Something went wrong ',
                ];
        }

        echo json_encode($result);
    } else {
        try {
            Follow::delete($user_id2);
            var_dump(Follow::delete($user_id2));
            $result = [
                'status' => 'successunfollow',
                'message' => 'Unfollowd',
            ];
        } catch (Throwable $t) {
            $result = [
                'status' => 'error',
                'message' => 'Something went wrong 😭',
                ];
        }
        echo json_encode($result);
    }
}
