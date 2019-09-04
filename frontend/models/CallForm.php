<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CallForm extends Model
{
    public $name;
    public $phone;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'phone'], 'required'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'ФИО'),
            'phone' => Yii::t('app', 'Контактный телефон'),
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        $body = "ФИО: $this->name \n".
            "телефон: $this->phone \n";
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(['admin@cbc-auto.kz' => $this->name])
            ->setSubject('Заявка на сервис')
            ->setTextBody($body)
            ->send();
    }
}
