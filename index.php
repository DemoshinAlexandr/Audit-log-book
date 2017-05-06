<?php
if(isset($dateStart))
    $a=$dateStart;
else {
     $a= '';}
if(isset($dateFinish))
    $b=$dateFinish;
else {
    $b='';
}

function readableDay($date)
{
    if (empty($date)) return "Дата не определена";
    $Year=mb_substr($date,0,4,'UTF-8');
    $Month=mb_substr($date,5,2,'UTF-8');
    $Day=mb_substr($date,8,2,'UTF-8');
    if($Month==01) {$Month='января';}
    elseif($Month==02) {$Month='февраля';}
    elseif($Month==03) {$Month='марта';}
    elseif($Month==04) {$Month='апреля';}
    elseif($Month==05) {$Month='мая';}
    elseif($Month==06) {$Month='июня';}
    elseif($Month==07) {$Month='июля';}
    elseif($Month=='08') {$Month='августа';}
    elseif($Month=='09') {$Month='сентября';}
    elseif($Month==10) {$Month='октября';}
    elseif($Month==11) {$Month='ноября';}
    elseif($Month==12) {$Month='декабря';}
    $date=$Day." ".$Month." ".$Year."г";
    return $date;
}
?>

<form>
    <table>
        <tr>
            <td>
                <div style="margin: 10px;">
                   Дата начала: С <input type='date' id='dateStart' name='dateStart' value="<?php echo $a;?>">
                </div>
            <td align="center">
            <td>
                <div style="margin: 10px;">
                    По <input type='date' id='dateFinish' name='dateFinish' value="<?php echo $b;?>">
                </div>
            </td>
            <td>
                <div style="margin: 10px;">
                <select name = "id_sotr" id = "id_sotr">';
                    <option value = "0">Сотрудник</option>';
                    <?php foreach ($personals as $person): ?>
                        <option <?php if (isset($name_sotr) && ($name_sotr->name == $person->name)) echo 'selected';?> value="<?=$person->id_sotr?>"> <?php echo $person->name?></option>
                    <?php endforeach ?>
                </select>
                </div>
            </td>
            <td>
                <div style="margin: 10px;">
                <select name = "id_comp" id = "id_comp">';
                    <option value = "0">Компания</option>';
                    <?php foreach ($companies as $company): ?>
                        <option <?php if (isset($name_comp) && ($name_comp->title == $company->title)) echo 'selected';?> value="<?=$company->id_comp?>"> <?php echo $company->title?></option>
                    <?php endforeach ?>
                </select>
               </div>
            </td>
        </tr>
    </table>
    <div style="text-align: center; ">
        <input type="submit" name="go" value="Просмотреть" class="btn btn-success" /> <br> <br>
    </div>
</form>

<table class="table big_table table-striped table-bordered table-hover">
    <thead class="tit sort" >
    <tr>
        <td>Сотрудник</td>
        <td>Дожность</td>
        <td>Компания</td>
        <td>Текущий статус</td>
        <td>Дата начала аудита</td>
        <td>Дата окончания аудита</td>
    </tr>
    </thead>
    <tbody >
    <?php foreach ($model as $item): ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['position'] ?></td>
            <td><?= $item['title'] ?></td>
            <td><?= $item['status'] ?></td>
            <td><?= readableDay($item['date_begin']) ?></td>
            <td><?= readableDay($item['date_end']) ?></td>
        </tr>
    <?php endForeach ?>
    </tbody>
</table>