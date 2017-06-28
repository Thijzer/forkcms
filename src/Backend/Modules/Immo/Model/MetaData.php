<?php

namespace Backend\Modules\Immo\Model;

use Common\Uri;

class MetaData
{
    private $title;
    private $publishDate;
    private $status;
    /**
     * @var string
     */
    private $slug;

    public function __construct(
        string $title,
        string $slug,
        \DateTime $publishDate = null,
        string $status = null
    ) {
        $this->title = $title;
        $this->publishDate = $publishDate;
        $this->status = $status;
        $this->slug = Uri::getUrl($slug);
    }

    public function getPublishDate()
    {
        return $this->publishDate;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
