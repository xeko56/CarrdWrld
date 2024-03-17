<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $category_nr
 * @property string $category_name
 * @property string|null $created_at
 * @property string|null $edited_at
 *
 * @property Card[] $cards
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_nr', 'category_name'], 'required'],
            [['category_nr'], 'integer'],
            [['created_at', 'edited_at'], 'safe'],
            [['category_name'], 'string', 'max' => 255],
            [['category_nr'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_nr' => Yii::t('app', 'Category Nr'),
            'category_name' => Yii::t('app', 'Category Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'edited_at' => Yii::t('app', 'Edited At'),
        ];
    }

    /**
     * Gets query for [[Cards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCards()
    {
        return $this->hasMany(Cards::class, ['category_nr' => 'category_nr']);
    }

    public static function getCategoryCardsTable($category_nr)
    {

        $intLimit = $_REQUEST['length'];
        $startrow = $_REQUEST['start'];
        $columns = $_REQUEST['columns'];

        if (isset($_REQUEST['order'])) {
            $order = $_REQUEST['order'];
        } else {
            $order = '';
        }
        $search = $_REQUEST['search'];
        if ($startrow == 0) {
            $page = 1;
        } else {
            $page = (($startrow) / $intLimit) + 1;
        }

        $per_page = $intLimit;
        $offset = ($page - 1) * $intLimit;

        $col_array = array();
        $filters = array();
        if (isset($columns) && count($columns) > 0) {
            $counter = 0;
            foreach ($columns as $column) {
                $col_array[$counter] = $column['data'];
                $filters[$column['data']] = trim($column['search']['value']);
                $counter++;
            }
        }

        $order_by = " ORDER BY card_nr ASC";

        $sql = "SELECT card_nr, card_name, exp_name, group_name, type_name, release_date, img_url, ct.category_name, ct.category_nr FROM cards c
        LEFT JOIN groups USING (group_nr)
        LEFT JOIN expansion USING (exp_nr)
        LEFT JOIN card_types USING (type_nr)
        JOIN categories ct ON c.category_nr = ct.category_nr
        WHERE c.category_nr = :category_nr";

        $rowcount = Yii::$app->db->createCommand($sql)->bindValues([':category_nr' => $category_nr])->queryAll();
        $rowcount = count($rowcount);
        $rowcount_filtered = $rowcount;

        if ($search['value'] != '') {
            $sql .= " AND (card_name ILIKE '%{$search['value']}%'";
            $rowcount_filtered = Yii::$app->db->createCommand("SELECT count(*) from ($sql) as c")->queryScalar();
        }

        if ($order != '') {
            $order_by = "";
            foreach ($order as $order_by_clause) {
                $colname = $col_array[$order_by_clause['column']];
                $order_by .= ' ,' . $colname . ' ' . $order_by_clause['dir'];
            }
            $order_by = " ORDER BY " . trim($order_by, ' ,');
        }

        $sql .= $order_by;
        if ($per_page > 0) {
            $sql .= " OFFSET $offset LIMIT $per_page ";
        }

        $result = Yii::$app->db->createCommand($sql)->bindValues([':category_nr' => $category_nr])->queryAll();
        $arrJson = array(
            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => $rowcount,
            "recordsFiltered" => $rowcount_filtered,
            "data" => $result
        );
        print json_encode($arrJson);
        exit;
    }
}
