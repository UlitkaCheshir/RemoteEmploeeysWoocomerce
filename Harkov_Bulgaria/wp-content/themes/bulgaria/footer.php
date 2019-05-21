
<?php
$path = get_template_directory_uri();
?>

<footer class="footer" id="section4">
    <div class="container">
        <div class="footer-navigation">
            <a href="/bulgaria">
                <img src="<?=$path?>/imgs/logo_w.png" alt="" class="footer-logo">
            </a>

            <ul class="footer-nav">
            <?php
            $vacancies = get_posts([
                'numberposts' => 6,
                'offset' => 0,
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

                    <li><a href="<?=$link?>"><?=$vacansy->post_title?></a></li>



            <?php endforeach;?>
                </ul>

            <ul class="footer-nav">
                <?php
                $vacancies = get_posts([
                    'numberposts' => 6,
                    'offset' => 6,
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

                    <li><a href="<?=$link?>"><?=$vacansy->post_title?></a></li>



                <?php endforeach;?>
            </ul>

        </div>
        <ul class="footer-second">
            <li><a href="tel:+380664216267">+38(066)4216267</a></li>
            <li><a href="tel:+380953389524">+38(095)3389524</a></li>
            <li><a href="mailto:hr@of-w.com">hr@of-w.com</a></li>
            <li><a href="https://www.instagram.com/offline.workers/?utm_source=ig_profile_share&igshid=10ue1p664oa82"></a></li>
        </ul>
        <ul class="footer-second">
            <li>
                <a href="tg://resolve?domain=offline_workers">
                    <i class="fab fa-telegram-plane"></i>
                </a>
            </li>
            <li>
                <a href="viber://chat?number=+380664216267">
                    <i class="fab fa-viber"></i>
                </a>
            </li>
            <li>
                <a href="https://wa.me/380664216267">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/offline.workers/">
                    <i class="fab fa-facebook-square"></i>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/offline.workers/?utm_source=ig_profile_share&igshid=10ue1p664oa82">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
    </div>
</footer>

<!-- MODAL -->
<div class="modal">
    <div class="modal-inner">
        <div class="modal-content">
            <div class="modal-close-icon">
                <a href="javascript:void(0)" class="close-modal"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
            <div class="modal-content-inner">
                <h4>Есть вопросы?</h4>
                <p>Свяжитесь с нами любым удобным способом или оставьте ваш номер и мы свяжемся с Вами в ближайшее время.</p>
                <div class="modal-btn-wrapper">
                    <a href="skype:live:hr_18930?call">
                        <img src="<?=$path?>/imgs/svg/skype.svg" alt="" class="modal-btn-item">
                    </a>
                    <a href="tg://resolve?domain=offline_workers">
                        <img src="<?=$path?>/imgs/svg/telegram.svg" alt="" class="modal-btn-item">
                    </a>
                    <a href="https://wa.me/380664216267">
                        <img src="<?=$path?>/imgs/svg/whatsapp.svg" alt="" class="modal-btn-item">
                    </a>
                    <a href="viber://chat?number=+380664216267">
                        <img src="<?=$path?>/imgs/svg/viber.svg" alt="" class="modal-btn-item">
                    </a>
                    <a href="mailto:hr@of-w.com">
                        <img src="<?=$path?>/imgs/svg/opened-email-envelope.svg" alt="" class="modal-btn-item">
                    </a>
                    <a href="#" id="phoneButton">
                        <img src="<?=$path?>/imgs/svg/phone-receiver.svg" alt="" class="modal-btn-item">
                    </a>
                </div>
                <div class="modal-phone">
                    <div class="modal-phone-numbers">
                        <p>+38(066)4216267, +38(095)3389524</p>
                    </div>
                    <input type="text" placeholder="Введите номер">
                    <button class="modal-phone-btn">Заказать</button>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
