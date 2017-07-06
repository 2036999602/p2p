<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@uploads_path', Yii::getAlias('@frontend') . '/web/uploads');
Yii::setAlias('@uploads_url', '/uploads');
Yii::setAlias('@frontend_web', 'http://zsp2p.com');
