<?php

namespace Services;

abstract class Vardump
{
    private $func;

    public static function VarDump($array)
    {
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
    }


}


