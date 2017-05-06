<?php


namespace app\models;

use yii\db\ActiveRecord;


class Company extends ActiveRecord{ // модель для таблицы компаний из бд

    public function rules(){  //правила валидации
        return [
            [['title'], 'required', 'message' => 'Введите название'],
        ];
    }

    public static function tableName(){  //возвращает верное название таблицы
        return 'company';
    }

    public static function getOne($id){  //возвращает одну строчку из бд по айди
        $data = self::find()->where(['id_comp'=>$id])->one();
        return $data;
    }

    public static function getAll(){  //всю таблицу
        $data = self::find()->all();
        return $data;
    }

    public function getWork(){  // задать свять с таблице Work как один ко многим
        return $this->hasMany(Work::className(),['id_comp' => 'id_com']);
    }
} 