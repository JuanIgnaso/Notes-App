<?php
namespace app\models;

use app\core\Application;
use app\core\db\DBmodel;

class Notas extends DBmodel
{

    public string $id;
    public string $titulo = '';
    public string $descripcion;
    public int $estado = 1;
    public int $importante = 0;
    public string $usuario;
    const TABLE_NAME = 'Notas';

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

        $statement = self::prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id=:id");
        $statement->bindValue(":id", $this->id);
        $statement->execute();
        return $statement->rowCount() != 0;

    }

    public function getByTitle()
    {
        $statement = self::prepare("SELECT Notas.id,Notas.titulo,Notas.descripcion,estado.estado,estado.clase FROM " . self::TABLE_NAME . " LEFT JOIN estado ON " . self::TABLE_NAME . ".estado = estado.id WHERE titulo LIKE :titulo ORDER BY 1");
        $statement->bindValue(":titulo", "%" . $this->titulo . "%");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return !$result || count($result) == 0 ? $this->getUserNotes() : $result;

    }


    public function getUserNotes()
    {

        $statement = self::prepare("SELECT Notas.id,Notas.titulo,Notas.descripcion,estado.estado,estado.clase FROM " . self::TABLE_NAME . " LEFT JOIN estado ON " . self::TABLE_NAME . ".estado = estado.id WHERE usuario=:id ORDER BY 1");
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
