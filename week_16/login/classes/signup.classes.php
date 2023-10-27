<?php 
class signup extends Dbh{
    protected function checkUser($uid,$email)
    {
        $stm=$this->connect()->prepare("SELECT user_uid FROM users where user_id =? OR user_email=? ");
        if(!$stm->execute(array($uid,$email)))
        {
            $stm=null;
            header("location: ./index.php?error=stmfailed");
            exit;
        }

        $resultcheck=true;
        if($stm->rowCount()>0)
        {
            $resultcheck=false;
        }
        return $resultcheck;
    }
    protected function setUser($uid,$pwd,$email)
    {
        $stm=$this->connect()->prepare("INSERT INTO users(user_uid,user_pwd,user_email) VALUES (?,?,?)");

        $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);

        if(!$stm->execute(array($uid,$hashedPwd,$email)))
        {
            $stm=null;
            header("location: ./index.php?error=stmfailed");
            exit;
        }

        $stm=null;
    }
}