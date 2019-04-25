<?php
    
    class Post {
        private $image;
        private $image_text;

         /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        /**
         * Get the value of image_text
         */ 
        public function getImage_text()
        {
                return $this->image_text;
        }

        /**
         * Set the value of image_text
         *
         * @return  self
         */ 
        public function setImage_text($image_text)
        {
                $this->image_text = $image_text;

                return $this;
        }

        

        /*
            Alle posts van de databank halen
        */
        public static function getAll() {
            $conn = Db::getInstance();
            // ID uit de database halen
            $stm = $conn-> prepare ("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
            $stm->execute();
            $id=$stm->fetch(PDO::FETCH_COLUMN);
    
            // Alle post laden van de gevolgde personen
            $statement = $conn->prepare("SELECT images_with_fields.image,images_with_fields.image_text FROM 
            images_with_fields,followers WHERE
            followers.user_id1=:id AND followers.user_id2=images_with_fields.user_id");
            $statement->bindValue(":id", $id); 
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        /*
            Get one item based on $id
       
        public static function find($id) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from collection where id = :id");
            $statement->bindParam(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
 */

       
    }