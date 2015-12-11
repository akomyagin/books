<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
    </button>
</div>
<div class="modal-body">
 <?=Html::img($model->getImgSrc(), ['width'=>'565','class'=>'books-img'])?>
</div>