<?php

namespace App\Functions;

use Illuminate\Mail\Markdown;

class MarkFunction
{
    public static function parse($mark)
    {
        return Markdown::parse($mark ?? '');
    }
}
