<?php



class Like
{
    private $postId;
    private $userId;

    /**
     * Get the value of postId.
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId.
     *
     * @return self
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the value of userId.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId.
     *
     * @return self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    private static function addLike()
    {
        $conn = db::getInstance();
        $query = "INSERT into likes (posts_id, users_id) values (:posts_id, :users_id)";
        $statement = $conn->prepare($query);
        $statement->bindValue(':posts_id', $this->getPostId());
        $statement->bindValue(':users_id', $this->getUserId());
        $statement->execute();
    }

    private static function deleteLike()
    {
        $conn = db::getInstance();
        $query = 'DELETE FROM likes WHERE posts_id = :posts_id AND users_id =:users_id';
        $statement = $conn->prepare($query);
        $statement->bindValue(':posts_id', $this->getPostId());
        $statement->bindValue(':users_id', $this->getUserId());
        $statement->execute();
    }

    public static function checkLike()
    {
        $conn = db::getInstance();
        $query = 'SELECT COUNT(*) FROM likes WHERE posts_id=:posts_id AND users_id=:users_id';
        $statement = $conn->prepare($query);
        $statement->bindValue(':posts_id', $this->getPostId());
        $statement->bindValue(':user_id', $this->getUserId());
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($result[0]['COUNT(*)'] == 0) {
            $this->addLike();

            return 'liked';
        } else {
            $this->deleteLike();

            return 'unliked';
        }

        return $result;
    }
}
