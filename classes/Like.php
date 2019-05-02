<?php

//namespace phpProject;

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

    public function save()
    {
        // @todo: hook in a new function that checks if a user has already liked a post

        $conn = Db::getInstance();
        $statement = $conn->prepare('insert into likes (post_id, user_id, date_created) values (:postid, :userid, NOW())');
        $statement->bindValue(':postid', $this->getPostId());
        $statement->bindValue(':userid', $this->getUserId());

        return $statement->execute();
    }
}
