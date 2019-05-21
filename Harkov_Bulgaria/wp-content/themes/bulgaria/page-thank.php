<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/xhtml">

<?php
$path = get_template_directory_uri();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Работа в Болгарии</title>
    <meta name="author" content=""/>
    <meta name="description"
          content="Лето в Болгарии - это отличная возможность с пользой провести время, зарабатывая достойную заработную плату, и отдохнуть в очень выгодных условиях. Также завести новые знакомства и наполнить свою жизнь новыми впечатлениями."/>
    <meta name="keywords"
          content="Лето в Болгарии, работа в Болгарии, лето с пользой, достойная зарплата, работа для студентов, работы и отдых, отдых в Болгарии, новые знакомства"/>
    <meta name="Resource-type" content="Document"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/my.css"/>
    <script defer src="<?=$path?>/js/custom.js"></script>
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!--Short icon-->
    <link rel="shortcut icon" href="<?=$path?>/imgs/favicon.ico" type="image/x-icon">

    <script defer src="<?=$path?>/js/imask.js"></script>
    <script defer src="<?=$path?>/js/jquery-3.4.0.min.js"></script>
    <script defer src="<?=$path?>/js/jquery.cookie.js"></script>
    <script defer src="<?=$path?>/js/smallFormAddCandidate.js"></script>

    <!--[if IE]>
    <script type="text/javascript">
        var console = {
            log: function () {
            }
        };
    </script>
    <![endif]-->
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NNVLFF6');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNVLFF6"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>




<div class="section" id="section11">
    <nav class="menu-top">
        <div class="logo-box"><a href="/bulgaria"> <img src="<?=$path?>/imgs/logo_w.png" alt=""></a></div>
        <p class="phone">
            <a href="tel:+380664216267">+38(066)4216267</a>
            <a href="tel:+380953389524">+38(095)3389524</a>
        </p>
    </nav>
    <div class="center-box">
        <h1>Заявка отправлена</h1>
        <p>В ближайшее время наши менеджеры свяжутся с вами.</p>
        <p>Пока ждете, <b>заполните форму</b>, чтобы мы быстрее обработали данные</p>



        <form name="Register" id="form-bottom">
            <fieldset>
                <h4>Персональная информация:</h4>
                <br>
                <!-- <label for="fio">ФИО</label> -->
                <input type="text" name="fio" id="fio" maxlength="45" placeholder="ФИО" readonly>
                <br>
                <br>
                <input type="text" name="city" id="city" maxlength="15" placeholder="Из какого вы города">
                <br>
                <br>
                <input type="text" name="age" id="age" maxlength="15" placeholder="Ваш возраст" pattern="[0-9]{2}">
                <br>
                <br>
                <input type="text" name="phone" id="phone"  placeholder="Номер телефона" readonly>
                <br>
                <br>
                <input type="text" name="email" id="email" placeholder="E-mail" readonly>
                <br>
                <br>
                <label for="photo">Ваше фото</label><br><br>
                <input type="file" name="photo" id="photo" accept="image/*">
                <br>
                <br>
                <input type="text" name="soc" id="soc" maxlength="45" placeholder="Ссылка на соц. сеть (если нет фото)">
                <br>
                <br>
                <label>Откуда Вы о нас узнали?</label><br><br>
                <select id="from">

                    <option>OLX</option>
                    <option>Work.ua</option>
                    <option>Реклама в Telegram</option>
                    <option>Группа в соц. сетях</option>
                    <option>Реклама в Instagram</option>
                    <option>Постер в университете</option>
                    <option>Другое</option>
                </select>
                <br>
                <br>
                <label>Есть ли у вас биометрический паспорт?</label><br><br>
                <select id="bio">

                    <option>Да</option>
                    <option>Нет</option>
                </select>
                <br>
                <br>



            </fieldset>
            <fieldset>
                <h4>Профессиональные навыки</h4>
                <br>
                <label>На какую должность претендуете:</label><br><br>
                <select id="vacancy">

                    <option>Бармен</option>
                    <option>Официант</option>
                    <option>Аниматор</option>
                    <option>Повар</option>
                    <option>Горничная</option>
                    <option>Портье</option>
                    <option>Разнорабочий</option>
                    <option>Электрик</option>
                    <option>Посудомойщица</option>
                    <option>Спасатель</option>
                    <option>Танцор</option>
                </select>
                <br>
                <br>


                <label>Уровень владения английским языком:</label><br><br>
                <select id="language-en">

                    <option>Не знаю</option>
                    <option>Начальный</option>
                    <option>Средний</option>
                    <option>Продвинутый</option>
                </select>
                <br>
                <br>
                <label>Уровень владения немецким языком:</label><br><br>
                <select id="language-de">

                    <option>Не знаю</option>
                    <option>Начальный</option>
                    <option>Средний</option>
                    <option>Продвинутый</option>
                </select>
                <br>
                <br>

                <label>Опыт работы и личные качества</label> <br><br>
                <textarea id="text" rows="15" cols="40" placeholder="Расскажите о своем образовании и опыте "></textarea>
            </fieldset>
            <div class="hidden-msg">Введите корректные данные</div>
            <div id="submit-btn2" class="form-bottom-btn"><a>Отправить</a></div>

        </form>

    </div>




</div>

</body>
</html>

