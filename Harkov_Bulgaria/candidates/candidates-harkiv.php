<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mainH.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Кандидаты Харьков</title>

    <script defer src="js/candidates_harkkov.js" ></script>
    <script  src="js/jquery-3.4.0.min.js" ></script>
    <script  src="js/jquery.cookie.js" ></script>


    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
</head>

<body>
<section class="sec-table">
    <h1 style="text-align: center; font-size: 30px">Кандидаты по Харькову</h1>
    <div class="flex-button">
        <div  id="statistic" class="button24 top">
            Статистика
        </div>

        <div  id="toBulgaria" class="button24 top">
            Кандидаты Болгария
        </div>

    </div>
    <div id="noinDB" class="inDB"  style="display: none">

    </div>
    <?php
    $limit = 50;
    $offset = 0;
    $json = file_get_contents("https://of-w.com/wp-json/reset_get_candidate_harkov/v2?limit={$limit}&offset={$offset}");
    $userInfo = json_decode($json,true);

    $json = file_get_contents('https://of-w.com/wp-json/reset_get_status_candidate_harkov/v2');
    $statuses_candidate = json_decode($json,true);

    ?>
    <table class="table">
        <tr class="options bold">
            <td>Дата</td>
            <td>Ф.И.О</td>
            <td>Возраст</td>
            <td>Должность</td>
            <td>Знание английского</td>
            <td>Номер телефона</td>
            <td><label for="prof-select">Статус</label></td>
            <td>Комментарий</td>
        </tr>

        <?php
            foreach ( $userInfo as $user ) {
                $classStatus = "";

                if($user["status_id"] === $statuses_candidate[0]['id']){
                    $classStatus = 'white';
                }else if($user["status_id"] === $statuses_candidate[2]['id']){
                    $classStatus = 'dark-green';
                }
                else{
                    $classStatus = 'red';
                }
                ?>
                <tr data-candidate-id ="<?=$user['id']?>"  data-status-id ="<?=$user['status_id']?>"  class="values <?=$classStatus?>">
                    <td><?= $user['date'] ?></td>
                    <td><?= $user['FIO'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <td><?= $user['positions'] ?></td>
                    <td><?= $user['langsEN'] ?></td>
                    <td><?= $user['phone']?></td>
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