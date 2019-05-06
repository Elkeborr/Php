<?php

//namespace phpProject;

class Post
{
    private $image;
    private $image_text;

    /**
     * Get the value of image.
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image.
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of image_text.
     */
    public function getImage_text()
    {
        return $this->image_text;
    }

    /**
     * Set the value of image_text.
     *
     * @return self
     */
    public function setImage_text($image_text)
    {
        $this->image_text = $image_text;

        return $this;
    }

    /*
        Alle posts van de databank halen
    */
    public static function getAll()
    {
        $conn = Db::getInstance();

        // ID uit de database halen
        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $id = $stm->fetch(PDO::FETCH_COLUMN);

        // Alle post laden van de gevolgde personen
        $statement = $conn->prepare('SELECT images_with_fields.id,images_with_fields.image,images_with_fields.image_text,images_with_fields.user_id,
        images_with_fields.date AS images_date,users.profileImg 
        FROM images_with_fields,followers,users 
        WHERE followers.user_id1=:id
        AND followers.user_id2=images_with_fields.user_id 
        AND followers.user_id2 = users.id 
        UNION SELECT images_with_fields.id,images_with_fields.image,images_with_fields.image_text,images_with_fields.user_id,images_with_fields.date,users.profileImg 
        FROM images_with_fields,users 
        WHERE images_with_fields.user_id =:id AND users.id=:id ORDER BY `images_date` DESC limit 20');

        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function detailPagina()
    {
        //probleem met get id
        $id = $_GET['id'];
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM images_with_fields where id = $id");
        $statement->execute();
        $collection = $statement->fetchAll();

        return $collection;
    }

    public static function profilePic()
    {
        //probleem met get id
        $id = $_GET['id'];
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT users.profileImg FROM images_with_fields,users 
       WHERE images_with_fields.user_id = users.id AND images_with_fields.id = $id");
        $statement->execute();
        $profilePic = $statement->fetch();

        return $profilePic;
    }
}
