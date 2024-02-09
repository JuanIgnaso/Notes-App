<?php
namespace app\models;

use juanignaso\phpmvc\framework\Application;
use juanignaso\phpmvc\framework\db\DBmodel;

class Notas extends DBmodel
{

    public string $id = '';
    public string $titulo = '';
    public string $descripcion;
    public string $estado = '1';
    public string $importante = '0';
    public string $usuario;
    public ?array $estados = null;
    const TABLE_NAME = 'Notas';

    private const SELECT_ALL = "SELECT Notas.id,Notas.titulo,Notas.importante,Notas.descripcion,estado.estado,estado.clase FROM " . self::TABLE_NAME . " LEFT JOIN estado ON " . self::TABLE_NAME . ".estado = estado.id ";


    public function __construct()
    {
        $this->usuario = Application::$app->user->id;
    }

    public function save()
    {
        if (!isset($this->importante)) {
            $this->importante = '0';
        }
        return parent::save();
    }

    public function delete(): bool
    {

        $statement = self::prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id=:id AND usuario=:usuario");
        $statement->bindValue(":id", $this->id);
        $statement->bindValue(":usuario", Application::$app->user->id);
        $statement->execute();
        return $statement->rowCount() != 0;

    }

    public function update()
    {
        $attributes = $this->attributes();
        if (!isset($this->importante)) {
            $this->importante = '0';
        }

        $params = array_map(fn($attr) => "$attr=:$attr", $attributes);
        $statement = self::prepare("UPDATE " . self::TABLE_NAME . " SET " . implode(',', $params) . " WHERE id=:id");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->bindValue(":id", $this->id);
        return $statement->execute();

    }

    public function tableName(): string
    {
        return 'Notas';
    }
    public function getByTitle()
    {
        $conditions = $this->filter()['conditions'];
        $parameters = $this->filter()['parameters'];

        if (count($parameters) != 0) {
            $statement = self::prepare(self::SELECT_ALL . " WHERE " . implode(" AND ", $conditions) . " AND  usuario=" . Application::$app->user->id . " ORDER BY 1");
            $statement->execute($parameters);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return $this->getUserNotes();
        }
    }


    private function filter(): array
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
        if (isset($this->titulo) && strlen(trim($this->titulo)) != 0) {
            $conditions[] = 'titulo LIKE :titulo';
            $parameters['titulo'] = "%" . $this->titulo . "%";
        }
        if (isset($this->importante)) {
            $conditions[] = 'importante = :importante';
            $parameters['importante'] = $this->importante;
        }

        return [
            'conditions' => $conditions,
            'parameters' => $parameters
        ];
    }

    public function markImportant(): bool
    {
        $mark = $this->importante == 0 ? 1 : 0;
        $statement = self::prepare("UPDATE " . self::TABLE_NAME . " SET importante=:mark WHERE id=:id AND usuario=:usuario");
        $statement->bindValue(":mark", $mark);
        $statement->bindValue(":id", $this->id);
        $statement->bindValue(":usuario", Application::$app->user->id);
        $statement->execute();
        return $statement->rowCount() != 0;
    }


    public function getUserNotes()
    {

        $statement = self::prepare(self::SELECT_ALL . " WHERE usuario=:id ORDER BY 1");
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

    public function getNote()
    {
        $statement = self::prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id=:id AND usuario=:usuario");
        $statement->bindValue(":id", $this->id);
        $statement->bindValue(":usuario", $this->usuario);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
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
            'titulo' => [
                [self::RULE_REQUIRED, 'campo' => $this->getLabel('titulo')],
                [self::RULE_MIN, 'campo' => 'Titulo', 'min' => 5],
                [self::RULE_MAX, 'campo' => 'Titulo', 'max' => 70]
            ],

            'descripcion' => [
                [self::RULE_REQUIRED, 'campo' => $this->getLabel('descripcion')],
                [self::RULE_MIN, 'campo' => 'Descripción', 'min' => 5],
                [self::RULE_MAX, 'campo' => 'Descripción', 'max' => 450]
            ],

            'estado' => [[self::RULE_REQUIRED, 'campo' => $this->getLabel('estado')]],
        ];
    }

    public function labels(): array
    {
        return [
            'titulo' => 'Titulo',
            'estado' => 'Estado',
            'descripcion' => 'Descripción',
        ];
    }
}
