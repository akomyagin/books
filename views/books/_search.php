<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Authors;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
?>

<div>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'options' => ['class' => 'form-inline']
    ]); ?>

    <div class="form-group">
        <?= $form->field($searchModel, 'author_id')->dropDownList(
            ArrayHelper::merge( [0=>'Автор'] ,ArrayHelper::map(Authors::find()->all(), 'id', 'fullname')),
            [
                'options' => [
                    'class'=>'form-control',
                    $searchModel->author_id => ['selected' => true]
                ]
            ]
        )->label(false); ?>
    </div>

    <div class="form-group">
        <?= $form->field($searchModel, 'name')->textInput(['placeholder'=>Yii::t('app', 'Book Name')])->label(false) ?>
    </div>
<div class="row" style="padding-left:15px;">
    <?= $form->field($searchModel, 'date_from')->widget(DateControl::classname(), [
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion'=>true,
        'options' => [
            'pluginOptions' => [
                'autoclose' => true
                ]
            ]
        ])?>

    <?= $form->field($searchModel, 'date_to')->widget(DateControl::classname(), [
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion'=>false,
        'options' => [
            'pluginOptions' => [
                'autoclose' => true
                ]
            ]
        ])?>
</div>
<div class="row" style="padding-left:15px;padding-top:15px;margin-bottom:15px;">
    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Clear Filter'), Url::to(['books/index']),['class' => 'btn btn-default']) ?>
</div>
</div>