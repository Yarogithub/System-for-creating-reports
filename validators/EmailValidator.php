<?php


class EmailValidator
{
    public $errors = [];

    public function validateEmail(Users $user)
    {
        $this->validateEmailInForgotPassword($user->getLogin());

        return $this->errors;
    }

    protected function validateEmailInForgotPassword($email)
    {

        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(empty($email)) {
            $this->errors['loginCheck'] = "You have to fill this field";
        }elseif (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['loginCheck'] ="This email is considered invalid";
        }else{
            return false;
        }
    }
}