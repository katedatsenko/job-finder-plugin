<?php

/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 027 27.02.17
 * Time: 19:10
 */
namespace includes\widgets;

use includes\models\admin\menu\JobFinderDataBaseModel;
use includes\models\admin\menu\JobFinderUpdateDataModel;

class JobFinderVacanciesWidget extends \WP_Widget
{
    public function __construct() {

                /**
                 * https://developer.wordpress.org/reference/classes/wp_widget/__construct/
                 * WP_Widget::__construct(
                 *      string $id_base, //Base ID для виджета, в нижнем регистре и уникальным. Если оставить пустым,
                 *                          то часть имени класса виджета будет использоваться Должно быть уникальным.
                 *      string $name, //Имя виджета отображается на странице конфигурации.
                 *      array $widget_options = array(),
                 *      array $control_options = array()
                 * )
                 *
                 */

                parent::__construct(
                    "job_finder_vacancies",
                    "Job Finder Vacancies Widget",
        array("description" => "Vacancies")
                );
    }
    /**
    +     * Метод form() используется для отображения настроек виджета на странице виджетов.
    +     * @param $instance
    +     */
    public function form($instance) {
        $title = "";
        $text = "";
        // если instance не пустой, достанем значения
        if (!empty($instance)) {
            $title = $instance["title"];
            $text = $instance["text"];
        }

        $tableId = $this->get_field_id("title");
        $tableName = $this->get_field_name("title");
        echo '<label for="' . $tableId . '">Title</label><br>';
        echo '<input id="' . $tableId . '" type="text" name="' .
            $tableName . '" value="' . $title . '"><br>';

        $textId = $this->get_field_id("text");
        $textName = $this->get_field_name("text");
        echo '<label for="' . $textId . '">Text</label><br>';
        echo '<textarea id="' . $textId . '" name="' . $textName .'">' . $text . '</textarea>';
    }

    /**
         * @param $newInstance
         * @param $oldInstance
         * @return array
         */
    public function update($newInstance, $oldInstance) {
        $values = array();
        $values["title"] = htmlentities($newInstance["title"]);
        $values["text"] = htmlentities($newInstance["text"]);
        return $values;
    }

    /**
    +     * @param $args
    +     * @param $instance
    +     */
    public function widget($args, $instance) {
        $title = $instance["title"];
        $text = $instance["text"];

        echo "<h2>$title</h2>";
        echo "<p>$text</p>";

         // Вывод вакансий
        $data = JobFinderDataBaseModel::getAll();
        ?>
        <div>
            <?php if(count($data) > 0 && $data !== false){  ?>
                <?php foreach($data as $value): ?>
                <ul class="job-finder-widget">
                    <li id="job-finder-vacancy"><?php echo $value['name']; ?></li>
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
}