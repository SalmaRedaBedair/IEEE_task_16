<?php


class signupContr extends signup
{
    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdrepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
    }

    public function signupUser()
    {
        if($this->emptyInput()==false)
        {
            header("location: ./index.php?error=emptyinput");
            exit;
        }
        if($this->invalidUid()==false)
        {
            header("location: ./index.php?error=invalidUid");
            exit;
        }
        if($this->invalidEmail()==false)
        {
            header("location: ./index.php?error=invalidEmail");
            exit;
        }
        if($this->pwdMatch()==false)
        {
            header("location: ./index.php?error=pwdNotMatch");
            exit;
        }
        if($this->uidTakenCheck()==false)
        {
            header("location: ./index.php?error=useroremailtaken");
            exit;
        }
        $this->setUser($this->uid,$this->pwd,$this->email);
    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)) {
            $result = false;
        }
        return $result;
    }
    private function invalidUid()
    {
        $result = true;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        }
        return $result;
    }
    private function invalidEmail()
    {
        $result = true;
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        return $result;
    }
    private function pwdMatch()
    {
        $result = true;
        if ($this->pwd!==$this->pwdrepeat) {
            $result = false;
        }
        return $result;
    }
    private function uidTakenCheck()
    {
        $result = true;
        if (!$this->checkUser($this->uid,$this->email)) {
            $result = false;
        }
        return $result;
    }
}