<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\SgpPatchSearch $searchModel
 */

$this->title = Yii::t('app', 'Patches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgp-patch-index">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Sgp Patch',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        //Sameer - removed Columns that are not required to be displayed
//            'id',
          //  'hq_id',
                     [
            'attribute' => 'hq_id',
            'value' => 'hq.hq_name',
        ],
            'patch_name',
 //           'is_deleted',
//            'is_delete_approved',
//            ['attribute' => 'crt_dt','format' => ['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            'crt_by', 
//            ['attribute' => 'upd_dt','format' => ['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
         //   'upd_by', 
         //Sameer- Changed updated by to have username instead of id
 //       ['attribute' => 'upd_by', 'value' =>function ($model) { return \dektrium\user\models\User::findOne($model->upd_by)->username; }], 
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                     //Sameer - Added view to retun false as it is not needed in this case as this has only Region Name. 
                    //If there are more column than available in the list then we should remove view line below.
                    'view'=>  function () { return false;},
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['sgp-patch/view', 'id' => $model->id, 'edit' => 't']),
                            ['title' => Yii::t('yii', 'Edit'),]
                        );
                    }
                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]); Pjax::end(); ?>

</div>