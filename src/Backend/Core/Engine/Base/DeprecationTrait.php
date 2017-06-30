<?php

namespace Backend\Core\Engine\Base;


trait DeprecationTrait
{
    /** @deprecated use Twig assetic */
    public function addCSS($file, $module = null, $overwritePath = false, $minify = true, $addTimestamp = false)
    {}

    /** @deprecated use Twig assetic */
    public function addJS($file, $module = null, $minify = true, $overwritePath = false, $addTimestamp = false)
    {}

    /** @deprecated use Twig assetic */
    public function addJsData($module, $key, $value)
    {}

    /** @deprecated use Twig assetic */
    public function getCSSFiles()
    {}

    /** @deprecated use Twig assetic */
    public function getJSFiles()
    {}

    /** @deprecated use Twig assetic */
    private function minifyCSS($file)
    {}

    /** @deprecated use Twig assetic */
    private function minifyJS($file)
    {}
}