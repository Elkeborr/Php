<?php
    require_once '../bootstrap.php';

    if (!empty($_POST)) {
        $postId = $_POST['postId'];
        $userId = $_SESSION['users'][0];

        $l = new Like();
        $l->setPostId($postId);
        $l->setUserId($userId);
        $liked = $l->checkLike();

        if ($liked == 'liked') {
            $result = [
                'status' => 'liked',
                'message' => 'Like was saved',
            ];
        } elseif ($liked == 'unliked') {
            $result = [
                'status' => 'unliked',
                'message' => 'Like was deleted',
            ];
        }

        echo json_encode($result);
    }