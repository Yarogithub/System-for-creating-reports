<?php


class PositionValidator
{
    public $errors = [];

    public function validatePosition(Positions $position)
    {
        $this->validateName($position->getName());

        return $this->errors;
    }

    protected function validateName($name)
    {
        if(empty($name)) {
            $this->errors['name'] = "Musisz wypełnić to pole";
        }
    }
}