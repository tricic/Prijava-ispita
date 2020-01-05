<?php

class GreskeException extends Exception
{
    public $greske;

    public function __construct(array $greske = [])
    {
        $this->greske = $greske;
    }
}