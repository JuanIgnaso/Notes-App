<?php
namespace app\models;

use app\core\Application;
use app\core\db\DBmodel;

class Notas extends DBmodel
{

    public string $id;
    public string $titulo = '';
    public string $descripcion = '';
    public int $estado = 1;
    public int $importante = 0;
    public string $usuario;

    public function save()
    {
        $this->usuario = Application::$app->user->id;
        return parent::save();
    }

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
