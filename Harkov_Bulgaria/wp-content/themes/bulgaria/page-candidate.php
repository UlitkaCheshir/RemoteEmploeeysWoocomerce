<?php
/**
 * Created by PhpStorm.
 * User: ULITKA
 * Date: 14.05.2019
 * Time: 10:59
 */
get_header();
$path = get_template_directory_uri();

$candidates = get_posts([
  'numberposts' => -1,
  'post_type' => 'product'
]);

function instock($var)
{
  $product = new WC_Product_Variable($var->ID);

  $stock = $product->stock_status;

  var_dump($stock);
  return ($stock === 'instock');
}


$categories = get_terms('product_cat', [
  'orderby' => 'name',
  'order' => 'ASC',
  'hide_empty' => false,
  'exclude' => array(),
  'exclude_tree' => array(),
  'include' => array(),
  'fields' => 'all',
  'slug' => '',
  'parent' => null,
  'hierarchical' => false,
  'childless' => false,
  'get' => '',
  'name__like' => '',
  'description__like' => '',
  'pad_counts' => false,
  'offset' => '',
  'search' => '',
  'cache_domain' => 'core'
]);

?>

<section class="candidates-section">

  <!--FILTER-->
  <div class="filter">
  <?php foreach ($categories as $category) : ?>
    <?php $categoryLink = get_category_link($category->term_id) ?>
    <?php if ($category->name === 'Без категории') {
      continue;

    }
    ?>
    <a href="<?= $categoryLink ?>" class="filter__links">
      <?php echo $category->name ?>
    </a>
    <?php endforeach; ?>
  </div>

  <div class="header-wrapper">
    <a href="/bulgaria">
      <img src="<?= $path ?>/imgs/logo_w.png" alt="Offline workers">
    </a>
    <!-- <div class="burger-wrapper">
          <span class="burger-lines"></span>
      </div>
      <nav class="menu-top">
          <a href="/bulgaria" class="menu-logo">
              <img src="<? /*=$path*/ ?>/imgs/logo_w.png" alt="">
          </a>

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
      </nav>-->
  </div>

  <div class="main-container">
    <?php

    foreach ($candidates as $candidate) : ?>

      <?php

      $product = new WC_Product_Variable($candidate->ID);

      $stock = $product->stock_status;

      if ($stock === 'outofstock') {
        continue;
      }

      $thumb_id = get_post_thumbnail_id($candidate->ID);
      $image = wp_get_attachment_image_src($thumb_id, 'full');//
      $image = $image[0];

      $link = get_the_permalink($candidate->ID);

      ?>

      <a href="<?= $link ?>">
        <div class="card">
          <div class="thumbnail">
            <img src="<?= $image ?>">
          </div>
          <div class="meta">
            <p><b>

                <?= $candidate->post_title ?>

              </b></p> <br>
            <p><?= $candidate->post_excerpt ?> </p>

          </div>
        </div>
      </a>

    <?php endforeach; ?>
  </div>

</section>
<?php
get_footer();
?>

