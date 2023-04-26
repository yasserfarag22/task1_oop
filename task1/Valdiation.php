<?php


class Validation
{

    public function required_input($input)
    {
        return !empty($input);
    }



    public function min($input, $min)
    {
        return strlen($input) >= $min;
    }

    public function max($input, $max)
    {
        return strlen($input) <= $max;
    }

    public function isString($input)
    {
        return is_string($input);
    }

    public function numeric($input)
    {
        return is_numeric($input);
    }

    public function isInteger($input)
    {
        return is_int($input);
    }

    public static function existsInArray($value, $array)
    {
        return in_array($value, $array);
    }
    public static function fileExists($file)
    {
        return file_exists($file);
    }
}
