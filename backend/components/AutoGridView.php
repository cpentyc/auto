<?php
namespace backend\components;
use yii\grid\GridView;
use yii\helpers\Html;

class AutoGridView extends GridView {

    public $layout = "{items}\n
        <div class='row'>
            <div class=\"col-sm-12 col-md-5\">{summary}\n</div>
            <div class=\"col-sm-12 col-md-7\"><div class=\"dataTables_paginate paging_simple_numbers\" id=\"datatable_paginate\">{pager}</div></div>
        </div>";

    public $actionColumnTemplate = '{view}{update}{delete}';

    public $pager = [
        'linkOptions' => ['class' => 'page-link'],
        'linkContainerOptions' => ['class' => 'paginate_button page-item']
    ];

    public function init()
    {
        $this->columns[] = [
            'class' => 'yii\grid\ActionColumn',
            'template' => $this->actionColumnTemplate,
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<i class="fa fa-pencil"></i>', $url, [
                        'class' => 'pr-2'
                    ]);
                },
                'view' => function ($url, $model) {
                    return Html::a('<i class="fa fa-eye"></i>', $url, [
                        'class' => 'pr-2'
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('<i class="fa fa-trash-o text-danger"></i>', $url, [
                        'class' => 'pr-2'
                    ]);
                },
            ]];
        parent::init();



    }

}

/*
   'class' => 'yii\grid\ActionColumn',
   'template' => '{view}{update}{delete}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                        'class' => 'pr-2'
                                    ]);
                                },
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-eye"></i>', $url, [
                                        'class' => 'pr-2'
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-trash-o text-danger"></i>', $url, [
                                        'class' => 'pr-2'
                                    ]);
                                },
                            ]
 * */