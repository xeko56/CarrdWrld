<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_cards".
 *
 * @property int $id
 * @property int $user_nr
 * @property int $card_nr
 * @property float $price
 * @property int $amount
 * @property int|null $status_nr
 * @property string $e_date
 * @property int|null $is_soldout
 *
 * @property BuyCards[] $buyCards
 * @property Cards $cardNr
 * @property CardStatus $statusNr
 * @property Users $userNr
 */
class SaleCards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_cards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_nr', 'card_nr', 'price', 'amount'], 'required'],
            [['user_nr', 'card_nr', 'amount', 'status_nr', 'is_soldout'], 'integer'],
            [['price'], 'number'],
            [['e_date'], 'safe'],
            [['user_nr'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_nr' => 'id']],
            [['card_nr'], 'exist', 'skipOnError' => true, 'targetClass' => Cards::class, 'targetAttribute' => ['card_nr' => 'card_nr']],
            [['status_nr'], 'exist', 'skipOnError' => true, 'targetClass' => CardStatus::class, 'targetAttribute' => ['status_nr' => 'status_nr']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_nr' => Yii::t('app', 'User Nr'),
            'card_nr' => Yii::t('app', 'Card Nr'),
            'price' => Yii::t('app', 'Price'),
            'amount' => Yii::t('app', 'Amount'),
            'status_nr' => Yii::t('app', 'Status Nr'),
            'e_date' => Yii::t('app', 'E Date'),
            'is_soldout' => Yii::t('app', 'Is Soldout'),
        ];
    }

    /**
     * Gets query for [[BuyCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuyCards()
    {
        return $this->hasMany(BuyCards::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[CardNr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCardNr()
    {
        return $this->hasOne(Card::class, ['card_nr' => 'card_nr']);
    }

    /**
     * Gets query for [[StatusNr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusNr()
    {
        return $this->hasOne(CardStatus::class, ['status_nr' => 'status_nr']);
    }

    /**
     * Gets query for [[UserNr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserNr()
    {
        return $this->hasOne(Users::class, ['id' => 'user_nr']);
    }

    public static function getSaleCardsTable($card_nr)
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

        $order_by = " ORDER BY price ASC";

        $sql = "SELECT username, price, amount, status_name, status_abbre 
        FROM sale_cards sc 
        JOIN users u ON u.id = sc.user_nr 
        JOIN card_status cs ON cs.status_nr = sc.status_nr
        WHERE sc.card_nr = :card_nr";

        $rowcount = Yii::$app->db->createCommand($sql)->bindValues([':card_nr' => $card_nr])->queryAll();
        $rowcount = count($rowcount);
        $rowcount_filtered = $rowcount;

        if ($search['value'] != '') {
            $sql .= " AND (username ILIKE '%{$search['value']}%' OR status_abbre ILIKE '%{$search['value']}%'";
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

        $result = Yii::$app->db->createCommand($sql)->bindValues([':card_nr' => $card_nr])->queryAll();
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
