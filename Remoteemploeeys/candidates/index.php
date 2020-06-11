<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="main.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Кандидаты RemoteEmployees</title>
    <link rel="stylesheet" type="text/css" href="css/autorisation.css" />
    <script defer src="js/candidates_table.js" ></script>
    <script defer src="js/authorize.js" ></script>
    <script  src="js/jquery-3.4.0.min.js" ></script>
    <script  src="js/jquery.cookie.js" ></script>


    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
</head>

<body>
<section class="sec-table">
    <h1 style="text-align: center; font-size: 30px">Кандидаты по RemoteEmployees</h1>
    <div class="flex-button">
        <div  id="statistic" class="button24 top">
            Статистика
        </div>
    </div>
    <div id="noinDB" class="inDB"  style="display: none">

    </div>
    <?php
    $limit = 50;
    $offset = 0;
    $paths= null;
    $paths->ajaxServer = "http://remotemployees.com/wp-json/";
    $paths->getCandidate = "reset_get_candidate/v2";
    $paths->getStatus = "reset_get_status_candidate/v2";

    $json = file_get_contents("{$paths->ajaxServer}{$paths->getCandidate}");
    $userInfo = json_decode($json,true);

    $json = file_get_contents("{$paths->ajaxServer}{$paths->getStatus}");
    $statuses_candidate = json_decode($json,true);

    ?>
    <table class="table">
        <tr class="options bold">
            <td>Дата</td>
            <td>Ф.И.О</td>
            <td>Номер телефона</td>
            <td><label style="width: 300px">Email</label></td>
            <td>Ссылка на резюме</td>
            <td><label for="prof-select">Статус</label></td>
            <td>Комментарий</td>
        </tr>

        <?php
            foreach ( $userInfo['goodCand'] as $user ) {
                $classStatus = "";

                if($user["status_id"] === $statuses_candidate[0]['id']){
                    $classStatus = 'white';
                }else if($user["status_id"] === $statuses_candidate[2]['id']){
                    $classStatus = 'yellow';
                }
                else if($user["status_id"] === $statuses_candidate[3]['id']){
                    $classStatus = 'dark-green';
                }
                else{
                    $classStatus = 'red';
                }
                ?>
                <tr data-candidate-id ="<?=$user['id']?>"  data-status-id ="<?=$user['status_id']?>" class="values <?=$classStatus?>">
                    <td><?= $user['date'] ?></td>
                    <td><?= $user['FIO'] ?></td>
                    <td><?= $user['phone']?></td>
                    <td class="email"><?= $user['email']?></td>
                    <td class="word-break">
                        <?php
                        if($user['websait'] !== ''){
                            ?>
                            <a target="_blank" href="<?=$user['websait']?>">Link</a>
                            <?php
                        }
                        ?>
                    </td>
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

        <?php
        foreach ( $userInfo['notFitCand'] as $user ) {
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
            <tr data-candidate-id ="<?=$user['id']?>"  data-status-id ="<?=$user['status_id']?>" class="values <?=$classStatus?>">
                <td><?= $user['date'] ?></td>
                <td><?= $user['FIO'] ?></td>
                <td><?= $user['phone']?></td>
                <td class="email"><?= $user['email']?></td>
                <td class="word-break">
                    <?php

                    if($user['websait'] !== ''){
                        ?>
                        <a target="_blank" href="<?=$user['websait']?>">Link</a>
                    <?php
                    }
                    ?>

                </td>
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

</section>

<!-- MODAL -->
<div class="modal">
    <div class="modal-inner">
        <div class="modal-content">
            <div class="autorisation">
                <p class="autorisation-title">
                    Log In
                </p>
                <label for="login" class="autorisation-block">
                    <!--<span class="input-title">Логин</span>-->
                    <input id="login" type="text" class="autorisation-input" placeholder="Login">
                </label>
                <label for="password" class="autorisation-block">
                    <!--<span class="input-title">Пароль</span>-->
                    <input id="password" type="password" class="autorisation-input" placeholder="Password">
                </label>
                <input id="authorize" type="submit" class="autorisation-btn" value="Войти">
            </div>
        </div>
    </div>
</div>

</body>
</html>