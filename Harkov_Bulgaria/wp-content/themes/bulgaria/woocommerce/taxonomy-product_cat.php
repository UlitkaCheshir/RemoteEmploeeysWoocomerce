<?php
$categorySingle = get_queried_object();

get_header() ;

$path = get_template_directory_uri();

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
 <title>Работа в Болгарии</title>
<link rel="stylesheet" type="text/css" href="<?=$path?>/assets/css/candidate.css"/>

<section class="candidates-section">
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
    <h4 class="candidates-title"><?=$categorySingle->name?></h4>
    <div class="main-container">

<?php

if ( have_posts() ) {

    while ( have_posts() ) {
        the_post();

        $id = get_the_ID();
        $title = get_the_title();
        $price = get_post_meta( $id , 'price' , true);
        $link = get_the_permalink();

        $thumb_id = get_post_thumbnail_id($id);
        $image = wp_get_attachment_image_src($thumb_id,'full');//
        $image = $image[0];

        $product = new WC_Product_Variable($id);

       $stock = $product->stock_status;

       if($stock === 'outofstock'){
           continue;
       }
    ?>

        <a href="<?=$link?>">
           <div class="card">
               <div class="thumbnail">
                   <img src="<?=$image?>">
               </div>
               <div class="meta">
                   <p><b>

                           <?=$title?>

           </b></p> <br>
                   <p><?=$post->post_excerpt?> </p>

               </div>
           </div>
       </a>


        <?php }//while


} else {

   echo "<h2>Кандидатов с такой професией нет</h2>";
}
?>
    </div>
</section>
        <?php
get_footer();
?>

