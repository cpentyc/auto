<?php
/**
 * Created by PhpStorm.
 * User: cpentyc
 * Date: 17.12.2018
 * Time: 17:29
 */
namespace common\widgets;

use \yii\bootstrap\Widget;
use \common\models\Slider;

class ContentSlider extends Widget{

    public function run()
    {
        $html ="<div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\">";
        $sliders  = Slider::getSliders();
        $indicators = " <ol class=\"carousel-indicators\">";
        $carouselInner  = "<div class=\"carousel-inner\">";
        $firstSlider = true;
        $sliderCounter = 0;
        /** @var Slider $slider */
        foreach ($sliders as $slider)
        {
            if($firstSlider)
            {
                $indicators .= "<li data-target=\"#myCarousel\" data-slide-to=\"$sliderCounter\" class=\"active\">$slider->name</li>";
                if($slider->description!='')
                    $carouselInner .= " <div class=\"item active\"><img src=\"/images/slider/$slider->image\" alt=\"$slider->name\"><div class=\"carousel-caption d-none d-md-block\">$slider->description</div></div>";
                else
                    $carouselInner .= " <div class=\"item active\"><img src=\"/images/slider/$slider->image\" alt=\"$slider->name\"></div>";
            }
            else
            {
                $indicators .= "<li data-target=\"#myCarousel\" data-slide-to=\"$sliderCounter\" >$slider->name</li>";
                if($slider->description!='')
                    $carouselInner .= " <div class=\"item\"><img src=\"/images/slider/$slider->image\" alt=\"$slider->name\"><div class=\"carousel-caption d-none d-md-block\">$slider->description</div></div>";
                else
                    $carouselInner .= " <div class=\"item\"><img src=\"/images/slider/$slider->image\" alt=\"$slider->name\"></div>";
            }
            $firstSlider =false;
            $sliderCounter++;
        }
        $indicators .= "</ol>";
        $carouselInner .= "</div>";
        $html .= $indicators.$carouselInner;
        /*" <!-- Left and right controls -->
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