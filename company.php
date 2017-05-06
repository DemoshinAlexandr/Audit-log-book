<h2><a href="<?= \yii\helpers\Url::to(['site/personal'])?>" class="btn btn-primary">Сотрудники</a>
    <button class="btn">Компании</button>
    <a href="<?= \yii\helpers\Url::to(['site/work'])?>" class="btn btn-primary">Работа</a>
</h2>
<a href="<?= \yii\helpers\Url::to(['site/addcompany'])?>" class="btn btn-success">Добавить компанию</a>

<?php $session = Yii::$app->session; $language = $session->get('language'); echo $language; ?>

<table class="table">
    <thead>
    <tr>
        <td>Название</td>
    </tr>
    </thead>
    <tbody>
    <?php  foreach ($model as $item): ?>
        <tr>
            <td><?= $item['title'] ?></td>
            <td>
                <a href="<?= \yii\helpers\Url::to(['site/editcompany','id' => $item['id_comp']])?>">Редактировать</a>
                <a href="<?= \yii\helpers\Url::to(['site/deletecompany','id' => $item['id_comp']])?>">Удалить</a>
            </td>
        </tr>
    <?php endForeach ?>
    </tbody>
</table>