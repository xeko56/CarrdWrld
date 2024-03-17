<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property int $card_nr
 * @property string $card_name
 * @property int|null $exp_nr
 * @property int|null $group_nr
 * @property int|null $type_nr
 * @property string $release_date
 * @property string|null $img_url
 * @property int|null $category_nr
 *
 * @property Categories $categoryNr
 * @property Expansion $expNr
 * @property Groups $groupNr
 * @property SaleCards[] $saleCards
 * @property CardTypes $typeNr
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_name', 'release_date'], 'required'],
            [['exp_nr', 'group_nr', 'type_nr', 'category_nr'], 'integer'],
            [['release_date'], 'safe'],
            [['card_name', 'img_url'], 'string', 'max' => 255],
            [['category_nr'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_nr' => 'category_nr']],
            [['exp_nr'], 'exist', 'skipOnError' => true, 'targetClass' => Expansion::class, 'targetAttribute' => ['exp_nr' => 'exp_nr']],
            [['group_nr'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::class, 'targetAttribute' => ['group_nr' => 'group_nr']],
            [['type_nr'], 'exist', 'skipOnError' => true, 'targetClass' => CardTypes::class, 'targetAttribute' => ['type_nr' => 'type_nr']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'card_nr' => Yii::t('app', 'Card Nr'),
            'card_name' => Yii::t('app', 'Card Name'),
            'exp_nr' => Yii::t('app', 'Exp Nr'),
            'group_nr' => Yii::t('app', 'Group Nr'),
            'type_nr' => Yii::t('app', 'Type Nr'),
            'release_date' => Yii::t('app', 'Release Date'),
            'img_url' => Yii::t('app', 'Img Url'),
            'category_nr' => Yii::t('app', 'Category Nr'),
        ];
    }

    /**
     * Gets query for [[CategoryNr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryNr()
    {
        return $this->hasOne(Categories::class, ['category_nr' => 'category_nr']);
    }

    /**
     * Gets query for [[ExpNr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpNr()
    {
        return $this->hasOne(Expansion::class, ['exp_nr' => 'exp_nr']);
    }

    /**
     * Gets query for [[GroupNr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupNr()
    {
        return $this->hasOne(Groups::class, ['group_nr' => 'group_nr']);
    }

    /**
     * Gets query for [[SaleCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCards()
    {
        return $this->hasMany(SaleCards::class, ['card_nr' => 'card_nr']);
    }

    /**
     * Gets query for [[TypeNr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeNr()
    {
        return $this->hasOne(CardTypes::class, ['type_nr' => 'type_nr']);
    }

    public static function getCardsTable($query = NULL)
    {
        $sql = "SELECT card_nr, card_name, exp_name, group_name, type_name, release_date, img_url, ct.category_name, ct.category_nr FROM cards c
            LEFT JOIN groups USING (group_nr)
            LEFT JOIN expansion USING (exp_nr)
            LEFT JOIN card_types USING (type_nr)
            JOIN categories ct ON c.category_nr = ct.category_nr";
        if ($query)
        {
            $sql .= ' WHERE ' . $query;
        }
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }
}
