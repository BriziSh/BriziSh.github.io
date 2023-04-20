<?php
namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;

class ThrottleRequestsMiddleware extends ThrottleRequests
{
    protected function resolveRequestSignature($request){
    $userId = $request->user() ? $request->user()->id : 'guest';
    return $userId . '|' . $request->ip();}
}
