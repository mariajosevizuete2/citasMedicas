<?php
class Controller
{
    public function loadModel($model)
    {
        require_once 'app/models/' . $model . '.php';
        return new $model();
    }
}
