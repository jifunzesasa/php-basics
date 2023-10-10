<?php

/**
 * Validate JSON data against a set of rules
 * @param string $jsonData JSON data to validate
 * @param array $validationRules Validation rules
 * 
 * @return array Validation result
 * 
 * @example
 * 
 */
function validateJsonData($jsonData, $validationRules)
{
    // Check if JSON data is empty
    if (empty($jsonData)) {
        return ['success' => false, 'message' => 'Empty JSON data'];
    }

    // Decode the JSON data
    $data = json_decode($jsonData, true);

    // Check if the JSON was decoded successfully
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        return ['success' => false, 'message' => 'Invalid JSON data'];
    }

    // Perform validation
    $errors = [];

    foreach ($validationRules as $field => $rule) {
        if (isset($data[$field]) || (array_key_exists('required', $rule) && !$rule['required'])) {
            $value = $data[$field] ?? null;
            if ($rule['required'] && $value === null) {
                $errors[] = "$field is required";
            } elseif ($value !== null) {
                switch ($rule['type']) {
                    case 'integer':
                        if (!is_numeric($value) || !is_int($value + 0)) {
                            $errors[] = "$field must be an integer";
                        }
                        break;
                    case 'string':
                        if (!is_string($value)) {
                            $errors[] = "$field must be a string";
                        }
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[] = "$field must be a valid email address";
                        }
                        break;
                    case 'boolean':
                        if (!is_bool($value)) {
                            $errors[] = "$field must be a boolean";
                        }
                        break;
                    case 'array':
                        if (!is_array($value)) {
                            $errors[] = "$field must be an array";
                        }
                        break;
                }
            }
        }
    }

    // Check for errors
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    // If validation passes, return the validated data
    return ['success' => true, 'data' => $data];
}

// Set the response content type to JSON
header('Content-Type: application/json');

// check if post request is sent
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Method Not Allowed']);
    exit();
}

// JSON data from the POST request
$jsonData = file_get_contents('php://input');

// Define validation rules
$validationRules = [
    'reference_number' => ['required' => true, 'type' => 'integer'],
    'step_number' => ['required' => true, 'type' => 'integer'],
    'identification' => ['required' => true, 'type' => 'string'],
    'zan_id' => ['required' => true, 'type' => 'string'],
    'passport_number' => ['required' => true, 'type' => 'string'],
    'first_name' => ['required' => true, 'type' => 'string'],
    'middle_name' => ['required' => false, 'type' => 'string'],
    'last_name' => ['required' => true, 'type' => 'string'],
    'email' => ['required' => true, 'type' => 'email'],
    'phone_number' => ['required' => true, 'type' => 'string'],
    'address' => ['required' => true, 'type' => 'array'],
    'address.street' => ['required' => true, 'type' => 'string'],
    'address.compound_location' => ['required' => false, 'type' => 'string'],
    'repair_type' => ['required' => true, 'type' => 'string'],
    'hasEffect' => ['required' => true, 'type' => 'boolean'],
    'precautions' => ['required' => true, 'type' => 'string'],
    'agree' => ['required' => true, 'type' => 'boolean'],
];

// Validate the JSON data
$result = validateJsonData($jsonData, $validationRules);

echo json_encode($result);

// // Check the validation result
// if ($result['success']) {
//     // Access the validated data
//     $validatedData = $result['data'];
//     // Your logic here...

//     // Return a success response
//     echo json_encode(['message' => 'Success']);
// } else {
//     // Return a JSON response with validation errors
//     http_response_code(400); // Bad Request
//     echo json_encode(['errors' => $result['errors']]);
// }
