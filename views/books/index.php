<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=$this->render('_search', ['searchModel' => $searchModel])?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterPosition' => 'FILTER_POS_HEADER',
        'columns' => [
            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{viewimg}',
            'header' => Yii::t('app', 'Preview'),
            'buttons' => [
                'viewimg' => function($url, $data) {
                    $modal = Modal::widget([
                        'id' => 'view_img_'.$data->id,
                        'toggleButton' => [
                            'tag' => 'a',
                            'label' => Html::img($data->getImgSrc(), ['width'=>'50','class'=>'books-img']),
                            'data-target' => '#view_img_'.$data->id,
                            'href' => Url::to(['books/viewimg', 'id' => $data->id]),
                            ],
                        'clientOptions' => false
                        ]);
                    return $data->preview ? $modal : $data->preview;
                },
                ],
            ],
            'authorfullname',
            'date',
            'date_create',
            ['class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Action'),
            'buttons' => [
                'view' => function($url, $dataProvider) {
                    return Modal::widget([
                        'id' => 'view_'.$dataProvider->id,
                        'toggleButton' => [
                            'tag' => 'a',
                            'label' => '<span class="glyphicon glyphicon-eye-open"></span>',
                            'data-target' => '#view_'.$dataProvider->id,
                            'href' => Url::to(['books/view', 'id' => $dataProvider->id]),
                            ],
                        'clientOptions' => false
                        ]);
                    },
                ],
            'template' => '{update} {view} {delete}',
            ],
        ],
    ]); ?>

</div>
