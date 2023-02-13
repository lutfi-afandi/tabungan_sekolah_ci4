<?php
namespace App\Validation;

class PasswordStrength{
  public $length = 10;

  public $lengthCheck = false;

  public $uppercaseCheck = false;

  public $numericCheck = false;

  public $specialCharacterCheck = false;
  
  public function password_strength(string $str,string $length, array $data, string &$error = null){
    $this->lengthCheck = strlen($str) >= $this->length;
    $this->uppercaseCheck = strtolower($str) !== $str;
    $this->numericCheck = (bool) preg_match('/[0-9]/', $str);
    $this->specialCharacterCheck = (bool) preg_match('/[^A-Za-z0-9]/', $str);
    if ($this->lengthCheck && $this->uppercaseCheck && $this->numericCheck && $this->specialCharacterCheck)
    {
        return true;
    }
    //pesan jika gagal validasi
    $error = "Password minimal {$length} karakter dan mengandung satu huruf besar,1 angka dan 1 special karakter";
    return false;
  }
}