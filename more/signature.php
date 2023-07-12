<?php

interface Signatural
{
  public function signature();
  public function verify(string $string);
}

trait HasSignature
{
    public function signature()
    {

    }
    public function verify(string $string)
    {
        
    }
}


class User implements Signatural
{
    use HasSignature;
    public $name;
    public $email;
    public $password;

    public function __construct($name, $email, $password)
    {
        $this->name     = $name;
        $this->email    = $email;
        $this->password = $password;
    }

    public function signature()
    {
        return $this->name . $this->email . $this->password;
    }

    public function verify(string $string)
    {
        return $this->signature() === $string;
    }
}