<?php
class login extends Dbh
{
    protected function getUser($uid, $pwd)
    {
        $stm = $this->connect()->prepare("SELECT user_pwd FROM users where user_uid =? OR user_email=?");

        if (!$stm->execute(array($uid, $uid))) {
            $stm = null;
            header("location: ./index.php?error=stmfailed");
            exit;
        }

        if ($stm->rowCount() == 0) {
            $stm = null;
            header("location: ./index.php?error=usernotfound");
            exit;
        }

        $pwdHashed = $stm->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]['user_pwd']);

        if ($checkPwd == false) {
            $stm = null;
            header("location: ./index.php?error=wrongPassword");
            exit;
        } else {
            $stm = $this->connect()->prepare("SELECT * FROM users where user_uid =? OR user_email=? AND user_pwd=?");

            if (!$stm->execute(array($uid, $uid,$pwd))) {
                $stm = null;
                header("location: ./index.php?error=stmfailed");
                exit;
            }

            if ($stm->rowCount() == 0) {
                $stm = null;
                header("location: ./index.php?error=usernotfound");
                exit;
            }
            $user=$stm->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['user_id']=$user[0]['user_id'];
            $_SESSION['user_uid']=$user[0]['user_uid'];
            $stm =null;
        }
        $stm = null;
    }
}