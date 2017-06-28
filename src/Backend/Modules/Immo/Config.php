<?php

namespace Backend\Modules\Immo;

use Backend\Core\Engine\Base\Config as BackendBaseConfig;

class Config extends BackendBaseConfig
{
    protected $defaultAction = 'Index';

    protected $disabledActions = array();
}
