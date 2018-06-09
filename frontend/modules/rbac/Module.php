<?php

namespace frontend\modules\rbac;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\rbac\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
        $this->setAliases(['@users-assets' => __DIR__ . '/assets'
        ]);
    }
}
