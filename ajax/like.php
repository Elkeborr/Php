<?php
    // ajax/like.php
    if (!empty($_POST)) {
        $postId = $_POST['postid'];
        $userId =$_POST['userId'];

        require_once '../bootstrap.php';
        $l = new Like();
        $l->setPostId($postid);
        $l->setUserId($userId);
        $l->save();

        // JSON
        $result = [
            'status' => 'success',
            'message' => 'Like has been saved.',
        ];

        echo json_encode($result);
    }
