<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class RegularAuth
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
        if(Auth::guard('api')->check() && Auth::guard('api')->user()->role === 'regular'){
            $token = $request->bearerToken();
            $user_id = Auth::guard('api')->user()->id;
            $row = DB::table('oauth_access_tokens')->where('user_id', $user_id)->latest('created_at')->first();
            $expires_at = $row->expires_at;
            $dateNow = Carbon::now()->toDateTimeString();

            if($expires_at >= $dateNow) {
                return $next($request);
            }
        } else {
            return response(['message' => 'You do not have permissions to access this resource or the token have expired'], 401);
        }
    }
}
