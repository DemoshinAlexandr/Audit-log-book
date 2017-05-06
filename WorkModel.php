<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Work extends ActiveRecord{ //модель для таблицы Работа

    public static function tableName(){ //верное название таблицы
        return 'work';
    }

    public function rules(){ //правила валидации
        return [
            [['id_sot'], 'required', 'message' => 'Выберите сотрудника'],
            [['id_com'], 'required', 'message' => 'Выберите компанию'],
        ];
    }


    public static  function ClassicJoin(){ //запрос к базе, для объединения трех таблиц
        $query = new Query;
        $query	->select(['*'])
            ->from('work')
            ->leftJoin('sotrudniki', 'work.id_sot=sotrudniki.id_sotr')
            ->leftJoin('company', 'work.id_com=company.id_comp')
            ->leftJoin('status', 'work.id_status=status.id_status');
        $command = $query->createCommand();
        $data = $command->queryAll();
        return $data;
    }

    public static  function ClassicJoinWhere($id_sotr, $id_comp, $dateStart, $dateFinish){  //запрос к базе,
        $query = new Query;                                                             //где данные выбираются с учетом параметров
        $where1 = [];
        $where2 = [];
        $where3 = [];
        if ($id_sotr > 0) $where1['work.id_sot'] = $id_sotr;
        if ($id_comp > 0) $where1['work.id_com'] = $id_comp;
        if ($dateStart > 0) $where2 = ['>=','date_begin', $dateStart];
        if ($dateFinish > 0) $where3 = ['<=','date_begin', $dateFinish];
        $query	->select(['*'])
            ->from('work')
            ->leftJoin('sotrudniki', 'work.id_sot=sotrudniki.id_sotr')
            ->leftJoin('company', 'work.id_com=company.id_comp')
            ->leftJoin('status', 'work.id_status=status.id_status')
            ->Where($where1)->andwhere($where2)->andWhere($where3);
        $command = $query->createCommand();
        $data = $command->queryAll();
        return $data;
    }

    public static function getOne($id){ //одна строка
        $data = self::find()->where(['id_work'=>$id])->one();
        return $data;
    }
} 