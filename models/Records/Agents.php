<?php

namespace app\models\Records;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "agents".
 *
 * @property int $id
 * @property string $firstName
 * @property string $surname
 * @property string $name
 * @property string $date_of_birth
 * @property string $agent_number
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property Customers[] $customers
 */
class Agents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'surname', 'date_of_birth'], 'required'],
            [['date_of_birth', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['firstName', 'surname', 'agent_number'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
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
            'firstName' => 'First Name',
            'surname' => 'Surname',
            'name' => 'Business Name',
            'date_of_birth' => 'Date Of Birth',
            'agent_number' => 'Agent Number',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'fullName' => 'Name',
            'creator' => 'Added By',
            'updater' => 'Updated By',
        ];
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
    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['agent_id' => 'id']);
    }

    public function getFullName()
    {
        return "{$this->firstName} {$this->surname}";
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
