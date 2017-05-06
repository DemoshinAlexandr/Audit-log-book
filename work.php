<h2><a href="<?= \yii\helpers\Url::to(['site/personal'])?>" class="btn btn-primary">Сотрудники</a>
    <a href="<?= \yii\helpers\Url::to(['site/company'])?>" class="btn btn-primary">Компании</a>
    <button class="btn">Работа</button>
</h2>
<a href="<?= \yii\helpers\Url::to(['site/addwork'])?>" class="btn btn-success">Добавить работу</a>

<?php $session = Yii::$app->session; $language = $session->get('language'); echo $language; ?>

<table class="table">
    <thead>
    <tr>
        <td>Сотрудник</td>
        <td>Дожность</td>
        <td>Компания</td>
        <td>Текущий статус</td>
        <td>Дата начала аудита</td>
        <td>Дата окончания аудита</td>
    </tr>
    </thead>

    <tbody>
    <?php  foreach ($model as $item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['position'] ?></td>
            <td><?= $item['title'] ?></td>
            <td><?= $item['status'] ?></td>
            <td><?= $item['date_begin'] ?></td>
            <td><?= $item['date_end'] ?></td>
            <td>
                <a href="<?= \yii\helpers\Url::to(['site/editwork','id' => $item['id_work']])?>">Редактировать</a>
                <a href="<?= \yii\helpers\Url::to(['site/deletework','id' => $item['id_work']])?>">Удалить</a>
            </td>
        </tr>
    <?php endForeach ?>
    </tbody>
</table>