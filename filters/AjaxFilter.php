<?php

namespace pvsaintpe\boost\filters;

use yii\base\ActionFilter;
use yii\web\BadRequestHttpException;
use Yii;

/**
 * @see https://github.com/yiisoft/yii2/issues/7823
 */
class AjaxFilter extends ActionFilter
{

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (Yii::$app->getRequest()->getIsAjax()) {
            return parent::beforeAction($action);
        }
        throw new BadRequestHttpException('Bad Request. This url cannot handle a non-ajax request.');
    }
}
