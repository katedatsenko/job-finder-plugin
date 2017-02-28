<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 027 27.02.17
 * Time: 19:10
 */
namespace includes\widgets;

use includes\controllers\admin\menu\JobFinderICreatorInstance;
use includes\models\admin\menu\JobFinderDataBaseModel;

class JobFinderVacanciesDashboardWidget implements JobFinderICreatorInstance
{
    public function __construct() {
        // Регистрация виджета консоли
        add_action( 'wp_dashboard_setup', array( &$this, 'addDashboardWidgets' ) );
        add_action( 'wp_dashboard_setup', array( &$this, 'removeDashboardWidgets' ) );
    }
    // Удаление виджета консоли
    public function removeDashboardWidgets(){
        /**
        * Удаляет Блоки на страницах редактирования/создания постов, постоянных страниц и произвольных типов записей.
        * remove_meta_box( $id, $screen, $context );
        */
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    }
    // Используется в хуке
    public function addDashboardWidgets(){
        // Продвинутое использование: добавление виджета в боковой столбец
        add_meta_box(
            'job_finder_vacancies_dashboard_widget',
            __('Vacancies new', JOBFINDER_PlUGIN_TEXTDOMAIN),
            array( &$this, 'renderDashboardWidget' ),
            'dashboard',
            'side',
            'high'
        );
        wp_add_dashboard_widget(
            'job_finder_vacancies_dashboard_widget',         // Идентификатор виджета.
            __('Vacancies', JOBFINDER_PlUGIN_TEXTDOMAIN),           // Заголовок виджета.
            array( &$this, 'renderDashboardWidget'  ) // Функция отображения.
        );
        // Объявляем глобальный массив метабоксов, содержащий все виджеты административной понели WordPress
        global $wp_meta_boxes;

        // Получаем нормальный массив виджетов консоли
        // (который уже содержит наш виджет в самом конце)
        $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

        // Сохраняем старую версию массива и удаляем наш виджет из конца массива
        $example_widget_backup = array('job_finder_vacancies_dashboard_widget' => $normal_dashboard['job_finder_vacancies_dashboard_widget']);
        unset($normal_dashboard['job_finder_vacancies_dashboard_widget']);

        // Объединяем два массива вместе таким образом, что наш виджет оказывается в начале
        $sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);

        // Сохраняем отсортированный массив обратно в метабокс
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
    }
    // Выводит контент
    public function renderDashboardWidget(){
        // Вывод вакансий
        $data = JobFinderDataBaseModel::getAll();
        ?>
        <div>
            <?php if(count($data) > 0 && $data !== false){  ?>
                <?php foreach($data as $value): ?>
                    <ul class="job-finder-widget">
                        <li><?php echo $value['name']; ?></li>
                        <li><?php echo $value['companyName']; ?></li>
                        <li><?php echo $value['salary'].' грн'; ?></li>
                        <li><?php echo $value['contactURL']; ?></li>
                        <li><hr></li>
                    </ul>
                <?php endforeach ?>
            <?php }else{ ?>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            <?php } ?>
        </div>
        <?php
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}