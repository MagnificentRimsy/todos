<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\TodoFacade;
use Illuminate\Http\Response;
use App\Filters\{AuthData, Paginate, OrderByDate};
use Illuminate\Auth\Access\AuthorizationException;

class TodoController extends BaseController
{


	/**
	* 
	* @param $id
	* @return mixed
	*/
	public function markAsComplete($id) {
		$resource = $this->repo->find($id);

		if($resource[1] == Response::HTTP_OK){
            try {
                $this->authorize($resource[0]);
            }catch(AuthorizationException $e) {
                return response()->json(['message' => 'access denied'], Response::HTTP_FORBIDDEN);
            }

            return response()->json(TodoFacade::markAsComplete($id));
            
        }

        return response()->json(['resource not found'], Response::HTTP_NOT_FOUND);
		
	}
    

	/**
	*
	* Filter resources
	*
	*/
    public function filters() {
    	return [
    		Paginate::class
    	];
    }
}
