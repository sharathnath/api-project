<?php

namespace App\Providers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

use App\Response\ResponseStructure;
use App\Response\JsonResponse;
use App\Response\CsvResponse;

use Illuminate\Http\Client\ResponseSequence;

class AppServiceProvider extends ServiceProvider
{


    public function boot()
    {

        Validator::extend('validateids', function($attribute, $values, $params, $validator){
            $value = explode(',', $values);
            $rules = [
                'id' => 'required|numeric',
            ];
            if ($value) {
                foreach ($value as $email) {
                    $data = [
                        'id' => $email
                    ];
                    $validator = Validator::make($data, $rules);
                    if ($validator->fails()) {
                        return false;
                    }
                }
                return true;
            }
        });


        Validator::extend('validateformats', function($attribute, $values, $params, $validator){
            
            $format_array=array("json","csv");

            if(empty($values))
            return true;

            if(in_array($values,$format_array))
            {
                return true;
            }

            return false;
        });

    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ResponseStructure::class , function($app){
                
            $request = app(\Illuminate\Http\Request::class);
            $format = $request->header('format');
                switch($format){
                    case 'csv':
                    return new CsvResponse();
                    break;

                    default:   
                    return new JsonResponse();  
                }
                    
        });

    }
}
