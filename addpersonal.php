<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form=ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?=$form->field($model,'name')->textInput()->label('Введите имя сотрудника') ?>
    </div>
    <div class="col-md-6">
        <?=$form->field($model,'position')->textInput()->label('Введите должность сотрудника') ?>
    </div>
    <div class="col-md-12">
        <?=Html::submitButton('Создать',['class'=>'btn btn-success', 'name' => 'Addpersonal']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
