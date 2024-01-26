<?php
namespace app\models;

use app\core\Application;
use app\core\db\DBmodel;

class Notas extends DBmodel
{

    public string $id;
    public string $titulo;
    public string $descripcion;
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

    public function delete(): bool
    {
        $tableName = $this->tableName();
        $statement = self::prepare("DELETE FROM $tableName WHERE id=:id");
        $statement->bindValue(":id", $this->id);
        $statement->execute();
        return $statement->rowCount() != 0;

    }

    public function getUserNotes()
    {
        $tableName = $this->tableName();
        $statement = self::prepare("SELECT Notas.id,Notas.titulo,Notas.descripcion,estado.estado,estado.clase FROM Notas LEFT JOIN estado ON $tableName.estado = estado.id WHERE usuario=:id ORDER BY 1");
        $statement->bindValue(":id", Application::$app->user->id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
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
            'titulo' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class], [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 70]],
            'descripcion' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 450]],
            'estado' => [self::RULE_REQUIRED],
        ];
    }
}
