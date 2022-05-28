<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserAccessKey;

class APIkey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!$request->isMethod('get')) return $next($request);

        $header = $request->header('API-KEY-TEST');
        $result = [];
        if ($header == '') {
            $result[] = [
                'STATUS' => "403 Forbidden",
            ];
            $response["GetDataRs"] = $result;
            return response()->json($response);
        } else {
            $key = "12345667890X";
            if ($header != $key) {
                $result[] = [
                    'STATUS' => "403 Forbidden",
                ];
                $response["GetDataRs"] = $result;
                return response()->json($response);
            } else {
                return $next($request);
            }
        }
    }
}
