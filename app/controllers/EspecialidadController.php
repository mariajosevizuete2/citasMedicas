<?php

class EspecialidadController
{
    private $model;

    public function __construct($pdo)
    {
        $this->model = new EspecialidadModel($pdo);
    }
}
