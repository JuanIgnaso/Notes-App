<?php

namespace app\models;

use juanignaso\phpmvc\framework\db\DBmodel;

class Estado extends DBmodel
{

    public string $id;
    public string $estado;
    public string $clase;


    public function tableName(): string
    {
        return 'estado';
    }

    public function attributes(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }

    public function primaryKey(): string
    {
        return 'id';
    }
}