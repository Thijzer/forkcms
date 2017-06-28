<?php

namespace Backend\Modules\Immo\DB;

use Backend\Modules\Immo\Model\Premise;

/**
 * @method Premise find(string $id)
 */
class PremiseRepository extends BackendRepository
{
    const DATABASE_NAME = 'premise';
    const ENTITY = Premise::class;

    public function add(Premise $premise)
    {
        return parent::add($premise);
    }

    public function update(Premise $premise)
    {
        parent::add($premise);
    }
}
