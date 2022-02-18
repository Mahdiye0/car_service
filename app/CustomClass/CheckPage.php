<?php
namespace App\CustomClass;

use Illuminate\Support\Str;

class CheckPage{
public static function checkp($request)
{
    if( str_contains($request->fullUrl(), 'page'))
    {
          $parsedUrl = parse_url($request->fullUrl());
         $a=$parsedUrl['query'];
       $row=(Str::substr($a, 5))*3-2;
      }
      else
          $row=1;
    return $row;
}


}
