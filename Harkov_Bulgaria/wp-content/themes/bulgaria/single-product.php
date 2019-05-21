<?php
$path = get_template_directory_uri();
get_header();
?>
<link rel="stylesheet" href="<?= $path ?>/assets/css/singleProduct.css">
<?php

$id = get_the_ID();

$thumb_id = get_post_thumbnail_id($id);
$image = wp_get_attachment_image_src($thumb_id, 'full');//
$image = $image[0];

$mainTitle = get_post_meta($id, 'titleMain', true);
$title = get_post_meta($id, 'title', true);
$salary = get_post_meta($id, 'salary', true);
$sex = get_post_meta($id, 'sex', true);
$requirements = get_post_meta($id, 'requirements', true);

$post = get_post($id);


//$mainTitle = get_post_meta(358  , 'work-experience' , true );
$mainTitle = get_post_meta($id, 'work-experience');


$product = new WC_Product_Variable($id);

$attr = $product->get_attribute('work-experience');

if (!$attr) {
  $attr = $product->get_attribute('work-experiences');
}
$attr = str_replace("|", ",", $attr);


$categories = get_terms( 'product_cat' , [
  'orderby'           => 'name',
  'order'             => 'ASC',
  'hide_empty'        => false,
  'exclude'           => array(),
  'exclude_tree'      => array(),
  'include'           => array(),
  'fields'            => 'all',
  'slug'              => '',
  'parent'            => null,
  'hierarchical'      => false,
  'childless'         => false,
  'get'               => '',
  'name__like'        => '',
  'description__like' => '',
  'pad_counts'        => false,
  'offset'            => '',
  'search'            => '',
  'cache_domain'      => 'core'
] );
?>

<section class="resume">
  <div class="header-wrapper__categories">
    <a href="/bulgaria">
      <img src="<?=$path?>/imgs/logo_w.png" alt="Offline workers">
    </a>
  </div>
  <div class="filter">
    <a href="/bulgaria/candidates" class="filter__links">
      Посмотреть всех
    </a>

    <?php foreach ($categories as $category) : ?>
      <?php $categoryLink = get_category_link($category->term_id) ?>
      <?php if ($category->name === 'Без категории') {
        continue;

      }
      ?>
      <a href="<?=$categoryLink ?>" class="filter__links">
        <?php echo $category->name ?>
      </a>
    <?php endforeach; ?>
  </div>
  <div class="resume-wrapper">
    <div class="resume-preview">
      <div class="thumbnail">
        <img src="<?=$image?>">
      </div>
      <p class="resume-preview__text"><?= $post->post_title ?></p>
      <p class="resume-preview__text"><?= $post->post_excerpt ?></p>
    </div>
    <div class="resume-info">
      <ul class="resume-tabs__links">
        <li>Образование</li>
        <li>Опыт работы</li>
      </ul>
      <ul class="resume-tabs__content">
        <li><?= str_replace("\n", "<br>", $post->post_content); ?></li>
        <li><?= str_replace("\n", "<br>", $attr); ?></li>
      </ul>
    </div>
  </div>
  <h4 class="candidates-title">Смотреть похожие резюме</h4>
  <div class="main-container">

      <?php
      $related_tax = 'product_cat';

      // получаем ID всех элементов (категорий, меток или таксономий), к которым принадлежит текущий пост
      $cats_tags_or_taxes = wp_get_object_terms( $id, $related_tax, array( 'fields' => 'ids' ) );

      // массив параметров для WP_Query
      $args = array(
          'posts_per_page' => 4, // сколько похожих постов нужно вывести,
          'tax_query' => array(
              array(
                  'taxonomy' => $related_tax,
                  'field' => 'id',
                  'include_children' => false, // нужно ли включать посты дочерних рубрик
                  'terms' => $cats_tags_or_taxes,
                  'operator' => 'IN' // если пост принадлежит хотя бы одной рубрике текущего поста, он будет отображаться в похожих записях, укажите значение AND и тогда похожие посты будут только те, которые принадлежат каждой рубрике текущего поста
              )
          )
      );
      $misha_query = new WP_Query( $args );

      // если посты, удовлетворяющие нашим условиям, найдены
      if( $misha_query->have_posts() ) :

          // запускаем цикл
          while( $misha_query->have_posts() ) : $misha_query->the_post();
              // в данном случае посты выводятся просто в виде ссылок
             
              $thumb_id = get_post_thumbnail_id($misha_query->post->ID);
              $image = wp_get_attachment_image_src($thumb_id, 'full');//
              $image = $image[0];

              $product = new WC_Product_Variable($misha_query->post->ID);

              $stock = $product->stock_status;

              if ($stock === 'outofstock') {
                  continue;
              }

?>
              <a href="<?=get_permalink( $misha_query->post->ID )?>">
                      <div class="card">
                        <div class="thumbnail">
                          <img src="<?=$image?>" alt="">
                        </div>
                        <div class="meta">
                          <p><b>
                                  <?=$misha_query->post->post_title?>
                          </b></p> <br>
                          <p><?=$misha_query->post->post_excerpt?></p>
                        </div>
                      </div>
            </a>
        <?php
          endwhile;
      endif;

      // не забудьте про эту функцию, её отсутствие может повлиять на другие циклы на странице
      wp_reset_postdata();

      ?>
  </div>
</section>
<?php get_footer();



