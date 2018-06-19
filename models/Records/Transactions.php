<?php

namespace app\models\Records;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property int $customer_id
 * @property double $amount
 * @property string $destination
 * @property int $service_id
 * @property string $reference
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customers $customer
 * @property Services $service
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'service_id'], 'integer'],
            [['amount'], 'number'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['destination', 'reference'], 'string', 'max' => 45],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'amount' => 'Amount',
            'destination' => 'Destination',
            'service_id' => 'Service ID',
            'reference' => 'Reference',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }
}
