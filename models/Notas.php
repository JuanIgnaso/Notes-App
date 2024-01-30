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
    public ?array $estados = null;
    const TABLE_NAME = 'Notas';


    public function __construct()
    {
        $this->usuario = Application::$app->user->id;
    }

    public function save()
    {
        return parent::save();
    }

    public function tableName(): string
    {
        return 'Notas';
    }

    public function delete(): bool
    {

        $statement = self::prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id=:id AND usuario=:usuario");
        $statement->bindValue(":id", $this->id);
        $statement->bindValue(":usuario", Application::$app->user->id);
        $statement->execute();
        return $statement->rowCount() != 0;

    }

    public function getByTitle()
    {
        $conditions = [];
        $parameters = [];

        //Cargar estados
        if ($this->estados != null && count($this->estados) != 0) {
            $contador = 1;
            $conditionsEstado = [];
            foreach ($this->estados as $estado) {
                $conditionsEstado[] = ':estado' . $contador;
                $parameters['estado' . $contador] = (int) $estado;
                $contador++;
            }
            if (count($parameters) > 0) {
                $conditions[] = ' Notas.estado IN (' . implode(',', $conditionsEstado) . ')';
            }
        }
        //Si el usuario ha escrito un titulo
        if (isset($this->titulo)) {
            $conditions[] = 'titulo LIKE :titulo';
            $parameters['titulo'] = "%" . $this->titulo . "%";
        }
        if (count($parameters) != 0) {
            $statement = self::prepare("SELECT Notas.id,Notas.titulo,Notas.descripcion,estado.estado,estado.clase FROM " . self::TABLE_NAME . " LEFT JOIN estado ON " . self::TABLE_NAME . ".estado = estado.id WHERE " . implode(" AND ", $conditions) . " AND  usuario=" . Application::$app->user->id . " ORDER BY 1");

            //echo "SELECT Notas.id,Notas.titulo,Notas.descripcion,estado.estado,estado.clase FROM " . self::TABLE_NAME . " LEFT JOIN estado ON " . self::TABLE_NAME . ".estado = estado.id WHERE " . implode(" AND ", $conditions) . " ORDER BY 1";
            $statement->execute($parameters);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return $this->getUserNotes();
        }
    }


    public function getUserNotes()
    {

        $statement = self::prepare("SELECT Notas.id,Notas.titulo,Notas.descripcion,estado.estado,estado.clase FROM " . self::TABLE_NAME . " LEFT JOIN estado ON " . self::TABLE_NAME . ".estado = estado.id WHERE usuario=:id ORDER BY 1");
        $statement->bindValue(":id", Application::$app->user->id);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNoteTitleList()
    {
        $statement = self::prepare("SELECT titulo FROM " . self::TABLE_NAME . " WHERE titulo LIKE :titulo AND usuario=:usuario ORDER BY 1");
        $statement->bindValue(":titulo", "%" . $this->titulo . "%");
        $statement->bindValue(":usuario", Application::$app->user->id);
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
