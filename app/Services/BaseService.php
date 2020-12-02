<?php

namespace App\Services;


abstract class BaseService {

    /**
     * Model associated with service
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     *
     * @param $model
     */
    public function __construct($model){
        $this->model = $model;
    }

    /**
     * Returns a query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function all() {
        return $this->model::query();
    }

    /**
     * store resource
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data) {
        return $this->model::create($data);
    }

    /**
     * update resource matching id
     *
     * @param $id
     * @param array $data
     */
    public function update($id, array $data) {
        $resource = $this->find($id);

        if(!$resource) {
            return false;
        }

        $resource->update($data);

        return $resource->fresh();
    }

    /**
     * delete resource matching id
     *
     * @param $id
     * @return boolean
     *
     */
    public function destroy($id) {
        $resource = $this->find($id);

        if(!$resource) {
            return false;
        }

        $resource->delete();

        return true;
    }

    /**
     * Find a resource matching id
     *
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->model::find($id);
    }

    public function model() {
        return $this->model;
    }

}
