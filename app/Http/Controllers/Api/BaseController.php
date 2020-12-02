<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\CrudInterface;
use App\Traits\Authorize;
use App\Utils\App;
use Illuminate\Http\Response;
use Illuminate\Pipeline\Pipeline;


abstract class BaseController extends Controller
{
  
    protected $repo;

    public function __construct(CrudInterface $repo)
    {
        if(!$this->repo) $this->repo = $repo;
    }

    public function index() {
        return app(Pipeline::class)
            ->send($this->repo->all())
            ->through($this->filters())
            ->thenReturn();
    }

    public function store(Request $request) {
        $data = $request->validate($this->repo->model()::storeRules());
        $data['user_id'] = 1;

        $resource = $this->repo->store($data);

        return response()->json($resource[0], $resource[1]);
    }

    public function show($id) {

        $resource = $this->repo->find($id);

        return response()->json($resource[0], $resource[1]);
    }


    public function destroy($id) {

        $resource = $this->repo->destroy($id);

         return response()->json($resource[0], $resource[1]);
    }

    public function update($id, Request $request) {
        $data = $request->validate($this->repo->model()::updateRules($id));

        $resource = $this->repo->update($id, $data);

        return response()->json($resource[0], $resource[1]);

    }


    abstract public function filters();

}
