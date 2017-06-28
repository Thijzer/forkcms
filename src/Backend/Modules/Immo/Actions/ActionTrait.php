<?php

namespace Backend\Modules\Immo\Actions;

use Backend\Core\Engine\Model;

trait ActionTrait
{
    public function execute()
    {
        parent::execute();
        $this->load();
    }

    public function redirectToRoute($url, array $params, $code = 302)
    {
        parent::redirect(Model::createURLForAction($url).\GuzzleHttp\Psr7\build_query($params), $code);
    }
}
