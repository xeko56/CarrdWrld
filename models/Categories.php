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
}
