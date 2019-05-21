<?php

    $path = get_template_directory_uri();

    get_header();

    $id = get_the_ID();

    $thumb_id = get_post_thumbnail_id($id);
    $image = wp_get_attachment_image_src($thumb_id,'full');//
    $image = $image[0];

    $mainTitle = get_post_meta($id  , 'titleMain' , true );
    $title = get_post_meta($id  , 'title' , true );
    $salary = get_post_meta($id  , 'salary' , true );
    $sex = get_post_meta($id  , 'sex' , true );
    $requirements = get_post_meta($id  , 'requirements' , true );

    $post = get_post( $id );

    $link = get_the_permalink($id);

?>

<meta name="Resource-type" content="Document"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:locale" content="ru_RU"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="<?=$mainTitle?>"/>
<meta property="og:description"
      content="<?=$mainTitle?>. Работа в Болгарии - это отличная возможность с пользой провести время, зарабатывая достойную заработную плату, и отдохнуть в очень выгодных условиях. Также завести новые знакомства и наполнить свою жизнь новыми впечатлениями."/>
<meta property="og:image" content="<?=$image?>"/>
<meta property="og:url" content="<?=$link?>"/>
<meta property="og:site_name" content="Работа в Болгарии"/>

<script src="<?=$path?>/js/imask.js"></script>
<script src="<?=$path?>/js/jquery-3.4.0.min.js"></script>
<script src="<?=$path?>/js/jquery.cookie.js"></script>
<script defer src="<?=$path?>/js/smallFormAddCandidate.js"></script>


<a class="callback button open-modal"></a>
<header style="background: linear-gradient(rgba(15, 15, 15, 0.80), rgba(15, 15, 15, 0.35)), url(<?=$image?>) no-repeat center/cover;" class="section" id="section-portie">
    <div class="header-wrapper">
        <a href="/bulgaria">
            <img src="<?=$path?>/imgs/logo_w.png" alt="Offline workers">
        </a>
        <div class="burger-wrapper">
            <span class="burger-lines"></span>
        </div>
        <nav class="menu-top">
            <a href="/bulgaria/candidate" class="menu-top-link">Для работодателей</a>
            <a href="#" class="menu-top-link" id="menuButton">
                <i class="fas fa-phone-volume"></i>
                Заказать звонок
            </a>
        </nav>
    </div>
    <div class="center-box page">
        <h1 class="barman-title get-work"><?=$mainTitle?></h1>

        <div class="counter">
            <div class="co">
                <div id="dig1" class="number">0</div>
                <div id="dig2" class="number">0</div>
                <div id="dig3" class="number">0</div>
                <div id="dig4" class="number">0</div>

                <div  class="icon"><img src="<?=$path?>/imgs/svg/man-user.svg" alt=""></div>
            </div>
        </div>

        <a href="#section3" class="main-btn get-work-button">Получить работу</a>
    </div>
</header>


<section class="vacancy-desc">
    <div class="vacancy-desc-wrapper">
        <div class="vacancy-desc-content">
            <h2 class="vacancy-desc-title">
                <?=$title?>
            </h2>
            <ul class="vacancy-list">
                <li class="vacancy-list-item">
                    <i class="fas fa-file-contract"></i>
                    <span class="vacancy-list-item-text">Рабочий контракт на 3 мес.</span>
                </li>
                <li class="vacancy-list-item">
                    <i class="fab fa-cc-visa"></i>
                    <span class="vacancy-list-item-text">Оформление разрешения на работу</span>
                </li>
                <li class="vacancy-list-item">
                    <i class="fas fa-bus"></i>
                    <span class="vacancy-list-item-text">Автобусный билет Украина-Болгария-Украина</span>
                </li>
                <li class="vacancy-list-item">
                    <i class="fas fa-utensils"></i>
                    <span class="vacancy-list-item-text">3 разовое питание и проживание</span>
                </li>
            </ul>
            <p class="vacancy-desc-text">
                <i class="fas fa-money-bill-alt"></i>
                <span class="text-bold">Заработная плата:</span> <?=$salary?>
            </p>
            <h3 class="vacancy-list-title">
                Требования к кандидатам:
            </h3>
            <ul class="vacancy-list">
                <li class="vacancy-list-item">
                    <?php if( $sex == 'man'):  ?>
                    <i class="fas fa-male"></i>
                    <?php else: ?>
                        <i class="fas fa-female"></i>
                    <?php endif; ?>
                    <span class="vacancy-list-item-text"><?=$requirements?></span>
                </li>
                <li class="vacancy-list-item">
                    <i class="fas fa-briefcase"></i>
                    <span class="vacancy-list-item-text">Опыт работы приветствуется</span>
                </li>
                <li class="vacancy-list-item">
                    <i class="fas fa-passport"></i>
                    <span class="vacancy-list-item-text">Наличие биометрического паспорта желательно</span>
                </li>
                <li class="vacancy-list-item">
                    <i class="fas fa-language"></i>
                    <span class="vacancy-list-item-text">Английский язык – разговорный уровень</span>
                </li>
            </ul>
            <p class="vacancy-desc-text">
                <i class="far fa-calendar-alt"></i>
                <span class="text-bold">Даты выезда на работу в Болгарии:</span> середина мая или конец июня
            </p>
            <p class="vacancy-desc-text">
                <span class="text-bold">(Стоимость страховки - 50 евро.</span> Оплата только после утверждения Вашей кандидатуры
                работодателем.)
            </p>
        </div>
    </div>
</section>

<!--WORK AND RELAX SECTION-->
<section class="section" id="section1">
    <h2 class="section-title">Работай и отдыхай в Болгарии!</h2>
    <div class="offer-wrapper">
        <div class="offer-item">
            <img src="<?=$path?>/imgs/bg2-1.png" alt="" class="offer-img">
            <p class="offer-text">
                Солнце, море, новые впечатления
            </p>
        </div>
        <div class="offer-item">
            <img src="<?=$path?>/imgs/bg2-2.png" alt="" class="offer-img">
            <p class="offer-text">
                Не требует высокого уровня знания языков
            </p>
        </div>
        <div class="offer-item">
            <img src="<?=$path?>/imgs/bg2-3.png" alt="" class="offer-img">
            <p class="offer-text">
                Очень просто получить и оформиться на работу
            </p>
        </div>
    </div>
</section>

<!--ADVANTAGES SECTION-->
<section class="section" id="section2">
    <h2 class="section-title">Условия работы в отелях</h2>
    <div class="advantages-wrapper">
        <div class="advantages-item">
            <img src="<?=$path?>/imgs/hand.png" alt="" class="advantages-img">
            <p class="advantages-text">
                Рабочий контракт от 3х месяцев
            </p>
        </div>
        <div class="advantages-item">
            <img src="<?=$path?>/imgs/doc.png" alt="" class="advantages-img">
            <p class="advantages-text">
                Оформление рабочей визы
            </p>
        </div>
        <div class="advantages-item">
            <img src="<?=$path?>/imgs/market.png" alt="" class="advantages-img">
            <p class="advantages-text">
                Питание и проживание
            </p>
        </div>
        <div class="advantages-item">
            <img src="<?=$path?>/imgs/card.png" alt="" class="advantages-img">
            <p class="advantages-text">
                Автобусные билеты
            </p>
        </div>
    </div>
</section>

<div class="section" id="section3">
    <h2 class="section-title">Заполните форму</h2>
    <div class="form">
        <form>
            <input type="text" id="fio" placeholder="ФИО"/>
            <input type="text" id="phone" placeholder="Номер телефона"/>
            <input type="text" id="email" placeholder="Ваш Email"/>
            <div class="button" id="submit-btn">Отправить</div>
            <div class="hidden-msg">Введите корректные данные</div>
        </form>
    </div>
</div>

<?php
    get_footer();
?>

