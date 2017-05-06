<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form=ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?=$form->field($model,'title')->textInput()->label('Введите название компании') ?>
    </div>
    <div class="col-md-12">
        <?=Html::submitButton('Создать',['class'=>'btn btn-success', 'name' => 'Addcompany']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
