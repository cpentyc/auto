<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ServiceForm extends Model
{
    public $name;
    public $phone;
    public $mark;
    public $city;
    public $year;
    public $service;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'phone', 'mark', 'city', 'year', 'service'], 'required'],


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
            'mark' => Yii::t('app', 'Марка/модель автомобиля'),
            'city' => Yii::t('app', 'Выбор города'),
            'year' => Yii::t('app', 'Год выпуска'),
            'service' => Yii::t('app', 'Выбор услуги'),
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
        $body = "ФИО:$this->name \n";
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(['admin@cbc-auto.kz' => $this->name])
            ->setSubject('Заявка на сервис')
            ->setTextBody($body)
            ->send();
    }
}
