<?php
namespace App\Action;

class StoreAction
{
    protected $model;
    protected $data;
    
    public function __construct($data, $model)
    {
        $this->data = $data;
        $this->model = $model;
    }

    public function action()
    {
        $isSave = true;
        $data = $this->data;
        $model = $this->model;

        $isSave *= (bool)$model->create($data);
        return $isSave;
    }
}