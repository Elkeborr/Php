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
}

//----------------------- FUNCTIES -----------------------//

