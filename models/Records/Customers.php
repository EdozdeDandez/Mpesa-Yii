<?php

namespace app\models\Records;

use borales\extensions\phoneInput\PhoneInputBehavior;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $phone
 * @property string $firstName
 * @property string $surname
 * @property string $date_of_birth
 * @property int $national_id
 * @property int $agent_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property CustomerProducts[] $customerProducts
 * @property Agents $agent
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property Transactions[] $transactions
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_of_birth', 'created_at', 'updated_at'], 'safe'],
            [['national_id', 'agent_id', 'created_by', 'updated_by'], 'integer'],
            [['phone', 'firstName', 'surname'], 'string', 'max' => 45],
            [['agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agents::className(), 'targetAttribute' => ['agent_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'firstName' => 'First Name',
            'surname' => 'Surname',
            'date_of_birth' => 'Date Of Birth',
            'national_id' => 'National ID',
            'agent_id' => 'Agent ID',
            'created_at' => 'Date Added',
            'created_by' => 'Created By',
            'updated_at' => 'Date Updated',
            'updated_by' => 'Updated By',
            'fullName' => 'Name',
            'agentName' => 'Agent',
            'creator' => 'Added By',
            'updater' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProducts()
    {
        return $this->hasMany(CustomerProducts::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(Agents::className(), ['id' => 'agent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['customer_id' => 'id']);
    }

    public function getFullName()
    {
        return "{$this->firstName} {$this->surname}";
    }

    public function getAgentName()
    {
        return $this->agent->name;
    }

    public function getCreator()
    {
        return $this->createdBy->username;
    }

    public function getUpdater()
    {
        return $this->updatedBy? $this->updatedBy->username : null;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date_of_birth = Carbon::parse($this->date_of_birth)->format('Y-m-d');
            $this->updated_at = Carbon::now();
            if (!$this->getIsNewRecord()){
                $this->updated_by = Yii::$app->user->id;
            }
            return true;
        } else {
            return false;
        }
    }
}
