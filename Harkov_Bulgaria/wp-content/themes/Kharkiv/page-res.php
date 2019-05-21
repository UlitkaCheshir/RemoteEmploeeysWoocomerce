<?php
/**
 * Created by PhpStorm.
 * User: ULITKA
 * Date: 14.05.2019
 * Time: 10:59
 */


$loop = new WP_Query( array(
    'post_type' => 'product',
    'posts_per_page' => 4,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

while ( $loop->have_posts() ): $loop->the_post(); ?>
    <div <?php post_class("inloop-product"); ?>>
        <div class="row">
            <div class="col-sm-4">
                <?php the_post_thumbnail("thumbnail-215x300"); ?>
            </div>
            <div class="col-sm-8">
                <h4>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h4>
                <?php the_content(); ?>
                <p class="price">
                    <?php _e("Price:","examp"); ?>
                    <?php woocommerce_template_loop_price(); ?>
                </p>
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </div>
    </div>

<?php endwhile; wp_reset_postdata(); ?>