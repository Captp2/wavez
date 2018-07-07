<?php

Yii::setAlias('@files', realpath(dirname(__FILE__).'/../../files/'));

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
];
