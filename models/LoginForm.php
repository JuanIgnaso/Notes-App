<?php

namespace app\models;

use juanignaso\phpmvc\framework\Application;
use juanignaso\phpmvc\framework\Model;
use juanignaso\phpmvc\framework\Usuario;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';
    public ?string $checked;

    public function login()
    {
        $model = new Usuario();
        $usuario = $model->findOne(['email' => $this->email]);


        if (!$usuario) {
            $this->addError('email', 'No existe actualmente ningún usuario con este email');
            return false;
        }
        if (password_verify($this->password, $usuario->password)) {
            return Application::$app->login($usuario);
        } else {
            $this->addError('password', 'Contraseña incorrecta.');
            return false;
        }
    }

    public function rules(): array
    {
        return [
            'email' => [
                [self::RULE_REQUIRED, 'campo' => $this->getLabel('email')],
                self::RULE_EMAIL
            ],
            'password' => [
                [self::RULE_REQUIRED, 'campo' => $this->getLabel('password')]
            ],
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