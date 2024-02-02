<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';
    public ?string $checked;

    public function login()
    {
        $remember = false;
        $model = new Usuario();
        $usuario = $model->findOne(['email' => $this->email]);


        if (!$usuario) {
            $this->addError('email', 'No existe actualmente ningún usuario con este email');
            return false;
        }
        //Comprobar si tiene marcado o no el remember me y si tiene o no token.
        //Si no está marcado hacer lo del password_verify
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
                [self::RULE_REQUIRED, 'campo' => 'Email'],
                self::RULE_EMAIL
            ],
            'password' => [
                [self::RULE_REQUIRED, 'campo' => 'Contraseña']
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