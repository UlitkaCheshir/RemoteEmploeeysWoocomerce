<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
        $path = get_template_directory_uri();

        $id = get_the_ID();

        $post = get_post( $id );

        $link = get_the_permalink($id);
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Спасибо за заявку</title>
    <meta name="author" content="" />
    <meta name="description" content="Спасибо, ваша заявка на вакансию бармена принята. Лето в Болгарии - это отличная возможность с пользой провести время, зарабатывая достойную заработную плату, и отдохнуть в очень выгодных условиях. Также завести новые знакомства и наполнить свою жизнь новыми впечатлениями." />
    <meta name="keywords" content="Лето в Болгарии, работа в Болгарии, лето с пользой, достойная зарплата, работа для студентов, работы и отдых, отдых в Болгарии, новые знакомства" />
    <meta name="Resource-type" content="Document" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/my.css" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="shortcut icon" href="<?=$path?>/imgs/favicon.ico" type="image/x-icon">

    <!--[if IE]>
    <script type="text/javascript">
        var console = { log: function() {} };
    </script>
    <![endif]-->
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NNVLFF6');

    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNVLFF6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<a class="callback button open-modal"></a>



<div class="section" id="section10">
    <nav class="menu-top">
        <div class="logo-box"><a href="/bulgaria"> <img src="<?=$path?>/imgs/logo_w.png" alt=""></a></div>
        <p class="phone">
            <a href="tel:+380955870951">+38(095)587-09-51</a>
            <a href="tel:+380664216267">+38(066)421-62-67</a>
        </p>
    </nav>
    <div class="center-box thank-page">
        <h1 class="thx-title " ><?php the_title()?></h1>
        <p>В ближайшее время наши менеджеры свяжутся с вами.</p>
        <p>Пока ждете, можете узнать больше в наших соц. сетях</p>

        <div class="soc-big">
            <a href="https://www.instagram.com/offline.workers/?utm_source=ig_profile_share&igshid=10ue1p664oa82"> <img src="<?=$path?>/imgs/1x/insta.png" alt=""></a>
            <a href="https://www.facebook.com/offline.workers/"> <img src="<?=$path?>/imgs/1x/facebook.png" alt=""></a>
        </div>

    </div>




</div>





<!-- MODAL -->
<div class="modal">
    <div class="modal-inner">
        <div class="modal-content">
            <div class="modal-close-icon">
                <a href="javascript:void(0)" class="close-modal"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
            <div class="modal-content-inner">
                <h4>Есть вопросы?</h4>
                <p>Свяжитесь с нами любым удобным способом: </p>
                <p>+38(095)587-09-51 (телефон/Viber/WhatsApp/Telegram)</p>
                <p>+38(066)421-62-67</p>
                <p>Email: hr@of-w.com</p>
                <hr>
                <p>Или оставьте ваш номер и мы свяжемся с Вами в ближайшее время.</p>
                <input type="text" placeholder="Введите номер">
            </div>

        </div>
    </div>
</div>








<script>
    var modal = document.querySelector('.modal');
    var closeButtons = document.querySelectorAll('.close-modal');
    // set open modal behaviour
    document.querySelector('.open-modal').addEventListener('click', function() {
        modal.classList.toggle('modal-open');
    });
    // set close modal behaviour
    for (i = 0; i < closeButtons.length; ++i) {
        closeButtons[i].addEventListener('click', function() {
            modal.classList.toggle('modal-open');
        });
    }
    // close modal if clicked outside content area
    document.querySelector('.modal-inner').addEventListener('click', function() {
        modal.classList.toggle('modal-open');
    });
    // prevent modal inner from closing parent when clicked
    document.querySelector('.modal-content').addEventListener('click', function(e) {
        e.stopPropagation();
    });

</script>
<!-- END MODAL -->
</body>

</html>
