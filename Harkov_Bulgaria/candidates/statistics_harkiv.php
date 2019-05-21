<?php
/**
 * Created by PhpStorm.
 * User: ULITKA
 * Date: 26.04.2019
 * Time: 9:47
 */

$json = file_get_contents("https://of-w.com/wp-json/reset_statistics_harkov/v2");
$statisticInfo = json_decode($json,true);

$statisticDate = $statisticInfo['dateStatistic'];
$statisticCity = $statisticInfo['cityStatistic'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header>

    <h1>
        Статистика по Харькову
    </h1>

</header>
<div class="wrapper">
    <section class="left">
        <div class="row-head">
            <div class="string">Дата</div>
            <div class="value">Кол-во</div>
        </div>
        <?php

        foreach ($statisticDate as $stat){

            ?>
            <div class="row">
                <div class="string"><?=$stat['date']?></div>
                <div class="value"><?=$stat['count']?></div>
            </div>
            <?php
        } ?>

    </section>
<!--    <section class="right">-->
<!--        <div class="row-head">-->
<!--            <div class="string">Город</div>-->
<!--            <div class="value">Кол-во</div>-->
<!--        </div>-->
<!--        --><?php
//
//        foreach ($statisticCity as $stat){
//
//            ?>
<!--            <div class="row">-->
<!---->
<!--                --><?php //if ($stat['city'] == ''){
//                    $stat['city']= 'Не указан';
//                }?>
<!--                <div class="string">--><?//=$stat['city']?><!--</div>-->
<!--                <div class="value">--><?//=$stat['countCity']?><!--</div>-->
<!--            </div>-->
<!--            --><?php
//        } ?>
<!---->
<!---->
<!--    </section>-->
</div>

</body>

</html>
