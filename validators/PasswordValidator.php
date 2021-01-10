<?php


class PasswordValidator
{
    public $errors = [];

    public function validateFirstPassword(Users $user)
    {
        $this->validatePassword($user->getPassword());
        $this->validatePasswordConfirm($user->getConfirmPassword(),$user->getPassword());
//        $this->validateToken($user->getToken());

        return $this->errors;
    }

    protected function validatePassword($password)
    {
        if(empty($password)) {

            $this->errors['setPassword'] = "You have to fill this field";
        }
        elseif (strlen($password) < '8')
        {
            $this->errors['setPassword'] = "Your Password Must Contain At Least 8 Characters!";
        }elseif (!preg_match("#[0-9]+#", $password)) {
            $this->errors['setPassword'] = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $this->errors['setPassword'] = "Your Password Must Contain At Least 1 Capital Letter!";
        }elseif (!preg_match("#[a-z]+#", $password)) {
            $this->errors['setPassword'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            $this->errors['setPassword'] = "Your Password Must Contain At Least 1 Special Character !";
        }else
        {
            return false;
        }

    }

    protected function validatePasswordConfirm($confirmPassword,$password)
    {
        if(empty($confirmPassword))
        {
            $this->errors['confirmPassword'] = "You have to fill this field";
        }elseif ($confirmPassword != $password)
        {
            $this->errors['confirmPassword'] = "Your passwords are not the same";

        }
    }

//    protected function validateToken($token)
//    {
//
//    }

}