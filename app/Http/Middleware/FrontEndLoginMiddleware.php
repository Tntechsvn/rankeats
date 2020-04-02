<?php
namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserRole;
use App\Myconst;

class FrontEndLoginMiddleware
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
			return $next($request);
		}else{
			 return redirect()->route('sign_in')-> with('message','Please log in to perform the operation');
		}
	}
}

