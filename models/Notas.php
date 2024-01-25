<?php
namespace app\models;

use app\core\db\DBmodel;

class Notas extends DBmodel
{

    public string $titulo = '';
    public string $descripcion = '';
    public string $estado;
    public string $importante;
    public string $usuario;

    public function tableName(): string
    {
        return 'Notas';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['titulo', 'descripcion', 'estado', 'importante', 'usuario'];
    }

    public function rules(): array
    {
        return [
            'titulo' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 70]],
            'descripcion' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 450]],
            'estado' => [self::RULE_REQUIRED],
        ];
    }
}
