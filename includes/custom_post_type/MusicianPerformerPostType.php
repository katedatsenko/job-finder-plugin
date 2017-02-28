<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 028 28.02.17
 * Time: 13:01
 */
namespace includes\custom_post_type;

class MusicianPerformerPostType
{
    public function __construct()
    {
        /*
         * Регистрируем Custom Post Type
         */
        add_action( 'init', array( $this, 'registerMusicianPerformerPostType' ) );

        // Сообщения при публикации или изменении типа записи musicianPerformer
        add_filter('post_updated_messages',  array( &$this, 'musicianPerformerUpdatedMessages' ));
        // Раздел "помощь" типа записи musicianPerformer
        add_action( 'contextual_help', array( &$this, 'addHelpText' ), 10, 3 );
        // хук, через который подключается функция
        // регистрирующая новые таксономии  createBookTaxonomies
        add_action( 'init', array( &$this, 'createMusicianPerformerTaxonomies' ) );

        // подключаем функцию активации мета блока (my_extra_fields)
        add_action('add_meta_boxes', array( &$this, 'yearExtraFields' ), 1);

        // включаем обновление полей при сохранении
        add_action('save_post', array( &$this, 'yearExtraFieldsUpdate' ), 0);
    }
    public function registerMusicianPerformerPostType(){
        /*
        * Регистрируем новый тип записи
        */
        register_post_type('musicianperformer', array(
            'labels'             => array(
                'name'               => 'Исполнители', // Основное название типа записи
                'singular_name'      => 'Исполнитель', // отдельное название записи типа Book
                'add_new'            => 'Добавить нового исполнителя',
                'add_new_item'       => 'Добавить нового исполнителя',
                'edit_item'          => 'Редактировать исполнителя',
                'new_item'           => 'Новый исполнитель',
                'view_item'          => 'Посмотреть исполнителя',
                'search_items'       => 'Найти исполнителя',
                'not_found'          => 'Исполнителей не найдено',
                'not_found_in_trash' => 'В корзине исполнителей не найдено',
                'parent_item_colon'  => '',
                'menu_name'          => 'Исполнители'
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title','editor','author','thumbnail','excerpt','comments'),
            'taxonomies'          => array( 'genre', 'country' ),
        ) );
    }
    public function musicianPerformerUpdatedMessages(){
        global $post;
        $messages['musicianperformer'] = array(
            0 => '', // Не используется. Сообщения используются с индекса 1.
            1 => sprintf( 'Исполнитель обновлен. <a href="%s">Посмотреть запись</a>', esc_url( get_permalink($post->ID) ) ),
            2 => 'Произвольное поле обновлено.',
            3 => 'Произвольное поле удалено.',
            4 => 'Запись исполнителя обновлена.',
            /* %s: дата и время ревизии */
            5 => isset($_GET['revision']) ? sprintf( 'Запись исполнителя восстановлена из ревизии %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( 'Запись исполнителя опубликована. <a href="%s">Перейти к записи исполнителя</a>', esc_url( get_permalink($post->ID) ) ),
            7 => 'Запись исполнителя сохранена.',
            8 => sprintf( 'Запись исполнителя сохранена. <a target="_blank" href="%s">Предпросмотр записи исполнителя</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post->ID) ) ) ),
            9 => sprintf( 'Запись исполнителя запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи исполнителя</a>',
                // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
                date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post->ID) ) ),
            10 => sprintf( 'Черновик записи исполнителя обновлен. <a target="_blank" href="%s">Предпросмотр записи исполнителя</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post->ID) ) ) ),
        );
        return $messages;
    }

    public function addHelpText($contextual_help, $screen_id, $screen ){
        //$contextual_help .= print_r($screen); // используйте чтобы помочь определить параметр $screen->id
        if('musicianperformer' == $screen->id ) {
            $contextual_help = '
            <p>Напоминалка при редактировании записи исполнителя:</p>
            <ul>
                <li>Указать жанр, например Рок или Поп.</li>
                <li>Указать страну исполнителя.</li>
            </ul>
            <p>Если нужно запланировать публикацию на будущее:</p>
            <ul>
                <li>В блоке с кнопкой "опубликовать" нажмите редактировать дату.</li>
                <li>Измените дату на нужную, будущую и подтвердите изменения кнопкой ниже "ОК".</li>
            </ul>
            <p><strong>За дополнительной информацией обращайтесь:</strong></p>
            <p><a href="/" target="_blank">Блог о WordPress</a></p>
            <p><a href="http://wordpress.org/support/" target="_blank">Форум поддержки</a></p>
		    ';
        }
        elseif( 'edit-musicianperformer' == $screen->id ) {
            $contextual_help = '<p>Это раздел помощи для типа записи Исполнитель.</p>';
        }
        return $contextual_help;
    }

    public function createMusicianPerformerTaxonomies(){
        // определяем заголовки для 'genre'
        $labels = array(
            'name' => _x( 'Жанры', 'taxonomy general name' ),
            'singular_name' => _x( 'Жанр', 'taxonomy singular name' ),
            'search_items' =>  __( 'Поиск по жанру' ),
            'popular_items' => __( 'Популярные жанры' ),
            'all_items' => __( 'Все жанры' ),
            'parent_item' => __( 'Родительский жанр' ),
            'parent_item_colon' => __( 'Родительский жанр:' ),
            'edit_item' => __( 'Выбрать жанр' ),
            'update_item' => __( 'Обновить жанр' ),
            'add_new_item' => __( 'Добавить новый жанр' ),
            'new_item_name' => __( 'Имя нового жанра' ),
            'menu_name' => __( 'Жанр' ),
        );
        // Добавляем древовидную таксономию 'genre' (как категории) жанр
        register_taxonomy('genre', array('musicianperformer'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'genre' ),
        ));
        // определяем заголовки для 'writer'
        $labels = array(
            'name' => _x( 'Страна исполнителя', 'taxonomy general name' ),
            'singular_name' => _x( 'Страна', 'taxonomy singular name' ),
            'search_items' =>  __( 'Поиск по стране' ),
            'all_items' => __( 'Все страны' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Выбрать страну' ),
            'update_item' => __( 'Обновить страну' ),
            'add_new_item' => __( 'Добавить страну' ),
            'new_item_name' => __( 'Добавить страну' ),
            'separate_items_with_commas' => __( 'Разделяйте страны запятой' ),
            'add_or_remove_items' => __( 'Добавить или удалить страну' ),
            'choose_from_most_used' => __( 'Выбрать из наиболее используемых стран' ),
            'menu_name' => __( 'Страны' ),
        );
        // Добавляем НЕ древовидную таксономию 'country' (как метки)
        register_taxonomy('country', 'musicianperformer',array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'country' ),
        ));
    }

    // Создадим новый мета блок для постов
    public function yearExtraFields(){
        add_meta_box(
            'year_extra_fields', // id атрибут HTML тега, контейнера блока.
            'Год основания', // Заголовок/название блока. Виден пользователям.
            array( &$this, 'renderYearExtraFields' ),  //Функция, которая выводит на экран HTML содержание блока
            'musicianperformer', // Название экрана для которого добавляется блок.
            'normal', // Место где должен показываться блок
            'high' // Приоритет блока для показа выше или ниже остальных блоков:
        );
    }
    // Заполним этот блок полями html формы.
    // Делается это через, указанную в add_meta_box() функцию renderPriceExtraFields(). Именно она отвечает за содержание мета блока:
    //Функция, которая выводит на экран HTML содержание блока
    public function renderYearExtraFields($post){
        ?>
        <p>
            <label>
                Укажите год основания
                <input type="number" name="year_extra[year]" value="<?php echo get_post_meta($post->ID, 'year', 1); ?>" />
            </label>
        </p>
        <?php
    }
    /*
     * Сохраняем данные
     * На этом этапе, мы уже создали блок произвольных полей, теперь нужно обработать данные полей при сохранении поста.
     *  Обработать, значит записать их в в базу данных или удалить от туда. Для этого используем хук save_post, который
     * срабатывает в момент сохранения поста. В этот момент мы получим данные из массива price_extra[] и обработаем них:
     */
    public function yearExtraFieldsUpdate($post_id ){
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // выходим если это автосохранение
        if( !isset($_POST['year_extra']) ) return false; // выходим если данных нет
        // Все ОК! Теперь, нужно сохранить/удалить данные
        $yearExtra = array_map('trim', $_POST['year_extra']); // чистим все данные от пробелов по краям
        foreach( $yearExtra as $key=>$value ){
            if( empty($value) ){
                delete_post_meta($post_id, $key); // удаляем поле если значение пустое
                continue;
            }
            update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
        }
        return $post_id;
    }
}