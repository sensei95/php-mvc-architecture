<?php

namespace App\Validation;

class Validator
{
    private array $data;
    private array $errors = [];
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param array $rules
     * @return array|null
     */
    public function validate(array $rules): ?array
    {
        foreach ($rules as $field => $validationRules){
            if(array_key_exists($field, $this->data)){

                $field = htmlentities(stripslashes(trim($field)));

                foreach ($validationRules as $validationRule){
                    switch ($validationRule){
                        case "required":
                            $this->required($field, $this->data[$field]);
                            break;
                        case str_starts_with($validationRule, 'min'):
                            $this->min($field, $this->data[$field], $validationRule);
                            break;
                        case "string":
                            $this->string($field, $this->data[$field]);
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        return $this->getValidationsErrors();
    }

    private function getValidationsErrors(): ?array
    {
        return $this->errors;
    }

    private function required(string $field, string $value): void
    {
       if(empty($value)){
           $this->errors[$field][] = "{$field} field is required";
       }
    }

    private function min(string $field, string $value, string $validationRule): void
    {
        preg_match_all('/(\d+)/',$validationRule, $matches);
       $requiredLength = (int) $matches[0][0];

       if(strlen($value) < $requiredLength){
           $this->errors[$field][] = "{$field} field length should be greater than $requiredLength";
       }
    }

    private function string(string $field, mixed $value): void
    {
        if (!is_string($value)) {
            $this->errors[$field][] = "{$field} field should be a string";
        }
    }
}