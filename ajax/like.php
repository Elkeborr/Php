<?php
    // ajax/like.php
    if (!empty($_POST)) {
        $postId = $_POST['postId'];
        $userId =1;

        require_once '../bootstrap.php';
        $l = new Like();
        $l->setPostId($postId);
        $l->setUserId($userId);
        $l->save();

        // JSON
        $result = [
            'status' => 'success',
            'message' => 'Like has been saved.',
        ];

        echo json_encode($result);
    }
