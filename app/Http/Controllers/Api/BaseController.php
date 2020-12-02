<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\RepoInterface;
use App\Traits\Authorize;
use App\Utils\App;
use Illuminate\Http\Response;
use Illuminate\Pipeline\Pipeline;


abstract class BaseController extends Controller
{
  
    protected $repo;

    public function __construct(RepoInterface $repo)
    {
        if(!$this->repo) $this->repo = $repo;
    }

    public function index() {
        return App::paginate(app(Pipeline::class)
            ->send($this->repo->all())
            ->through($this->filters())
            ->thenReturn());
    }

    public function store(Request $request) {
        $data = $request->validate($this->repo->model()::storeRules());

        return App::response($this->repo->store($data));
    }

    public function show($id) {

        $resource = $this->repo->find($id);

        return App::response($resource);
    }


    public function destroy($id) {

        return App::response($this->repo->destroy($id));
    }

    public function update($id, Request $request) {
        $data = $request->validate($this->repo->model()::updateRules($id));

        return App::response($this->repo->update($id, $data));

    }


    abstract public function filters();

}
