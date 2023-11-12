<?php

namespace app\modules\products\models;

use Yii;
use yii\base\Model;

class Product extends Model
{
    public static function get_all_data($table, $paramKey, $paramValue)
    {
        $sql = "SELECT * FROM $table";
        if (isset($paramKey, $paramValue)) {
            $sql .= " WHERE $paramKey = $paramValue";
        }
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function get_product_table($query)
    {
        $sql = "SELECT card_nr, card_name, exp_name, group_name, type_name, release_date, img_url FROM cards
        LEFT JOIN groups USING (group_nr)
        LEFT JOIN expansion USING (exp_nr)
        LEFT JOIN card_types USING (type_nr)";
        if (isset($query)) {
            $sql .= " WHERE $query";
        }
        return Yii::$app->db->createCommand($sql)->queryAll();
    }           

}
