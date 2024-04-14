<?php

namespace App\Validation;

class PasswordStrength
{
    public $length = 5;
    public $lengthCheck = false;
    public $uppercaseCheck = false;
    public $numericCheck = false;
    public $specialCharacterCheck = false;

    public function password_strength(string $str, string $length, array $data, string &$error = null)
    {
        $this->lengthCheck = strlen($str) >= $this->length;
        $this->uppercaseCheck = strtolower($str) !== $str;
        $this->numericCheck = (bool) preg_match('/[0-9]/', $str);
        $this->specialCharacterCheck = (bool) preg_match('/[^A-Za-z09]/', $str);
        if ($this->lengthCheck && $this->uppercaseCheck && $this->numericCheck && $this->specialCharacterCheck) {
            return true;
        }

        $error = 'Password must be at least ' . $this->length . ' characters long, contain at least one uppercase letter, one number and one special character';
        return false;
    }
}
