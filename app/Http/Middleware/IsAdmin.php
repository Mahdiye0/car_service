<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $inputs=$request->all();
        $admin=User::where(['user_name'=> $inputs['user_name'], $inputs['password']])->with('roles')
        ->whereHas('roles',function($q) {
            $q->where('roles.id',3);
        })->get();
         if($admin){
            return $next($request);
        }

        return redirect('home')->with('error',"You don't have admin access.");
    }
}
