<?php


class ReportValidator
{
    public $errors = [];

    public function validateReport(ReportEnt $report)
    {
        $this->validateContent($report->getContent());

        return $this->errors;
    }

    protected function validateContent($content)
    {
        if(empty($content)) {

            $this->errors['content'] = "You have to fill this field";
        }

    }

}