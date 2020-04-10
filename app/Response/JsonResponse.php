<?php

namespace App\Response;

use App\Response\ResponseStructure;


class JsonResponse implements ResponseStructure
{
    

    public function output($data,$status)
    {
        return response()->json($data, $status);
    }

    
}
