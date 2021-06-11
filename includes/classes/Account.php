<?php

class Account
{
    private $con;
    private $errorArray = array();
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function updateDetails($fn, $ln, $un, $em)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewEmail($em, $_SESSION['userLoggedIn']);
        $this->validateNewUserName($un);

        if (empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE users SET firstName=:fn, lastName=:ln, email=:em,username=:un where username=:un_old");
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);
            $query->bindValue(":un_old", $_SESSION['userLoggedIn']);
            $query->execute();
            $_SESSION['userLoggedIn'] = $un;
            return true;
        }

        return false;
    }

    public function register($fname, $lname, $uname, $email, $cemail, $pass, $cpass)
    {
        $this->validateFirstName($fname);
        $this->validateLastName($lname);
        $this->validateUserName($uname);
        $this->validateEmails($email, $cemail);
        $this->validatePasswords($pass, $cpass);

        if (empty($this->errorArray)) {
            return $this->insertUserDetails($fname, $lname, $uname, $email, $pass);
        }

        return false;
    }

    public function login($uname, $pass)
    {
        $hash_pass = hash("sha512", $pass);
        $query = $this->con->prepare("SELECT * from users where username=:uname and password=:pass");
        $query->bindValue(":uname", $uname);
        $query->bindValue(":pass", $hash_pass);
        $query->execute();

        if ($query->rowCount() == 1) {
            return true;
        }
        array_push($this->errorArray, Constants::$loginFailed);
        return false;
    }

    private function insertUserDetails($fname, $lname, $uname, $email, $pass)
    {

        $hash_pass = hash("sha512", $pass);

        $query = $this->con->prepare("INSERT INTO users(firstName,lastName,username,email,password) VALUES(:fname,:lname,:uname,:email,:pass)");
        $query->bindValue(":fname", $fname);
        $query->bindValue(":lname", $lname);
        $query->bindValue(":email", $email);
        $query->bindValue(":uname", $uname);
        $query->bindValue(":pass", $hash_pass);
        return $query->execute();
    }

    private function validateFirstName($fname)
    {
        //only letters
        if (!preg_match("/^([a-zA-Z' ]+)$/", $fname)) {
            array_push($this->errorArray, Constants::$firstNameInvalid);
            return;
        }

        //2-25 chars
        if (strlen($fname) < 2 || strlen($fname) > 25) {
            array_push($this->errorArray, Constants::$firstNameChars);
        }
    }

    private function validateLastName($lname)
    {
        //only letters
        if (!preg_match("/^([a-zA-Z' ]+)$/", $lname)) {
            array_push($this->errorArray, Constants::$lastNameInvalid);
            return;
        }

        //2-25 chars
        if (strlen($lname) < 2 || strlen($lname) > 25) {
            array_push($this->errorArray, Constants::$lastNameChars);
        }
    }

    private function validateUserName($uname)
    {
        //2-25 chars
        if (strlen($uname) < 5 || strlen($uname) > 25) {
            array_push($this->errorArray, Constants::$userNameChars);
            return;
        }

        //duplicate check
        $query = $this->con->prepare("SELECT * FROM users where username=:uname");
        $query->bindValue(":uname", $uname);
        $query->execute();
        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$userNameDup);
        }
    }

    private function validateNewUserName($uname)
    {
        if ($uname != $_SESSION['userLoggedIn']) {

            //2-25 chars
            if (strlen($uname) < 5 || strlen($uname) > 25) {
                array_push($this->errorArray, Constants::$userNameChars);
                return;
            }

            //duplicate check
            $query = $this->con->prepare("SELECT * FROM users where username=:uname");
            $query->bindValue(":uname", $uname);
            $query->execute();
            if ($query->rowCount() != 0) {
                array_push($this->errorArray, Constants::$userNameDup);
            }
        }
    }

    private function validateEmails($email, $cemail)
    {
        //email formats
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        //email == confirm email
        if ($email != $cemail) {
            array_push($this->errorArray, Constants::$emailMatch);
            return;
        }

        //duplicate check
        $query = $this->con->prepare("SELECT * FROM users where email=:email");
        $query->bindValue(":email", $email);
        $query->execute();
        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailDup);
        }
    }

    private function validateNewEmail($email, $un)
    {
        //email formats
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        //duplicate check
        $query = $this->con->prepare("SELECT * FROM users where email=:email and username!=:un");
        $query->bindValue(":email", $email);
        $query->bindValue(":un", $un);
        $query->execute();
        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailDup);
        }
    }

    private function validatePasswords($pass, $cpass)
    {
        //pass length criteria
        if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pass)) {
            array_push($this->errorArray, Constants::$invalidPassword);
            return;
        }
        // pass == confirm pass
        if ($pass != $cpass) {
            array_push($this->errorArray, Constants::$passwordMatch);
            return;
        }

    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<div class='text-danger reg-error'> $error </div>";
        }
    }

    public function getFirstError(){
        if(!empty($this->errorArray)){
            return $this->errorArray[0];
        }
            
    }

}