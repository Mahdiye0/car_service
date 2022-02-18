<?php
namespace App\CustomClass;


use App\Models\User;

class CheckRole{
    public static  function check($user_id)
    {
        $type=0;
        $users = User::find( $user_id);
        $result=$users->roles()->get();
        if( count( $result)==2)
        $type=3;
        elseif(count( $result)==1)
           {

               switch ($result[0]->pivot->role_id) {
                   case 1:
                    $type=1;//خدمت دهنده
                       break;

                 case 2:
                    $type=2;//خدمت گیرنده
                   break;
               }
           }
           return $type;


    }
}


