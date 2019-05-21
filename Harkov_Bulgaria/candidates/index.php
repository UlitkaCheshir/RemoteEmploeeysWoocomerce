<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="main.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Кандидаты Болгария</title>
    <script defer src="./js/candidates.js" ></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
</head>
<body>
<section class="sec-table">
    <h1 style="text-align: center; font-size: 30px">Кандидаты по Болгарии</h1>
    <div class="flex-button">
        <div  id="writeFile" class="button24 top">
            Записать в файл
        </div>
        <div  id="statistic" class="button24 top">
            Статистика
        </div>
        <div  id="toExcel" class="button24 top">
            Скачать в Excel
        </div>
        <div  id="toHarkiv" class="button24 top">
            Кандидаты Харькова
        </div>
    </div>
    <div id="noinDB" class="inDB"  style="display: none">

    </div>
    <?php
    $limit = 50;
    $offset = 0;
    $json = file_get_contents("https://of-w.com/wp-json/reset_get_candidate/v2?limit={$limit}&offset={$offset}");
    $userInfo = json_decode($json,true);

    $json = file_get_contents('https://of-w.com/wp-json/reset_get_status_candidate/v2');
    $statuses_candidate = json_decode($json,true);

    $json = file_get_contents('https://of-w.com/wp-json/reset_get_hotels/v2');
    $hotels = json_decode($json,true);

    ?>
    <table class="table">
        <tr class="options bold">
            <td>Дата</td>
            <td>Ф.И.О</td>
            <td>Город</td>
            <td>Возраст</td>
            <td>Должность</td>
            <td>Знание английского</td>
            <td>Знание немецкого</td>
            <td>Наличие паспорта</td>
            <td>Опыт работы или личные качества</td>
            <td>Номер телефона</td>
            <td><label style="width: 300px">Email</label></td>
            <td>Фото</td>
            <td>Ссылка на соц. сеть</td>
            <td>Откуда вы узнали</td>
            <td><label for="prof-select">Статус</label></td>
            <td>Отель</td>
            <td>Комментарий</td>
        </tr>

        <?php
            foreach ( $userInfo as $user ) {
                $classStatus = "";

                if($user["status_id"] === $statuses_candidate[0]['id']){
                    $classStatus = 'white';
                }else if($user["status_id"] === $statuses_candidate[1]['id']){
                    $classStatus = 'light-green';
                }else if($user["status_id"] === $statuses_candidate[2]['id']){
                    $classStatus = 'dark-green';

                }else if($user["status_id"] === $statuses_candidate[4]['id']){
                    $classStatus = 'blue';

                }
                else{
                    $classStatus = 'red';
                }
                ?>
                <tr data-candidate-id ="<?=$user['id']?>"  data-status-id ="<?=$user['status_id']?>" data-hotel-id ="<?=$user['hotel_id']?>" class="values <?=$classStatus?>">
                    <td><?= $user['date'] ?></td>
                    <td><?= $user['FIO'] ?></td>
                    <td><?= $user['city'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <td><?= $user['positions'] ?></td>
                    <td><?= $user['langsEN'] ?></td>
                    <td><?= $user['langsDE'] ?></td>
                    <td><?= $user['passport'] ?></td>
                    <td class="moreText"> <div class="short">
                            <?= $user['experience'] ?>
                        </div>
                        <div class="showText">
                            <span id="exit">X</span>
                            <?= $user['experience'] ?>
                        </div>
                    </td>
                    <td><?= $user['phone']?></td>
                    <td class="email"><?= $user['email']?></td>
                    <td><img src="<?= $user['photo']?>" alt="No image" width="100" height="75"></td>
                    <td class="word-break">
                        <?php
                        if(strlen(str_replace("\r\n ", "",$user['websait']))>0){ ?>
                            <a target="_blank" href="<?=$user['websait']?>">Link</a>
                        <?php
                        }
                        ?>

                    </td>
                    <td style="width: 200px"><?= $user['about']?></td>
                    <td>
                        <select id="statusCandidates" name="prof-select" style="width: 100px">
                            <?php
                            foreach ( $statuses_candidate as $status ) {
                                ?>
                                <option value="<?=$status['id']?>" data-status-id = <?=$status['id']?>><?=$status['title']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td >
                        <select id="hotel" name="prof-select" style="width: 100px">
                            <?php
                            foreach ( $hotels as $hotel ) {
                                ?>
                                <option value="<?=$hotel['id']?>" data-hotel-id = <?=$hotel['id']?>><?=$hotel['title']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>

                    <td class="comment">
                        <textarea id="description" name="comment" cols="30" rows="10"><?= $user['description']?></textarea>
                    </td>
                </tr>
                <?php
            }
        ?>

    </table>

    <div style="margin: 20px auto" id="MoreCandidate" class="button24">ЕЩЕ</div>
</section>
</body>
</html>