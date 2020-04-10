<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Controllers\ApiResponse as Response;
use App\Response\ResponseStructure;


class UserController extends Controller
{

    public function getUsers(Request $request,ResponseStructure $response){

        $id=explode(",",$request->input('id'));
        $user=User::whereIn('id',$id)->get()->toArray();

        if(empty($user)){
            return $response->output('No records found',204);    
        }
        return $response->output($user,200);

    }

}


