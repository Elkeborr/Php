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

    public static function delete($id)
    {
        $conn = Db::getInstance();

        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $user_id1 = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('DELETE FROM followers WHERE user_id1= :user_id1 AND user_id2=:user_id2');
        $statement->bindValue(':user_id1', $user_id1);
        $statement->bindValue(':user_id2', $id);

        return $statement->execute();
    }

    public static function detailPaginaFollowers($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT * FROM followers WHERE followers.user_id2=:id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $detailFollowers = $statement->fetchAll();

        return $detailFollowers;
    }

    public static function detailPaginaFollow($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT * FROM followers WHERE followers.user_id1=:id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $detailFollow = $statement->fetchAll();

        return $detailFollow;
    }

    public static function checkFollow($id)
    {
        $conn = Db::getInstance();

        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $user_id1 = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('SELECT * FROM followers WHERE followers.user_id1=:id1 AND followers.user_id2=:id2');
        $statement->bindParam(':id1', $user_id1);
        $statement->bindParam(':id2', $id);
        $statement->execute();
        $check = $statement->fetch();

        if ($check) {
            return  true;
        } else {
            return  false;
        }
    }
}
