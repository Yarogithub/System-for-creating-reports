<?php


class UserValidator
{
    public $errors = [];

    public function validateUser(Users $user)
    {
        $this->validateEmail($user->getLogin());
        $this->validatePassword($user->getPassword());
        $this->validateRole($user->getRole());
        $this->validateCity($user->getCity());
        $this->validateCountry($user->getCountry());
        $this->validateHourlyRate($user->getHourlyRate());
        $this->validateLastName($user->getLastName());
        $this->validateName($user->getName());
        $this->validatePostalCode($user->getPostalCode());
        $this->validatePhoneNumber($user->getPhoneNumber());

        return $this->errors;
    }

    protected function validateEmail($email)
    {

        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(empty($email)) {
            $this->errors['login'] = "You have to fill this field";
        }elseif (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['login'] ="This email is considered invalid";
        }else{
            return false;
        }
    }

    protected function validatePassword($password)
    {
        if(empty($password)) {

            $this->errors['password'] = "You have to fill this field";
        }
        elseif (strlen($password) < '8')
        {
            $this->errors['password'] = "Your Password Must Contain At Least 8 Characters!";
        }elseif (!preg_match("#[0-9]+#", $password)) {
            $this->errors['password'] = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $this->errors['password'] = "Your Password Must Contain At Least 1 Capital Letter!";
        }elseif (!preg_match("#[a-z]+#", $password)) {
            $this->errors['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            $this->errors['password'] = "Your Password Must Contain At Least 1 Special Character !";
        }else
        {
            return false;
        }

    }

    protected function validateRole($role)
    {
        if(!($role == 'admin' || $role == 'employee'))
        {
            $this->errors['role'] = "Choose a correct role";
        }elseif($role == ''){
            $this->errors['role'] = "You must pick a role";
        }else{
            return false;
        }
    }

    protected function validateName($name)
    {
        if(empty($name)) {

            $this->errors['name'] = "You have to fill this field";
        }
    }

    protected function validateLastName($lastName)
    {
        if(empty($lastName)) {

            $this->errors['lastName'] = "You have to fill this field";
        }
    }

    protected function validatePhoneNumber($phoneNumber)
    {
        if(empty($phoneNumber)) {

            $this->errors['phoneNumber'] = "You have to fill this field";
        }
    }

    protected function validatePostalCode($postalCode)
    {
        if(empty($postalCode)) {

            $this->errors['postalCode'] = "You have to fill this field";
        }
    }

    protected function validateCountry($country)
    {
        if(empty($country)) {

            $this->errors['country'] = "You have to fill this field";
        }
    }

    protected function validateCity($city)
    {
        if(empty($city)) {

            $this->errors['city'] = "You have to fill this field";
        }
    }

    protected function validateHourlyRate($hourlyRate)
    {
        if(empty($hourlyRate)) {

            $this->errors['hourlyRate'] = "You have to fill this field";
        }
    }
}