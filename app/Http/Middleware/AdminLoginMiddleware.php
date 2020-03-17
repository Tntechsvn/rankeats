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
                return redirect()-> route('getLogin')->with('error', 'Tài Khoản Không Tồn Tại');
            }else{
                if(Auth::user()->status == 1){
                    Auth::logout();
                    return redirect()->route('getLogin')->with('error', 'Tài khoản của bạn đã bị chặn, vui lòng liên hệ với quản trị viên');
                }else{
                    return $next($request);
                }
            }
            
        }else{
            return redirect()-> route('getLogin')->with('error', 'Tên đăng nhập hoặc tài khoản của bạn không chính xác');
        }
    }
}
