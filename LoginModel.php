<?php

namespace app\models;
use yii\db\ActiveRecord;


class Login extends  ActiveRecord{  // модель для таблицы user из бд

    public static function tableName(){ // возвращает верное название таблицы в бд
        return 'users';
    }

    public static function getA($login, $password){  // функция принимает логин и пароль и возвращает объект, в котором данные по пользователю, имеющему эти логин и пароль
        $data = self::find()->where(['login'=>$login,'password'=>$password])->one();
        return $data;
    }

}