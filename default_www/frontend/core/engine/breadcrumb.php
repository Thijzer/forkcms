<?php

/**
 * FrontendBreadcrumb
 *
 * This class will be used to manage the breadcrumb
 *
 * @package		frontend
 * @subpackage	core
 *
 * @author 		Tijs Verkoyen <tijs@netlash.com>
 * @since		2.0
 */
class FrontendBreadcrumb extends FrontendBaseObject
{
	/**
	 * The items in the breadcrumb
	 *
	 * @var	array
	 */
	private $items = array();


	/**
	 * Default constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		// call parent
		parent::__construct();

		// add into the reference
		Spoon::setObjectReference('breadcrumb', $this);

		// get more information for the homepage
		$homeInfo = FrontendNavigation::getPageInfo(1);

		// add homepage as first item (with correct element)
		$this->addElement($homeInfo['navigation_title'], FrontendNavigation::getURL(1));

		// get other pages
		$pages = $this->url->getPages();

		// init vars
		$items = array();
		$errorUrl = FrontendNavigation::getUrl(404);

		// loop pages
		while(!empty($pages))
		{
			// init vars
			$url = implode('/', $pages);
			$menuId = FrontendNavigation::getPageId($url);
			$pageInfo = FrontendNavigation::getPageInfo($menuId);

			// do we know something about the page
			if($pageInfo !== false && isset($pageInfo['navigation_title']))
			{
				// get url
				$pageUrl = FrontendNavigation::getUrl($menuId);

				// if this is the error-page, so we won't show an url.
				if($pageUrl == $errorUrl) $pageUrl = null;

				// add to the items
				$items[] = array('title' => $pageInfo['navigation_title'], 'url' => $pageUrl);
			}

			// remove element
			array_pop($pages);
		}

		// reverse so everything is in place
		krsort($items);

		// loop and add elements
		foreach($items as $row)
		{
			$this->addElement($row['title'], $row['url']);
		}
	}


	/**
	 * Add an element
	 *
	 * @return	void
	 * @param	string $title
	 * @param	string[optional] $url
	 */
	public function addElement($title, $url = null)
	{
		$this->items[] = array('title' => (string) $title, 'url' => $url);
	}


	/**
	 * Clear all (or a specific) elements in the breadcrumb
	 *
	 * @return	void
	 * @param	int[optional] $key
	 */
	public function clear($key = null)
	{
		// key given?
		if($key !== null) unset($this->items[(int) $key]);

		// clear all
		else $this->items = array();
	}


	/**
	 * Get all elements
	 *
	 * @return	array
	 */
	public function get()
	{
		return $this->items;
	}


	/**
	 * Parse the breadcrumb into the template
	 *
	 * @return	void
	 */
	public function parse()
	{
		// init vars
		$items = array();
		$first = true;
		$count = count($this->items);

		// loop items and add the seperator
		foreach($this->items as $i => $row)
		{
			// remove url from last element
			if($i >= $count - 1)
			{
				// remove url for last object
				$row['url'] = null;
				$row['last'] = true;
			}

			// not the last element
			else $row['last'] = false;

			// add
			$items[] = $row;

			// no more first
			$first = false;
		}

		// assign
		$this->tpl->assign('breadcrumb', $items);
	}
}
?>