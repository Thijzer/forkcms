<?php

namespace Backend\Core\Engine;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Symfony\Component\HttpKernel\KernelInterface;
use Backend\Core\Language\Language as BL;

/**
 * This class will be used to alter the head-part of the HTML-document that will be created by he Backend
 * Therefore it will handle meta-stuff (title, including JS, including CSS, ...)
 */
class Header extends Base\Object
{
    /**
     * Template instance
     *
     * @var Template
     */
    private $tpl;

    /**
     * URL-instance
     *
     * @var Url
     */
    private $URL;

    /**
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        parent::__construct($kernel);

        $this->getContainer()->set('header', $this);

        // grab from the reference
        $this->URL = $this->getContainer()->get('url');
        $this->tpl = $this->getContainer()->get('template');
    }

    /**
     * Parse the header into the template
     */
    public function parse()
    {
        // put the page title in the <title>
        $this->tpl->assign('page_title', BL::getLabel($this->URL->getModule()));
    }
}
