<?php

namespace app\models;

use Yii;
use yii\base\Model;


class LoginForm extends Model // модель для ввода логина и пароля
{
    public $username;
    public $password;
    private $_user = false;

    public function rules() //правила валидации
    {
        return [
            [['username'], 'required', 'message' => 'Введите непустой логин'],
            [['password'], 'required', 'message' => 'Введите непустой пароль'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params) // проверка на правильность ввода пароля
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный формат пароля');
            }
        }
    }
}

