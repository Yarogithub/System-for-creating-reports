<?php


class DepartmentValidator
{
    public $errors = [];

    public function validateDepartment(Departments $department)
    {
        $this->validateName($department->getName());

        return $this->errors;
    }

    protected function validateName($name)
    {
        if(empty($name)) {
            $this->errors['name'] = "Musisz wypełnić to pole";
        }
    }
}