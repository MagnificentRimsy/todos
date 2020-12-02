<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\CrudInterface;
use App\Traits\Authorize;
use App\Utils\App;
use Illuminate\Http\Response;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Auth\Access\AuthorizationException;


abstract class BaseController extends Controller
{
  
    protected $repo;

    public function __construct(CrudInterface $repo)
    {
        if(!$this->repo) $this->repo = $repo;
    }

    public function index() {
        return response()->json(app(Pipeline::class)
            ->send($this->repo->all())
            ->through($this->filters())
            ->thenReturn());
    }

    public function store(Request $request) {
        $data = $request->validate($this->repo->model()::storeRules());
        $data['user_id'] = auth()->user()->id;

        $resource = $this->repo->store($data);

        return response()->json($resource[0], $resource[1]);
    }

    public function show($id) {

        $resource = $this->repo->find($id);

         if($resource[1] == Response::HTTP_OK){
            try {
                $this->authorize($resource[0]);
            }catch(AuthorizationException $e) {
                return response()->json(['message' => 'access denied'], Response::HTTP_FORBIDDEN);
            }
            
        }

        return response()->json($resource[0], $resource[1]);
    }


    public function destroy($id) {

        $resource = $this->repo->find($id);

        if($resource[1] == Response::HTTP_OK){
            try {
                $this->authorize($resource[0]);
            }catch(AuthorizationException $e) {
                return response()->json(['message' => 'access denied'], Response::HTTP_FORBIDDEN);
            }
            
        }


        $resource = $this->repo->destroy($id);

         return response()->json($resource[0], $resource[1]);
    }

    public function update($id, Request $request) {
        $data = $request->validate($this->repo->model()::updateRules($id));

        $resource = $this->repo->find($id);

        if($resource[1] == Response::HTTP_OK){
            try {
                $this->authorize($resource[0]);
            }catch(AuthorizationException $e) {
                return response()->json(['message' => 'access denied'], Response::HTTP_FORBIDDEN);
            }
            
        }

        $resource = $this->repo->update($id, $data);


        return response()->json($resource[0], $resource[1]);

    }


    abstract public function filters();

}
