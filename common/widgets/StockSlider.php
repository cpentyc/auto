<?php
/**
 * Created by PhpStorm.
 * User: cpentyc
 * Date: 17.12.2018
 * Time: 17:29
 */
namespace common\widgets;
use Yii;
use yii\bootstrap\Html;
use \yii\bootstrap\Widget;
use \common\models\News;

class StockSlider extends Widget{

    public function run()
    {
        $html ="<div id=\"stockCarousel\" class=\"carousel slide\" data-ride=\"carousel\">";
        /** @var News[] $sliders */
        $sliders  = News::getLastStock();
        $indicators = " <ol class=\"carousel-indicators\">";
        $carouselInner  = "<div class=\"carousel-inner\">";
        $firstSlider = true;
        $sliderCounter = 0;
        /** @var News $slider */
        foreach ($sliders as $slider)
        {
            if($firstSlider)
            {
                $indicators .= "<li data-target=\"#stockCarousel\" data-slide-to=\"$sliderCounter\" class=\"active\"></li>";
                    $carouselInner .= " <div class=\"item active\">      
                                    <img src=\"/images/news/$slider->image\" >
                                    <div class=\"carousel-caption d-none d-md-block\">
                                    <h2 class='stockH2'>$slider->h1</h2>
                                    <p class='stockDescription'>$slider->meta_description</p>
                                    ".Html::a(Yii::t('app', 'ПОДРОБНЕЕ'), ['news/stock-view', 'slug' => $slider->slug ], ['class' => 'stockMore btn'])."
                                    </div>                             
                        </div>";

            }
            else
            {
                $indicators .= "<li data-target=\"#stockCarousel\" data-slide-to=\"$sliderCounter\" ></li>";
                $carouselInner .= " <div class=\"item\">      
                                    <img src=\"/images/news/$slider->image\">
                                    <div class=\"carousel-caption d-none d-md-block\">
                                    <h2 class='stockH2'>$slider->h1</h2>
                                    <p  class='stockDescription'>$slider->meta_description</p>
                                    ".Html::a(Yii::t('app', 'ПОДРОБНЕЕ'), ['news/stock-view', 'slug' => $slider->slug ], ['class' => 'stockMore btn'])."
                                    </div>                             
                        </div>";

            }
            $firstSlider =false;
            $sliderCounter++;
        }
        $indicators .= "</ol>";
        $carouselInner .= "</div>";
        $html .= $indicators.$carouselInner;
             /*"<!-- Left and right controls -->
                <a class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">
                    <span class=\"glyphicon glyphicon-chevron-left\"></span>
                    <span class=\"sr-only\">Previous</span>
                </a>
                <a class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">
                    <span class=\"glyphicon glyphicon-chevron-right\"></span>
                    <span class=\"sr-only\">Next</span>
                </a>
            </div>";*/
        return $html;

    }
}