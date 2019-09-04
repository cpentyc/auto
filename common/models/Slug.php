<?php
namespace common\models;

use dosamigos\transliterator\TransliteratorHelper;
use Yii;
use yii\base\NotSupportedException;
use yii\helpers\Inflector;

class Slug extends \yii\base\Model
{
    public function generateSlug($slug)
    {
        $slug = self::slugify($slug);
        return $slug;
    }

    public function slugify($slug)
    {
        return Inflector::slug(TransliteratorHelper::process($slug), '-', true);
    }

    public function slug($string, $replacement = '-', $lowercase = true)
    {
        $string = preg_replace('/[^\p{L}\p{Nd}]+/u', $replacement, $string);
        $string = trim($string, $replacement);
        return $lowercase ? strtolower($string) : $string;
    }
}
