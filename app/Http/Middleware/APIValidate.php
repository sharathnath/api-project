<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Closure;

class APIValidate
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
        $input = array(
            'id' => $request->input('id'),
            'format' => $request->header('format')   
        );
        
        $validator = Validator::make($input, [
            'id' => 'required|validateids',
            'format'=>'validateformats'
        ],array('validateids' => ':attribute must have valid integer',
        'validateformats' => ':attribute must have valid response format [ex : json,csv]'
    ));

        if ($validator->fails()) {
           return response()->json(array($validator->errors()->first()),422);
        }



        return $next($request);
    }
}
