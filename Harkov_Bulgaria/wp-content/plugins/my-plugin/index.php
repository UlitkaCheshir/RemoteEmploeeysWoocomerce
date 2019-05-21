<?php
/*
Plugin Name:bulgaria-plugin
Author: Olga Kizilova
*/

include("includes/class.newPostType.php");
include("includes/class.newPostStatus.php");
include("includes/class.formGenerator.php");

include("includes/ajaxApi.php");
require_once "includes/Entity.php";
include 'includes/avgEntity.php';
//include_once 'includes/taxonomy-term-image.php';

add_action( 'init', 'registerPostTypes', 0 );



$entity = new avgEntity();

$entity->addEntityFields(

    array(
        'price' => ''
    )
);

//ajaxApi::initializeEntity($entity);
//ajaxApi::registerApiAction('getPostWithParams');
//ajaxApi::registerApiAction('makeOrder');
//ajaxApi::registerApiAction('savePhoto');
//ajaxApi::registerApiAction('getSocials');
//ajaxApi::registerApiAction('getOptions');
//ajaxApi::registerApiAction('authorize');
//ajaxApi::registerApiAction('getOrders');
//ajaxApi::registerApiAction('getAdminOrders');
//ajaxApi::registerApiAction('adminAuthorize');
//ajaxApi::registerApiAction('usePromoCode');
//ajaxApi::registerApiAction('getRoboResponse');
//ajaxApi::registerApiAction('sendMail');
//ajaxApi::registerApiAction('deleteOrder');

ajaxApi::registerApiAction('sendMessageToAdmin');
ajaxApi::registerApiAction('getProductList');
ajaxApi::registerApiAction('getCategories');
ajaxApi::registerApiAction('getProductByCategory');
ajaxApi::registerApiAction('getSingleProduct');
ajaxApi::registerApiAction('getDelivery');
ajaxApi::registerApiAction('AddOrder');

function wpdocs_register_meta_boxes() {
    add_meta_box(
        'meta-box-id',
        __( 'Корзина заказа', 'textdomain' ),
        'wpdocs_my_display_callback',
        'myorder'
    );
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpdocs_my_display_callback( $post ) {
    echo ajaxApi::getOrderCartHtml($post->ID);
}


function registerPostTypes()
{


    add_theme_support('post-thumbnails');
    add_option( 'my_option', '255' );


    $fields = array();
    $metaBox = array();

    $fields[] = array(
        'type' => 'input-text',
        'name' => 'titleMain',
        'placeholder' => 'Введите заголовок для header',
        'label' => "Заголовок для header"
    );

    $fields[] = array(
        'type' => 'input-text',
        'name' => 'title',
        'placeholder' => 'Введите заголовок',
        'label' => "Введите заголовок"
    );

    $fields[] = array(
        'type' => 'text-area',
        'name' => 'salary',
        'placeholder' => 'Введите текст зароботной платы',
        'label' => "Зароботная плата",
        'rows' => 5
    );



    $fields[] = array(
        'type' => 'select',
        'name' => 'sex',
        'label' => "Введите необходимый пол для кандидата",
        'values' => ['man'=>['name'=>"Man"] , 'woman'=>['name'=>"Woman"]]
    );

    $fields[] = array(
        'type' => 'input-text',
        'name' => 'requirements',
        'placeholder' => 'Введите требования для кандидатов',
        'label' => "Требования для кандидата"
    );

    $metaBox[] = array('name' => 'Детали вакансии', 'fields' => $fields);


    $Goods = new newPostType(
        'Vacansies',
        'Вакансии Болгарии',
        array(
            'title',
            'thumbnail'
        ), [], $metaBox);

    new newPostType(
        'Main',
        'Изображения',

        array(
            'title',
            'thumbnail'
        ), [], []);

    new newPostType(
        'Thanks',
        'ThankPage',

        array(
            'title',
        ), [], []);


}//
    ?>