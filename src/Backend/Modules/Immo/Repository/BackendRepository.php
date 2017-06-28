<?php

namespace Backend\Modules\Immo\DB;

use Backend\Core\Engine\Model as BackendModel;

class BackendRepository
{
    const FIND_QUERY = 'SELECT i.* FROM %s AS i WHERE i.id = ?';
    const DATABASE_NAME = '';
    const ENTITY = 'entity';

    public function __construct()
    {
        $this->hydration = new QuickHydration();
    }

    /** @return \SpoonDatabase */
    public function getRepository()
    {
        return BackendModel::getContainer()->get('database');
    }

    public function find(string $id)
    {
        return $this->hydration->hydrate(self::ENTITY, $this->getRepository()->getRecord(
            sprintf(static::FIND_QUERY, static::DATABASE_NAME),
            [$id]
        ));
    }

    public function add($item)
    {
        return $this->getRepository()->insert(static::DATABASE_NAME, $this->hydration->deHydrate($item));
    }

    public function update($item)
    {
        $this->getRepository()->update(static::DATABASE_NAME, $this->hydration->deHydrate($item));
    }
}
