<?php get_header(); ?>

<?php
$path = get_template_directory_uri();
?>

<?php
$main = get_posts([
    'numberposts' => 10,
    'post_type' => 'main'
]);

$thumb_id = get_post_thumbnail_id($main[0]->ID);
$image = wp_get_attachment_image_src($thumb_id,'full');//
$image = $image[0];
?>
<a class="callback button open-modal"></a>

<header style="background: url(<?=$image?>) no-repeat center/cover" class="section" id="section0">
    <div class="header-wrapper">
        <a href="/bulgaria">
            <img src="<?=$path?>/imgs/logo_w.png" alt="Offline workers">
        </a>
        <div class="burger-wrapper">
            <span class="burger-lines"></span>
        </div>
        <nav class="menu-top">
            <a href="/bulgaria" class="menu-logo">
                <img src="<?=$path?>/imgs/logo_w.png" alt="">
            </a>

            <a href="/bulgaria/candidates" class="menu-top-link">Для работодателей</a>
            <a href="#" class="menu-top-link" id="menuButton">
                <i class="fas fa-phone-volume"></i>
                Заказать звонок
            </a>
            <div class="menu-contacts-wrapper">
                <span>+38(066)4216267</span>
                <span>+38(095)3389524</span>
                <span>hr@of-w.com</span>
            </div>
            <div class="menu-social-wrapper">
                <a href="tg://resolve?domain=offline_workers">
                    <i class="fab fa-telegram-plane"></i>
                </a>
                <a href="viber://chat?number=+380664216267">
                    <i class="fab fa-viber"></i>
                </a>
                <a href="https://wa.me/380664216267">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/offline.workers/">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="https://www.instagram.com/offline.workers/?utm_source=ig_profile_share&igshid=10ue1p664oa82">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </nav>
    </div>
    <div class="center-box">
        <h1>Работа в Болгарии</h1>
        <div class="counter">
            <div class="co">
                <div id="dig1" class="number">0</div>
                <div id="dig2" class="number">0</div>
                <div id="dig3" class="number">0</div>
                <div id="dig4" class="number">0</div>

                <div  class="icon"><img src="<?=$path?>/imgs/svg/man-user.svg" alt=""></div>
            </div>
        </div>
        <a href="#section13" class="main-btn">Получить работу</a>
    </div>
</header>
<!--VACANCY SECTION-->
<section class="section vacancy" id="section13">
    <h2 class="section-title">Выбери вакансию</h2>
    <div class="vacancy-wrapper">

        <?php
        $vacancies = get_posts([
            'numberposts' => -1,
            'post_type' => 'vacansies'
        ]);


        ?>
        <?php foreach ($vacancies as $vacansy) : ?>


            <?php


            $thumb_id = get_post_thumbnail_id($vacansy->ID);
            $image = wp_get_attachment_image_src($thumb_id,'full');//
            $image = $image[0];

            $link = get_the_permalink($vacansy->ID);
            ?>

            <a style=" background-image: url(<?=$image?>)" href="<?=$link?>" class="vacancy-block">
                <h4 class="abs-vacancy"><?=$vacansy->post_title?></h4>
            </a>

        <?php endforeach;?>
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

<!--ABOUT SECTION-->
<section class="section" id="about-sec">
    <h2 class="section-title">О нас</h2>
    <div class="about-wrapper">
        <div class="about-content">
            <div class="about-content-item">
                <div>
                    <img src="<?=$path?>/imgs/svg/about/home.svg" alt="home" class="about-content-icon">
                </div>
                <p class="about-content-text">
                    IT компания Offline Workers
                    предоставляет возможность официально
                    трудоустроиться в отелях Болгарии.
                </p>
            </div>
            <div class="about-content-item">
                <div>
                    <img src="<?=$path?>/imgs/svg/about/monitor.svg" alt="about" class="about-content-icon">
                </div>
                <p class="about-content-text">
                    Предварительное видео собеседование
                    с отельерами развеет ваши последние сомнения.
                </p>
            </div>
            <div class="about-content-item">
                <div>
                    <img src="<?=$path?>/imgs/svg/about/flag.svg" alt="flag" class="about-content-icon">
                </div>
                <p class="about-content-text">
                    Мы лично были в данных отелях менее недели назад.
                    Все с нетерпением ждут вашего приезда!
                    Проведите это лето на море!
                </p>
            </div>
        </div>
        <div class="about-content">
            <img src="<?=$path?>/imgs/notebook.jpg" alt="Notebook" class="about-img">
        </div>
    </div>
</section>

<!--PARTNERS SECTION-->
<section class="section" id="section-partners">
    <h2 class="section-title">Работодатели</h2>
    <div class="vacancy-wrapper">
        <div class="partners-item">
            <h4 class="partners-title">Отель PALAZZO</h4>
        </div>
        <div class="partners-item">
            <h4 class="partners-title">Отель BELITZA</h4>
        </div>
        <div class="partners-item">
            <h4 class="partners-title">Отель MENA PALACE</h4>
        </div>
        <div class="partners-item">
            <h4 class="partners-title">Отель MERCURY</h4>
        </div>
        <div class="partners-item">
            <h4 class="partners-title">Отель POMORIE</h4>
        </div>
        <div class="partners-item">
            <h4 class="partners-title">Отель VIAND</h4>
        </div>
    </div>
</section>

<?php get_footer(); ?>
