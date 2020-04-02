<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware

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
            $check = Auth::user()-> deleted_at;
            if($check != null){
                Auth::logout();
                return redirect()-> route('getLogin')->with('error', 'Account does not exist');
            }else{
               
                return $next($request);
            }
            
        }else{
            return redirect()-> route('getLogin')->with('error', 'Your username or account is incorrect');
        }
    }
}
