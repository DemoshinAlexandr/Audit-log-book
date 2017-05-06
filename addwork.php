<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


if(isset($model->date_begin))
    $a=$model->date_begin;
else {
    $a= '';}
if(isset($model->date_end))
    $b=$model->date_end;
else {
    $b='';
}
?>

<?php $form=ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?php
        $items = ArrayHelper::map($personal,'id_sotr','name');
        $param = ['options' =>[ 'id_sot' => ['Selected' => true]]];
        echo $form->field($model, 'id_sot')->dropDownList($items, $param)->label('Сотрудники');
        ?>
    </div>
    <div class="col-md-6">
        <?php
        $items = ArrayHelper::map($company,'id_comp','title');
        $param = ['options' =>[ 'id_com' => ['Selected' => true]]];
        echo $form->field($model, 'id_com')->dropDownList($items, $param)->label('Компании');
        ?>
    </div>
    <div class="col-md-6">
        Дата начала: С <input type='date' id='dateStart' name='dateStart' value="<?php echo $a;?>">
    </div>
    <div class="col-md-6">
        По <input type='date' id='dateFinish' name='dateFinish' value="<?php echo $b;?>">
    </div>
    <div class="col-md-12">
        <?=Html::submitButton('Создать',['class'=>'btn btn-success', 'name' => 'Addwork']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
