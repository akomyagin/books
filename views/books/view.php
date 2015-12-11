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
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="modal-body">
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => $model->owner->preview ?
                    Html::img($model->owner->getImgSrc(), ['width'=>'200','class'=>'books-img']) : $model->owner->preview,
            ],
            'id',
            'name',
            'date',
            'authorfullname',
            'date_create',
            'date_update',
        ],
    ]) ?>
</div>
    <div class="modal-footer">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    </div>
</div>