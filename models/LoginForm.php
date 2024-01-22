<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function login()
    {
        $model = new Usuario();
        $usuario = $model->findOne(['email' => $this->email]);
        if (!$usuario) {
            $this->addError('email', 'No existe actualmente ningún usuario con este email');
            return false;
        }
        if (!password_verify($this->password, $usuario->password)) {
            $this->addError('password', 'Contraseña incorrecta.');
            return false;
        }
        return Application::$app->login($usuario);
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'usuarios';
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Contraseña',
        ];
    }
}