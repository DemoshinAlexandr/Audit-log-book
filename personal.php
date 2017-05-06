<h2><button class="btn">Сотрудники</button>
    <a href="<?= \yii\helpers\Url::to(['site/company'])?>" class="btn btn-primary">Компании</a>
    <a href="<?= \yii\helpers\Url::to(['site/work'])?>" class="btn btn-primary">Работа</a>
</h2>
<a href="<?= \yii\helpers\Url::to(['site/addpersonal'])?>" class="btn btn-success">Добавить сотрудника</a>

<?php $session = Yii::$app->session; $language = $session->get('language'); echo $language; ?>

<table class="table">
    <thead>
    <tr>
        <td>Имя</td>
        <td>Должность</td>
    </tr>
    </thead>

    <tbody>
    <?php  foreach ($model as $item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['position'] ?></td>
            <td>
                <a href="<?= \yii\helpers\Url::to(['site/editpersonal','id' => $item['id_sotr']])?>">Редактировать</a>
                <a href="<?= \yii\helpers\Url::to(['site/deletepersonal','id' => $item['id_sotr']])?>">Удалить</a>
            </td>
        </tr>
    <?php endForeach ?>
    </tbody>
</table>