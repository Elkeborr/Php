<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Comment
{
    public function Save(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into comments (post_id, user_id, text) values (:post_id, :user_id, :text)");
        //Hier moet de post_id de id zijn die in de url te zien is($id = $_GET['id'];). Op deze manier kan ik de comments selecteren
        //die post_id=$id hebben als die in de url. En dus zo alleen de comments tonen die op de specifieke foto geplaatst zijn.
        //(lukt nog niet)
        $statement->bindValue(":post_id", (int)$_GET['id']); //Dit geeft telkens "0" in db bij post_id...
        $statement->bindValue(":user_id", 1);
        $statement->bindValue(":text", $this->getText());
        return $statement->execute();        
    }

    private $text;
	public static function getAll(){
        $conn = Db::getInstance();
        $id = $_GET['id'];
        $result = $conn->query("SELECT * from comments where post_id=$id order by id desc");

        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
?>