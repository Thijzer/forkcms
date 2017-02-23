<?php

namespace Backend\Modules\MediaLibrary\Domain\MediaFolder\Command;

use Backend\Modules\MediaLibrary\Domain\MediaFolder\MediaFolder;
use Backend\Modules\MediaLibrary\Domain\MediaFolder\MediaFolderDataTransferObject;

final class UpdateMediaFolder extends MediaFolderDataTransferObject
{
    /**
     * CreateMediaFolder constructor.
     *
     * @param MediaFolder $mediaFolder
     */
    public function __construct(
        MediaFolder $mediaFolder
    ) {
        parent::__construct($mediaFolder);
    }
}
