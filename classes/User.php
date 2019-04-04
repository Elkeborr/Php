<?php

class User {

private $email;
private $firstName;
private $lastName;
private $userName;
private $password;
private $passwordConformation;

//----------------------- GETTER & SETTER -----------------------//
/**
 * Get the value of email
 */ 
public function getEmail()
{
return $this->email;
}

/**
 * Set the value of email
 *
 * @return  self
 */ 
public function setEmail($email)
{
$this->email = $email;

return $this;
}

/**
 * Get the value of firstName
 */ 
public function getFirstName()
{
return $this->firstName;
}

/**
 * Set the value of firstName
 *
 * @return  self
 */ 
public function setFirstName($firstName)
{
$this->firstName = $firstName;

return $this;
}

/**
 * Get the value of lastName
 */ 
public function getLastName()
{
return $this->lastName;
}

/**
 * Set the value of lastName
 *
 * @return  self
 */ 
public function setLastName($lastName)
{
$this->lastName = $lastName;

return $this;
}

/**
 * Get the value of userName
 */ 
public function getUserName()
{
return $this->userName;
}

/**
 * Set the value of userName
 *
 * @return  self
 */ 
public function setUserName($userName)
{
$this->userName = $userName;

return $this;
}

/**
 * Get the value of password
 */ 
public function getPassword()
{
return $this->password;
}

/**
 * Set the value of password
 *
 * @return  self
 */ 
public function setPassword($password)
{
$this->password = $password;

return $this;
}

/**
 * Get the value of passwordConformation
 */ 
public function getPasswordConformation()
{
return $this->passwordConformation;
}

/**
 * Set the value of passwordConformation
 *
 * @return  self
 */ 
public function setPasswordConformation($passwordConformation)
{
$this->passwordConformation = $passwordConformation;

return $this;
}


//----------------------- FUNCTIES -----------------------//

/* databank connectie hier laten werken */
public static function getAll(){
    $conn = Db::getInstance();
    $result = $conn->query("select * from posts ");

    // fetch all records from the database and return them as objects of this __CLASS__ (Post)
    return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
}

public function register (){

  /* Het gebruik bewust vertragen door het passwoord meerdere 
  keren te laten encrypteren  */
    $options =[
        'cost' => 12 //2^12
        ];
                $password = password_hash($this->password, PASSWORD_DEFAULT,$options);
                try {
                    // De databank aanspreken
                    $conn = Db::getInstance();
                    // Opslagen in de databank
                    $stm = $conn -> prepare ("INSERT into users (email,firstname,lastname,username,password) VALUES (:email,:firstname,:lastname,:username:password)");
                    // Waarden koppelen aan invul velden (bindParam=  veiligere manier)
                    $stm  -> bindParam(":email",$this->email);
                    $stm  -> bindParam(":firstname",$this->firstName);
                    $stm  -> bindParam(":lastname",$this->lastName);
                    $stm  -> bindParam(":username",$this->userName);
                    $stm  -> bindParam(":password",$password);
                    // Uitvoeren
                    $result = $stm ->execute();
                    // Gelukt = true
                    return $result;
                } catch (Throwable $t){
                    // Mislukt = false
                  return false;
                }


}


}
