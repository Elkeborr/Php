<?php
    
    class ProfileImg {
        private $image;

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


        

        /*
            Image van de databank halen
        */
        public static function getAll() {
            
            $conn = Db::getInstance();

            // ID uit de database halen
            $stm = $conn-> prepare ("SELECT id FROM users WHERE email = '".@$_SESSION['email']."'");
            $stm->execute();
            $id=$stm->fetch(PDO::FETCH_COLUMN);
    
            // Alle post laden van de gevolgde personen
            $statement = $conn->prepare("SELECT * FROM profile_images");

            $statement->bindValue(":id", $id); 
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        
            //Get one item based on $id
       /*
        public static function find($id) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from profile_images where id = :id");
            $statement->bindParam(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);*/
        }
 






 