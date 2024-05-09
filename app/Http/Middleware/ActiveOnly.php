<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
class ActiveOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            //check if the default password is used
            $user = User::find(auth()->user()->id);

            if(Hash::check('youth2024', $user->password)){
                return redirect('/security/password')->with('change_password','To enhance security, you need to change your password before you can start using the system');
            }

            if(Auth::user()->is_active !=1) {
                return redirect('/deactivated');

            }
            return $next($request);
        }

    }
}
