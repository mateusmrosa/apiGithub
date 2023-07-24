<?php

namespace App\Util;

class Funcoes
{
    public static function formatarDataBR($data)
    {
        return date("d/m/Y", strtotime($data));
    }
}
