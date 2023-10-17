<?php

class Validator
{
    private $data;
    private $rules;
    private $errors;

    public function __construct()
    {
        $this->data = [];
        $this->rules = [];
        $this->errors = [];
    }


    public function validate($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->errors = [];
        $this->runValidation();
    }

    private function runValidation()
    {
        foreach ($this->rules as $field => $rule) {
            $rules = explode('|', $rule);
            foreach ($rules as $singleRule) {
                $parts = explode(':', $singleRule);
                $ruleName = $parts[0];
                $ruleParams = isset($parts[1]) ? explode(',', $parts[1]) : [];

                if (!$this->validateRule($field, $ruleName, $ruleParams)) {
                    $this->errors[$field][] = "Validation failed for $field with rule $ruleName.";
                }
            }
        }
    }

    public function passes()
    {
        return empty($this->errors);
    }

    public function fails()
    {
        return !$this->passes();
    }

    public function errors()
    {
        return $this->errors;
    }

    private function validateRule($field, $ruleName, $ruleParams)
    {
        if (method_exists($this, $ruleName)) {
            return call_user_func_array([$this, $ruleName], [$field, $ruleParams]);
        }

        return false;
    }

    // Define validation rules

    private function required($field, $params)
    {
        return isset($this->data[$field]) && !empty($this->data[$field]);
    }

    private function email($field, $params)
    {
        return filter_var($this->data[$field], FILTER_VALIDATE_EMAIL) !== false;
    }

    private function numeric($field, $params)
    {
        return is_numeric($this->data[$field]);
    }

    private function max($field, $params)
    {
        return strlen($this->data[$field]) <= $params[0];
    }

    private function min($field, $params)
    {
        return strlen($this->data[$field]) >= $params[0];
    }
}

// Example usage:

$data = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'age' => 32,
];

$rules = [
    'name' => 'required|max:255',
    'email' => 'required|email',
    'age' => 'numeric|min:18',
];

$validator = new Validator();
$validator->validate($data, $rules);

if ($validator->fails()) {
    print_r($validator->errors());
} else {
    echo "Validation passed!";
}
