<?php

namespace includes\controllers\site\shortcodes;

use includes\controllers\admin\menu\JobFinderICreatorInstance;
use includes\models\admin\menu\JobFinderUpdateDataModel;
use includes\common\JobFinderRequestApi;

class JobFinderVacanciesShortcodeController extends JobFinderShortcodesController
    implements JobFinderICreatorInstance
{
    public $model;
    public function __construct() {
        parent::__construct();
        $this->model = JobFinderUpdateDataModel::newInstance();
    }

    /**
     * Функция в которой будем добалять шорткоды через функцию add_shortcode( $tag , $func );
     * @return mixed
     */
    public function initShortcode()
    {
           // TODO: Implement initShortcode() method.
           /*
         * Добавляем щорткод [job_finder_my_example]
         */
        add_shortcode( 'job_finder_vacancies', array(&$this, 'action'));
    }

    /**
     * Функция обработки шоткода
     * Функция указанная в параметре $func, получает 3 параметра, каждый из них может быть передан,
     * а может нет:
     * $atts(массив)
     *      Ассоциативный массив атрибутов указанных в шоткоде. По умолчанию пустая строка - атрибуты
     *      не переданы.
     *      По умолчанию: ''
     * $content(строка)
     *      Текст шоткода, когда используется закрывающая конструкция шотркода: [foo]текст шорткода[/foo]
     *      По умолчанию: ''
     * $tag(строка)
     *      Тег шорткода. Может пригодится для передачи в доп. функции. Пр: если шорткод - [foo],
     *      то тег будет - foo.
     *      По умолчанию: текущий тег
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return mixed
     */
    public function action($atts = array(), $content = '', $tag = '')
    {
            // TODO: Implement action() method.

        return $this->render(array());

    }

    /**
     * Функция отвечающа за вывод обработаной информации шорткодом
     * @param $data
     * @return mixed
     */
    public function render($array)
    {
            // TODO: Implement render() method.
        $option = get_option(JOBFINDER_PlUGIN_OPTION_NAME);
        $model = JobFinderUpdateDataModel::newInstance();
        $array = $model->updateData($option['vacancies']['city'], $option['vacancies'] ['keywords'], $option['vacancies'] ['nosalary'],
            $option['vacancies'] ['salary']);
        if ($array != false) {
            foreach ($array as $key) {
                echo '<div>';
                echo '<h4>Название вакансии: ' . $key['name']. '</h4> ';
                echo '<label>Компания: ' . $key['companyName']. '</label> <br>';
                echo '<label>Зарплата: ' . $key['salary']. ' грн. </label> <br>';
                echo '<label>Сайт компании: ' . $key['contactURL']. '</label> <br>';
                echo '<a href="https://rabota.ua/company'.$key['notebookId'].'/vacancy'.$key['id'].'">Перейти к вакансии</a><br>' ;
                echo '<hr>';
                echo '</div>';
            }
        }
    }

    public static function newInstance()
    {
            // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}