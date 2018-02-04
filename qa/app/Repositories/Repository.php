<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DatatableAttribute;

abstract class Repository
{
    protected $model;

    use DatatableAttribute;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getRouteName()
    {
        return $this->model->route_resource?:$this->model->getTable();
    }

    public function find($id) {
        return $this->model->findOrFail($id);findOrFail($id);
    }

    public function save($id, $data)
    {
        $class = get_class($this->model);
        $object = (is_null($id)) ? new $class() : $class::find($id);
        $object->fill($data);
        $object->save();
        return $object;
    }

    public function deleteAll($ids)
    {
        $this->model->destroy($ids);
    }

}
