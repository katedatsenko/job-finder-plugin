<?php


namespace includes\models\admin\menu;


class JobFinderDataBaseModel
{
    //Название таблицы
    const JOBFINDER_TABLE_NAME = "job_finder_vacancies";

    /**
     * Возвращает название таблицы с префиксом WordPress тот что задаеться при установке
     * всем таблицам
     * @return string
     */

    static public function getTableName(){
        global $wpdb;
        return $wpdb->prefix .static::JOBFINDER_TABLE_NAME;
    }

    /**
     * Метод создание таблицы в базе данных
     */

    static public function createTable()
    {
        global $wpdb;
        $tableName = self::getTableName();
        // Проверяем на наличие таблицы в базе данных и если ее нет то создаем
        if($wpdb->get_var("show tables like '$tableName'") != $tableName) {

            $sql = "CREATE TABLE " .$tableName. "(

            id_vacancies int(11) NOT NULL AUTO_INCREMENT,
            id int(11) NOT NULL,
            notebookId int(11),
            name varchar(255),
            cityName varchar(255),
            cityId int(11),
            date varchar(255),
            addDate varchar(255),
            hot boolean,
            anonymous boolean,
            companyName varchar(255),
            salary int(11),
            profLevelId int(11),
            scheduleId int(11),
            isAgency boolean,
            vacancyAddress varchar(255),
            showProfile boolean,
            showLogo boolean,
            logo varchar(255),
            description varchar(255),
            dateTxt varchar(255),
            isSpecialNeeds boolean,
            isNew boolean,
            contactPerson varchar(255),
            contactPhone varchar(255),
            contactURL varchar(255),
            branchId int(11),
            branchName varchar(255),
            isLiked boolean,

            PRIMARY KEY  (id_vacancies)
            ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
        
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);

        }

    }

     /**
      * Получает по ID строку в таблице
      * @return mixed
      */
    static public function getById($id){
        global $wpdb;
        $data = $wpdb->get_row("SELECT * FROM ".self::getTableName()." WHERE id= ". $id, ARRAY_A);
        if(count($data) > 0) return $data;
        return false;
    }
    /**
      * Вставляет данные в таблицу
      * @param $data
      * @return mixed
      */
     static public function insert($array){
         global $wpdb;
         $id = $wpdb->insert( self::getTableName(), $array);
         return $id;
     }

     /**
      * Обновляет данные в таблице по ID
      * @param $data
      * @return mixed
      */
     static public function updateById($data, $id){
         global $wpdb;
         $id = $wpdb->update(self::getTableName(), $data ,array('id' => $id));
         return $id;
     }

     /**
      * Удаляет данные в таблице по ID
      * @param $id
      * @return mixed
      */
     static public function deleteById($id){
         global $wpdb;
         $wpdb->query("DELETE FROM ".self::getTableName()." WHERE id = '".$id ."'");
     }

     static public function deleteAll(){
         global $wpdb;
         $wpdb->query("DELETE FROM ".self::getTableName());
     }

    /**
     * Метод удаляет таблицу в базе данных
     */
    static public function deleteTable()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS ".self::getTableName());
    }

     /**
      * Метод получает все записи в таблице
      * @return bool
      */
     static public function getAll()
     {
         // TODO: Implement getAll() method.
          //if (self::issetTable() == false) return false;
         global $wpdb;
         $data = $wpdb->get_results( "SELECT * FROM ".self::getTableName()." ORDER BY addDate DESC", ARRAY_A);
         if(count($data) > 0) return $data;
         return false;
     }
    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}