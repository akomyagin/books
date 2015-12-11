<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?php if(\file_exists($model->preview)){
        echo Html::img($model->getImgSrc(), ['width'=>'100','class'=>'books-img']);
    } ?>

    <?= $form->field($model, 'image')->fileInput(["accept"=>"image/x-png, image/gif, image/jpeg"]); ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        ArrayHelper::map(Authors::find()->all(), 'id', 'fullname'),
        [
            'options' => [
                $model->author_id => ['selected' => true]
            ]
        ]
    ); ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- /* $form->field($model,'date')->widget(
        \yii\jui\DatePicker::className(), [
            'options' =>[
                'class' => 'form-control',
                'readonly'=> ''
            ]
        ]) */ -->