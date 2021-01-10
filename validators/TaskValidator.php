<?php


class TaskValidator
{
    public $errors = [];

    public function validateTask(Tasks $task)
    {
        $this->validateName($task->getName());

        return $this->errors;
    }

    protected function validateName($name)
    {
        if(empty($name)) {
            $this->errors['name'] = "Musisz wypełnić to pole";
        }
    }
}