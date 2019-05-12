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

    public static function detectColors($image, $num, $level = 5)
    {
        $level = (int) $level;
        $palette = array();
        $size = getimagesize($image);
        if (!$size) {
            return false;
        }
        switch ($size['mime']) {
      case 'image/jpeg':
        $img = imagecreatefromjpeg($image);
        break;
      case 'image/png':
        $img = imagecreatefrompng($image);
        break;
      case 'image/gif':
        $img = imagecreatefromgif($image);
        break;
      default:
        return false;
    }
        if (!$img) {
            return false;
        }
        for ($i = 0; $i < $size[0]; $i += $level) {
            for ($j = 0; $j < $size[1]; $j += $level) {
                $thisColor = imagecolorat($img, $i, $j);
                $rgb = imagecolorsforindex($img, $thisColor);
                $color = sprintf('%02X%02X%02X', (round(round(($rgb['red'] / 0x66)) * 0x66)), round(round(($rgb['green'] / 0x66)) * 0x66), round(round(($rgb['blue'] / 0x66)) * 0x66));
                $palette[$color] = isset($palette[$color]) ? ++$palette[$color] : 1;
            }
        }
        arsort($palette);

        return array_slice(array_keys($palette), 0, $num);
    }




   public static function search(){

     $conn = Db::getInstance();
     $stmt = $conn->prepare("SELECT image_text FROM images_with_fields WHERE search LIKE '%search%'");
     $stmt->bindParam(':search', $search, PDO::PARAM_STR);

     $stmt->execute();
     $search = $stmt->fetch();

     return $search;


    }
}
