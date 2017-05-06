<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;


class Personal extends ActiveRecord{  //модель для таблицы сотрудников

    public function rules(){  // правила валидации
        return [
            [['name'], 'required', 'message' => 'Введите имя'],
            [['position'], 'required', 'message' => 'Введите должность'],
        ];
    }

    public static function tableName(){  //возвращает правлиьное название таблицы
        return 'sotrudniki';
    }

    public static function getAll(){ //возвращает всю таблицу
        $data = self::find()->all();
        return $data;
    }

    public static function getOne($id){ //только одну строку по айди
        $data = self::find()->where(['id_sotr'=>$id])->one();
        return $data;
    }

    public function getWork(){  // задать свять с таблице Work как один ко многим
        return $this->hasMany(Work::className(),['id_sotr' => 'id_sot']);
    }
} 