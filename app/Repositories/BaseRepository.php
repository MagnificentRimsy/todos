<?php

namespace App\Repositories;

use App\Contracts\RepoInterface;
use Exception;
use Illuminate\Http\Response;

class BaseRepository implements RepoInterface {

    protected $facade;

    /**
     * Constructor
     *
     * @param $facade
     */
    public function __construct($facade) {
        $this->facade = $facade;
    }

    /**
     * store resource
     *
     * @param array $data
     * @return array
     */
    public function store(array $data)
    {
        try{
            $resource = $this->facade::store($data);

        }catch(Exception $e) {
            logger($e);
            return ["Error saving resource", Response::HTTP_INTERNAL_SERVER_ERROR];
        }

        return [$resource, Response::HTTP_CREATED];
    }

    /**
     * Find resource
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $resource = $this->facade::find($id);

        if(!$resource) {
            return ["Resource not found", Response::HTTP_NOT_FOUND];
        }

        return [$resource, Response::HTTP_OK];
    }

    /**
     * Delete resource
     *
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $resource = $this->facade::destroy($id);

        if(!$resource) {
            return ["Resource not found", Response::HTTP_NOT_FOUND];
        }

        return ["Resource deleted", Response::HTTP_NO_CONTENT];
    }

    /**
     * Update resource
     *
     * @param $id
     * @param array $data
     */
    public function update($id, array $data)
    {
        $resource = $this->facade::update($id, $data);

        if(!$resource) {
            return ["Resource not found", Response::HTTP_NOT_FOUND];
        }

        return [$resource, Response::HTTP_OK];

    }

    /**
     * Get resources
     *
     * @return mixed
     */
    public function all()
    {
        return $this->facade::all();
    }

    public function model() {
        return $this->facade::model();
    }
}
