<?php


class DivisionValidator
{
    public $errors = [];

    public function validateDivision(Divisions $division)
    {
        $this->validateName($division->getName());

        return $this->errors;
    }

    protected function validateName($name)
    {
        if(empty($name)) {
            $this->errors['name'] = "Musisz wypełnić to pole";
        }
    }
}