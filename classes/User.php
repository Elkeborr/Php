<?php

//namespace phpProject;

class User
{
    private $email;
    private $firstName;
    private $lastName;
    private $userName;
    private $password;
    private $bio;
    private $profileImg;

    //----------------------- GETTER & SETTER -----------------------//

    /**
     * Get the value of email.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email.
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of firstName.
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName.
     *
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName.
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName.
     *
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of userName.
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName.
     *
     * @return self
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of password.
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password.
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of bio.
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio.
     *
     * @return self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get the value of profileImg.
     */
    public function getProfileImg()
    {
        return $this->profileImg;
    }

    /**
     * Set the value of profileImg.
     *
     * @return self
     */
    public function setProfileImg($profileImg)
    {
        $this->profileImg = $profileImg;

        return $this;
    }

    //----------------------- FUNCTIES -----------------------//

    /* alle info van user*/

    public static function getAll()
    {
        $conn = Db::getInstance();
        $result = $conn->query('select * from users ');

        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    /* registreren*/
    public function register()
    {
        /* Het gebruik bewust vertragen door het passwoord meerdere
        keren te laten encrypteren  */
        $options = [
        'cost' => 12, //2^12
        ];
        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

        try {
            // De databank aanspreken
            $conn = Db::getInstance();
            // Opslagen in de databank
            $stm = $conn->prepare('INSERT into users (email,firstname,lastname,username,password,bio,profileImg) VALUES (:email,:firstname,:lastname,:username,:password,"","")');
            // Waarden koppelen aan invul velden (bindParam= veiligere manier)
            $stm->bindParam(':email', $this->email);
            $stm->bindParam(':firstname', $this->firstName);
            $stm->bindParam(':lastname', $this->lastName);
            $stm->bindParam(':username', $this->userName);
            $stm->bindParam(':password', $password);

            // Uitvoeren
            $result = $stm->execute();

            // Gelukt = true
            return $result;
        } catch (Throwable $t) {
            // Mislukt = false
            return false;
        }
    }

    /*inloggen*/
    public static function login()
    {
        if (!empty($_POST)) {
            // email en password opvragen
            $email = $_POST['email'];
            $password = $_POST['password'];

            $conn = Db::getInstance();
            // check of rehash van password gelijk is aan hash uit db
            $statement = $conn->prepare('SELECT * from users where email = :email');
            $statement->bindParam(':email', $email);
            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                // ja -> login
                //session_start();
                $_SESSION['email'] = $email;
                header('Location:index.php');
            } else {
                // nee -> error
                $error = true;
            }
        }
    }

    /* controle van de login*/
    public static function checkLogin()
    {
        if (isset($_SESSION['email'])) {
            // session_start();
        } else {
            header('Location: login.php');
        }
    }

    /*emailcheck*/
    public static function EmailAvailable($email)
    {
        $conn = Db::getInstance();
        $stm = $conn->prepare('SELECT * FROM users WHERE email = :email');
        $stm->bindParam(':email', $email);
        //zegt of gelukt is of ni
        $stm->execute();
        //assoc: heel de tabel me zelf gekozen naam
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return true;
        } else {
            return false;
        }
    }

    /*usernamecheck*/
    public static function UsernameAvailable($username)
    {
        $conn = Db::getInstance();
        $stm = $conn->prepare('SELECT * FROM users WHERE userName = :username');
        $stm->bindParam(':username', $username);
        //zegt of gelukt is of ni
        $stm->execute();
        //assoc: heel de tabel me zelf gekozen naam
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return true;
        } else {
            return false;
        }
    }

    /*username-zoeken*/
    public static function username()
    {
        $conn = Db::getInstance();

        // Username ophalen
        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $id = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('SELECT userName FROM users WHERE users.id=:id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        $username = $statement->fetch(PDO::FETCH_COLUMN);

        return $username;
    }

    /*profile image-zoeken*/
    public static function profileImg()
    {
        $conn = Db::getInstance();

        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $id = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('SELECT profileImg FROM users WHERE users.id=:id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $profileImg = $statement->fetch(PDO::FETCH_COLUMN);

        return $profileImg;
    }

    /*Biografie zoeken*/
    public static function bio()
    {
        $conn = Db::getInstance();

        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $id = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('SELECT bio FROM users WHERE users.id=:id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $bio = $statement->fetch(PDO::FETCH_COLUMN);

        return $bio;
    }

    public static function updateBio()
    {
        $conn = Db::getInstance();

        if (isset($_POST['submit'])) {
            $bio = $_POST['bio'];

            if (empty($bio)) {
                echo "<font color='red'>Tekstveld is leeg!</font><br/>";
            } else {
                $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
                $stm->execute();
                $id = $stm->fetch(PDO::FETCH_COLUMN);

                $insert = $conn->prepare("UPDATE users SET bio = '".$bio."'WHERE users.id='".$id."';");
                $insert->bindParam(':bio', $bio);
                $insert->execute();
            }

            return $insert;
        }
    }

    public static function detailPagina($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT * FROM users WHERE users.id=:id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $detailUser = $statement->fetchAll();

        return $detailUser;
    }

    public static function changeEmail(){
        $conn = Db::getInstance();

        if (isset($_POST['submit'])) {
            $newemail = $_POST['newemail'];
            $password = $_POST['password'];
            
            if (empty($password)) {
                echo "<font color='red'>Password field is empty!</font><br/>";
            } else {
                $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
                $stm->execute();
                $id = $stm->fetch(PDO::FETCH_COLUMN);
            
                $insert = $conn->prepare("UPDATE users SET email = '".$newemail."'WHERE users.id='".$id."';");
                $insert->bindParam(':email', $newemail);
                $insert->execute();
                header('Location:index.php');


            }
        return $insert;
    }

    }

    public static function changePassword(){
        $conn = Db::getInstance();


        if (isset($_POST['submit'])) {
            $oldpassword = $_POST['oldpassword'];
            $newpassword = $_POST['newpassword'];

            /* Het gebruik bewust vertragen door het passwoord meerdere
            keren te laten encrypteren  */
            $options = [
            'cost' => 12, //2^12
            ];
            $newpassword = password_hash($newpassword, PASSWORD_DEFAULT, $options);
            
            if (empty($oldpassword)) {
                echo "<font color='red'>Old password is empty!</font><br/>";
            } else {
                $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
                $stm->execute();
                $id = $stm->fetch(PDO::FETCH_COLUMN);
            
                $insert = $conn->prepare("UPDATE users SET password = '".$newpassword."'WHERE users.id='".$id."';");
                $insert->bindParam(':password', $newpassword);
                $insert->execute();

            }
            return $insert;

    }

    }
}
