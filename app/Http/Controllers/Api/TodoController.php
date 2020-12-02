<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\TodoFacade;
use App\Filters\{AuthData, Paginate};

class TodoController extends BaseController
{


	/**
	* 
	* @param $id
	* @return mixed
	*/
	public function markAsComplete($id) {
		$resource = TodoFacade::find($id);

		return response()->json(TodoFacade::markAsComplete($id));
	}
    

	/**
	*
	* Filter resources
	*
	*/
    public function filters() {
    	return [
    		AuthData::class,
    		Paginate::class
    	];
    }
}
