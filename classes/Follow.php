<?php

class Follow
{
    private $user_id1;
    private $user_id2;

    /**
     * Get the value of user_id1.
     */
    public function getUser_id1()
    {
        return $this->user_id1;
    }

    /**
     * Set the value of user_id1.
     *
     * @return self
     */
    public function setUser_id1($user_id1)
    {
        $this->user_id1 = $user_id1;

        return $this;
    }

    /**
     * Get the value of user_id2.
     */
    public function getUser_id2()
    {
        return $this->user_id2;
    }

    /**
     * Set the value of user_id2.
     *
     * @return self
     */
    public function setUser_id2($user_id2)
    {
        $this->user_id2 = $user_id2;

        return $this;
    }

    public function save()
    {
        // @todo: hook in a new function that checks if a user has already liked a post

        $conn = Db::getInstance();

        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $user_id1 = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('INSERT into followers (user_id1, user_id2) values (:user_id1, :user_id2)');
        // sql injectie wordt tegen gehouden (bindValue)
        $statement->bindValue(':user_id1', $user_id1);
        $statement->bindValue(':user_id2', $this->getUser_id2());

        return $statement->execute();
    }
}
