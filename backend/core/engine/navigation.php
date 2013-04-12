<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * This class will be used to build the navigation
 *
 * @author Tijs Verkoyen <tijs@sumocoders.be>
 * @author Dave Lens <dave.lens@netlash.com>
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 * @author Dieter Vanden Eynde <dieter.vandeneynde@netlash.com>
 */
class BackendNavigation
{
	/**
	 * The navigation array, will be used to build the navigation
	 *
	 * @var	array
	 */
	public $navigation = array();

	/**
	 * URL-instance
	 *
	 * @var	BackendURL
	 */
	private $URL;

	public function __construct()
	{
		// store in reference so we can access it from everywhere
		Spoon::set('navigation', $this);

		// grab from the reference
		$this->URL = Spoon::get('url');

		// check if navigation cache file exists
		if(!BackendModel::getContainer()->get('filesystem')->exists(BACKEND_CACHE_PATH . '/navigation/navigation.php'))
		{
			$this->buildCache();
		}

		$navigation = array();

		// require navigation-file
		require_once BACKEND_CACHE_PATH . '/navigation/navigation.php';

		// load it
		$this->navigation = (array) $navigation;

		// cleanup navigation (not needed for god user)
		if(!BackendAuthentication::getUser()->isGod())
		{
			$this->navigation = $this->cleanup($this->navigation);
		}
	}

	/**
	 * Build navigation cache file.
	 */
	public function buildCache()
	{
		$navigationTree = '';

		// build tree starting with the root
		$this->buildNavigation(0, $navigationTree);

		// start generating PHP
		$value = '<?php' . "\n";
		$value .= '/*' . "\n";
		$value .= ' *' . "\n";
		$value .= ' * This file is generated by the Backend, it contains' . "\n";
		$value .= ' * more information about the navigation in the backend. Do NOT edit.' . "\n";
		$value .= ' * ' . "\n";
		$value .= ' * @author Backend' . "\n";
		$value .= ' * @generated	' . date('Y-m-d H:i:s') . "\n";
		$value .= ' */' . "\n";
		$value .= "\n";
		$value .= "\$navigation = array(\n";

		// add navigation tree
		$value .= $navigationTree;

		// close php
		$value .= ");\n";
		$value .= "\n";
		$value .= '?>';

		// store
		SpoonFile::setContent(BACKEND_CACHE_PATH . '/navigation/navigation.php', $value);
	}

	/**
	 * Build the HTML for a navigation item
	 *
	 * @param array $value The current value.
	 * @param string $key The current key.
	 * @param array[optional] $selectedKeys The keys that are selected.
	 * @param int[optional] $startDepth The depth to start from.
	 * @param int[optional] $endDepth The depth to end.
	 * @param int[optional] $currentDepth The depth the method is currently on.
	 * @return string
	 */
	public function buildHTML(array $value, $key, array $selectedKeys = null, $startDepth = 0, $endDepth = null, $currentDepth = 0)
	{
		// return
		if($endDepth !== null && $currentDepth >= $endDepth) return '';

		// needed elements are set?
		if(isset($value['url']) && isset($value['label']))
		{
			// init some vars
			$selected = (isset($selectedKeys[$currentDepth]) && $selectedKeys[$currentDepth] == $key);
			$label = SpoonFilter::ucfirst(BL::lbl($value['label']));
			$url = $value['url'];

			// start HTML
			$HTML = '';

			// que? let's call this piece magic
			if($currentDepth >= $startDepth - 1)
			{
				// start li
				if($selected) $HTML .= '<li class="selected">' . "\n";
				else $HTML .= '<li>' . "\n";
				$HTML .= '	<a href="/' . NAMED_APPLICATION . '/' . BackendLanguage::getWorkingLanguage() . '/' . $url . '">' . $label . '</a>' . "\n";
			}

			// children?
			if($selected && isset($value['children']))
			{
				// end depth not passed or isn't reached
				if($endDepth === null || $currentDepth < $endDepth)
				{
					// start ul if needed
					if($currentDepth != 0) $HTML .= '<ul>' . "\n";

					// loop children
					foreach($value['children'] as $subKey => $row)
					{
						$HTML .= '	' . $this->buildHTML($row, $subKey, $selectedKeys, $startDepth, $endDepth, $currentDepth + 1);
					}

					// end ul if needed
					if($currentDepth != 0) $HTML .= '</ul>' . "\n";
				}
			}

			// end
			if($currentDepth >= $startDepth - 1) $HTML .= '</li>' . "\n";
		}

		return $HTML;
	}

	/**
	 * Build navigation tree for a parent id.
	 *
	 * @param int $parentId The id of the parent.
	 * @param string $output The output, will all output.
	 * @param int[optional] $depth The current depth.
	 */
	private function buildNavigation($parentId, &$output, $depth = 1)
	{
		// prefix every line with some tabs based on the depth
		$prefix = str_repeat("\t", $depth);

		// get navigation for backend
		$navigation = (array) BackendModel::getContainer()->get('database')->getRecords(
			'SELECT bn.*, COUNT(bn2.id) AS num_children
			 FROM backend_navigation AS bn
			 LEFT OUTER JOIN backend_navigation AS bn2 ON bn2.parent_id = bn.id
			 WHERE bn.parent_id = ?
			 GROUP BY bn.id
			 ORDER BY bn.sequence ASC',
			array((int) $parentId)
		);

		// output
		foreach($navigation as $i => $item)
		{
			// check if this item has children, later used
			$hasChildren = (bool) $item['num_children'];
			$hasSelectedFor = $item['selected_for'] !== null;

			// no url set, fetch the url of the first child
			if($item['url'] == '') $item['url'] = $this->getNavigationUrl($item['id']);

			// general
			$output .= $prefix . "array(\n";
			$output .= $prefix . "\t'url' => '" . $item['url'] . "',\n";
			$output .= $prefix . "\t'label' => '" . $item['label'] . "'" . (($hasChildren || $hasSelectedFor) ? ',' : '') . "\n";

			// selected for
			if($hasSelectedFor)
			{
				// unserialize
				$selectedFor = unserialize($item['selected_for']);

				// make sure we have items
				if(!empty($selectedFor))
				{
					// open
					$output .= $prefix . "\t'selected_for' => array(\n";

					// add each item
					foreach($selectedFor as $ii => $selectedItem)
					{
						$output .= $prefix . "\t\t'" . $selectedItem . "'" . ($ii < (count($selectedFor) - 1) ? ',' : '') . "\n";
					}

					// close
					$output .= $prefix . "\t)" . ($hasChildren ? ',' : '') . "\n";
				}
			}

			// add children
			if($hasChildren)
			{
				// open
				$output .= $prefix . "\t'children' => array(\n";

				// children
				$this->buildNavigation($item['id'], $output, $depth + 2);

				// close
				$output .= $prefix . "\t)\n";
			}

			// close
			$output .= $prefix . ')' . ($i < (count($navigation) - 1) ? ',' : '') . "\n";
		}
	}

	/**
	 * Clean the navigation
	 *
	 * @param array $navigation The navigation array.
	 * @return array
	 */
	private function cleanup(array $navigation)
	{
		foreach($navigation as $key => $value)
		{
			$allowedChildren = array();

			// error?
			$allowed = true;

			// get rid of invalid items
			if(!isset($value['url']) || !isset($value['label'])) $allowed = false;

			// split up chunks
			list($module, $action) = explode('/', $value['url']);

			// no rights for this module?
			if(!BackendAuthentication::isAllowedModule($module)) $allowed = false;

			// no rights for this action?
			if(!BackendAuthentication::isAllowedAction($action, $module)) $allowed = false;

			// has children
			if(isset($value['children']) && is_array($value['children']) && !empty($value['children']))
			{
				// loop children
				foreach($value['children'] as $keyB => $valueB)
				{
					// error?
					$allowed = true;

					// init var
					$allowedChildrenB = array();

					// get rid of invalid items
					if(!isset($valueB['url']) || !isset($valueB['label'])) $allowed = false;

					// split up chunks
					list($module, $action) = explode('/', $valueB['url']);

					// no rights for this module?
					if(!BackendAuthentication::isAllowedModule($module)) $allowed = false;

					// no rights for this action?
					if(!BackendAuthentication::isAllowedAction($action, $module)) $allowed = false;

					// has children
					if(isset($valueB['children']) && is_array($valueB['children']) && !empty($valueB['children']))
					{
						// loop children
						foreach($valueB['children'] as $keyC => $valueC)
						{
							// error?
							$allowed = true;

							// get rid of invalid items
							if(!isset($valueC['url']) || !isset($valueC['label'])) $allowed = false;

							// split up chunks
							list($module, $action) = explode('/', $valueC['url']);

							// no rights for this module?
							if(!BackendAuthentication::isAllowedModule($module)) $allowed = false;

							// no rights for this action?
							if(!BackendAuthentication::isAllowedAction($action, $module)) $allowed = false;

							// error occurred
							if(!$allowed)
							{
								unset($navigation[$key]['children'][$keyB]['children'][$keyC]);
								continue;
							}

							// store allowed children
							elseif(!in_array($navigation[$key]['children'][$keyB]['children'][$keyC], $allowedChildrenB)) $allowedChildrenB[] = $navigation[$key]['children'][$keyB]['children'][$keyC];
						}
					}

					// error occurred and no allowed children on level B
					if(!$allowed && empty($allowedChildrenB))
					{
						unset($navigation[$key]['children'][$keyB]);
						continue;
					}

					// store allowed children on level B
					elseif(!in_array($navigation[$key]['children'][$keyB], $allowedChildren)) $allowedChildren[] = $navigation[$key]['children'][$keyB];

					// assign new base url for level B
					if(!empty($allowedChildrenB)) $navigation[$key]['children'][$keyB]['url'] = $allowedChildrenB[0]['url'];
				}
			}

			// error occurred and no allowed children
			if(!$allowed && empty($allowedChildren))
			{
				unset($navigation[$key]);
				continue;
			}

			// assign new base url
			elseif(!empty($allowedChildren))
			{
				// init var
				$allowed = true;

				// split up chunks
				list($module, $action) = explode('/', $allowedChildren[0]['url']);

				// no rights for this module?
				if(!BackendAuthentication::isAllowedModule($module)) $allowed = false;

				// no rights for this action?
				if(!BackendAuthentication::isAllowedAction($action, $module)) $allowed = false;

				// allowed? assign base URL
				if($allowed) $navigation[$key]['url'] = $allowedChildren[0]['url'];

				// not allowed?
				else
				{
					// get first child
					$child = reset($navigation[$key]['children']);

					// assign base URL
					$navigation[$key]['url'] = $child['url'];
				}
			}
		}

		return $navigation;
	}

	/**
	 * Try to determine the selected state
	 *
	 * @param array $value The value.
	 * @param int $key The key.
	 * @param array[optional] $keys The previous marked keys.
	 * @return mixed
	 */
	private function compareURL(array $value, $key, $keys = array())
	{
		// create active url
		$activeURL = $this->URL->getModule() . '/' . $this->URL->getAction();

		// add current key
		$keys[] = $key;

		// sub action?
		if(isset($value['selected_for']) && in_array($activeURL, (array) $value['selected_for'])) return $keys;

		// if the URL is available and same as the active one we have what we need.
		if(isset($value['url']) && $value['url'] == $activeURL)
		{
			if(isset($value['children']))
			{
				// loop the children
				foreach($value['children'] as $key => $value)
				{
					// recursive here...
					$subKeys = $this->compareURL($value, $key, $keys);

					// wrap it up
					if(!empty($subKeys)) return $subKeys;
				}
			}

			// fallback
			return $keys;
		}

		// any children
		if(isset($value['children']))
		{
			// loop the children
			foreach($value['children'] as $key => $value)
			{
				// recursive here...
				$subKeys = $this->compareURL($value, $key, $keys);

				// wrap it up
				if(!empty($subKeys)) return $subKeys;
			}
		}
	}

	/**
	 * Get the HTML for the navigation
	 *
	 * @param int[optional] $startDepth The start-depth.
	 * @param int[optional] $endDepth The end-depth.
	 * @return string
	 */
	public function getNavigation($startDepth = 0, $endDepth = null)
	{
		// get selected
		$selectedKeys = $this->getSelectedKeys();

		// init html
		$HTML = '<ul>' . "\n";

		// loop the navigation elements
		foreach($this->navigation as $key => $value)
		{
			// append the generated HTML
			$HTML .= $this->buildHTML($value, $key, $selectedKeys, $startDepth, $endDepth);
		}

		// end ul
		$HTML .= '</ul>';

		return $HTML;
	}

	/**
	 * Get the url of a navigation item.
	 * If the item doesn't have an id, it will search recursively until it finds one.
	 *
	 * @param int $id The id to search for.
	 * @return string
	 */
	private function getNavigationUrl($id)
	{
		$id = (int) $id;

		// get url
		$item = (array) BackendModel::getContainer()->get('database')->getRecord('SELECT id, url FROM backend_navigation WHERE id = ?',	array($id));

		// item doesn't exist
		if(empty($item)) return '';

		// yay, has a url
		elseif($item['url'] != '') return $item['url'];

		// lets get it from a child
		else
		{
			// get the first child
			$childId = (int) BackendModel::getContainer()->get('database')->getVar('SELECT id FROM backend_navigation WHERE parent_id = ? ORDER BY sequence ASC LIMIT 1', array($id));

			// get its url
			return $this->getNavigationUrl($childId);
		}
	}

	/**
	 * Get the selected keys based on the current module/actions
	 *
	 * @return array
	 */
	private function getSelectedKeys()
	{
		foreach($this->navigation as $key => $value)
		{
			// get the keys
			$keys = $this->compareURL($value, $key, array());

			// stop when we found something
			if(!empty($keys)) break;
		}

		// return the selected keys
		return $keys;
	}
}
