<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<table<?php
						if(isset($this->variables['summary']) && count($this->variables['summary']) != 0 && $this->variables['summary'] != '' && $this->variables['summary'] !== false)
						{
							?> summary="<?php if(array_key_exists('summary', (array) $this->variables)) { echo $this->variables['summary']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getSummary')) { echo $this->variables->getSummary(); } else { ?>{$summary}<?php } ?>"<?php } ?><?php if(array_key_exists('attributes', (array) $this->variables)) { echo $this->variables['attributes']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getAttributes')) { echo $this->variables->getAttributes(); } else { ?>{$attributes}<?php } ?>>
<?php
						if(isset($this->variables['caption']) && count($this->variables['caption']) != 0 && $this->variables['caption'] != '' && $this->variables['caption'] !== false)
						{
							?>
<caption><?php if(array_key_exists('caption', (array) $this->variables)) { echo $this->variables['caption']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getCaption')) { echo $this->variables->getCaption(); } else { ?>{$caption}<?php } ?></caption>
<?php } ?>
<thead>
  <tr>
    <?php
						if(!isset($this->variables['headers']))
						{
							?>{iteration:headers}<?php
							$this->variables['headers'] = array();
							$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['fail'] = true;
						}
					$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['iteration'] = $this->variables['headers'];
				if(isset(${'headers'})) $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['old'] = ${'headers'};
				$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['i'] = 1;
				$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['count'] = count($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['iteration']);
				foreach($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['iteration'] as ${'headers'})
				{
					if(is_array(${'headers'}))
					{
						if(!isset(${'headers'}['first']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['i'] == 1) ${'headers'}['first'] = true;
						if(!isset(${'headers'}['last']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['i'] == $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['count']) ${'headers'}['last'] = true;
						if(isset(${'headers'}['formElements']) && is_array(${'headers'}['formElements']))
						{
							foreach(${'headers'}['formElements'] as $name => $object)
							{
								${'headers'}[$name] = $object->parse();
								${'headers'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
    <th
      <?php if(array_key_exists('attributes', (array) ${'headers'})) { echo ${'headers'}['attributes']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getAttributes')) { echo ${'headers'}->getAttributes(); } else { ?>{$headers->attributes}<?php } ?>>
      <?php
						if(
							(is_object(${'headers'}) && ${'headers'}->getSorting() && ${'headers'}->getSorting() != '' && ${'headers'}->getSorting() !== false)
							|| (is_array(${'headers'}) && isset(${'headers'}['sorting']) && count(${'headers'}['sorting']) != 0 && ${'headers'}['sorting'] != '' && ${'headers'}['sorting'] !== false))
						{
							?>
      <?php
						if(
							(is_object(${'headers'}) && ${'headers'}->getSorted() && ${'headers'}->getSorted() != '' && ${'headers'}->getSorted() !== false)
							|| (is_array(${'headers'}) && isset(${'headers'}['sorted']) && count(${'headers'}['sorted']) != 0 && ${'headers'}['sorted'] != '' && ${'headers'}['sorted'] !== false))
						{
							?>
      <?php
						if(
							(is_object(${'headers'}) && ${'headers'}->getSortedAsc() && ${'headers'}->getSortedAsc() != '' && ${'headers'}->getSortedAsc() !== false)
							|| (is_array(${'headers'}) && isset(${'headers'}['sortedAsc']) && count(${'headers'}['sortedAsc']) != 0 && ${'headers'}['sortedAsc'] != '' && ${'headers'}['sortedAsc'] !== false))
						{
							?>
      <a href="<?php if(array_key_exists('sortingURL', (array) ${'headers'})) { echo ${'headers'}['sortingURL']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getSortingURL')) { echo ${'headers'}->getSortingURL(); } else { ?>{$headers->sortingURL}<?php } ?>" title="<?php if(array_key_exists('sortingLabel', (array) ${'headers'})) { echo ${'headers'}['sortingLabel']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getSortingLabel')) { echo ${'headers'}->getSortingLabel(); } else { ?>{$headers->sortingLabel}<?php } ?>" class="sortable sorted">
        <?php if(array_key_exists('label', (array) ${'headers'})) { echo ${'headers'}['label']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getLabel')) { echo ${'headers'}->getLabel(); } else { ?>{$headers->label}<?php } ?> <span class="fa fa-sort-asc"></span>
      </a>
      <?php } ?>
      <?php
						if(
							(is_object(${'headers'}) && ${'headers'}->getSortedDesc() && ${'headers'}->getSortedDesc() != '' && ${'headers'}->getSortedDesc() !== false)
							|| (is_array(${'headers'}) && isset(${'headers'}['sortedDesc']) && count(${'headers'}['sortedDesc']) != 0 && ${'headers'}['sortedDesc'] != '' && ${'headers'}['sortedDesc'] !== false))
						{
							?>
      <a href="<?php if(array_key_exists('sortingURL', (array) ${'headers'})) { echo ${'headers'}['sortingURL']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getSortingURL')) { echo ${'headers'}->getSortingURL(); } else { ?>{$headers->sortingURL}<?php } ?>" title="<?php if(array_key_exists('sortingLabel', (array) ${'headers'})) { echo ${'headers'}['sortingLabel']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getSortingLabel')) { echo ${'headers'}->getSortingLabel(); } else { ?>{$headers->sortingLabel}<?php } ?>" class="sortable sorted">
        <?php if(array_key_exists('label', (array) ${'headers'})) { echo ${'headers'}['label']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getLabel')) { echo ${'headers'}->getLabel(); } else { ?>{$headers->label}<?php } ?> <span class="fa fa-sort-desc"></span>
      </a>
      <?php } ?>
      <?php } ?>
      <?php
						if(
							(is_object(${'headers'}) && ${'headers'}->getNotSorted() && ${'headers'}->getNotSorted() != '' && ${'headers'}->getNotSorted() !== false)
							|| (is_array(${'headers'}) && isset(${'headers'}['notSorted']) && count(${'headers'}['notSorted']) != 0 && ${'headers'}['notSorted'] != '' && ${'headers'}['notSorted'] !== false))
						{
							?>
      <a href="<?php if(array_key_exists('sortingURL', (array) ${'headers'})) { echo ${'headers'}['sortingURL']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getSortingURL')) { echo ${'headers'}->getSortingURL(); } else { ?>{$headers->sortingURL}<?php } ?>" title="<?php if(array_key_exists('sortingLabel', (array) ${'headers'})) { echo ${'headers'}['sortingLabel']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getSortingLabel')) { echo ${'headers'}->getSortingLabel(); } else { ?>{$headers->sortingLabel}<?php } ?>" class="sortable">
        <?php if(array_key_exists('label', (array) ${'headers'})) { echo ${'headers'}['label']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getLabel')) { echo ${'headers'}->getLabel(); } else { ?>{$headers->label}<?php } ?> <span class="fa fa-sort"></span>
      </a>
      <?php } ?>
      <?php } ?>
      <?php
						if(
							(is_object(${'headers'}) && ${'headers'}->getNoSorting() && ${'headers'}->getNoSorting() != '' && ${'headers'}->getNoSorting() !== false)
							|| (is_array(${'headers'}) && isset(${'headers'}['noSorting']) && count(${'headers'}['noSorting']) != 0 && ${'headers'}['noSorting'] != '' && ${'headers'}['noSorting'] !== false))
						{
							?>
      <?php
						if(
							(is_object(${'headers'}) && ${'headers'}->getLabel() && ${'headers'}->getLabel() != '' && ${'headers'}->getLabel() !== false)
							|| (is_array(${'headers'}) && isset(${'headers'}['label']) && count(${'headers'}['label']) != 0 && ${'headers'}['label'] != '' && ${'headers'}['label'] !== false))
						{
							?>
      <span><?php if(array_key_exists('label', (array) ${'headers'})) { echo ${'headers'}['label']; } elseif(is_object(${'headers'}) && method_exists(${'headers'}, 'getLabel')) { echo ${'headers'}->getLabel(); } else { ?>{$headers->label}<?php } ?></span>
      <?php } ?>
      <?php if(
							(is_object(${'headers'}) && (!${'headers'}->getLabel() || ${'headers'}->getLabel() == '' || ${'headers'}->getLabel() === false))
							|| (is_array(${'headers'}) && (!isset(${'headers'}['label']) || count(${'headers'}['label']) == 0 || ${'headers'}['label'] == '' || ${'headers'}['label'] === false))): ?>
      <span>&#160;</span>
      <?php endif; ?>
      <?php } ?>
    </th>
    <?php
					$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['fail']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:headers}<?php
					}
				if(isset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['old'])) ${'headers'} = $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']['old'];
				else unset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_1']);
				?>
  </tr>
</thead>
<tbody>
  <?php
						if(!isset($this->variables['rows']))
						{
							?>{iteration:rows}<?php
							$this->variables['rows'] = array();
							$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['fail'] = true;
						}
					$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['iteration'] = $this->variables['rows'];
				if(isset(${'rows'})) $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['old'] = ${'rows'};
				$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['i'] = 1;
				$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['count'] = count($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['iteration']);
				foreach($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['iteration'] as ${'rows'})
				{
					if(is_array(${'rows'}))
					{
						if(!isset(${'rows'}['first']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['i'] == 1) ${'rows'}['first'] = true;
						if(!isset(${'rows'}['last']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['i'] == $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['count']) ${'rows'}['last'] = true;
						if(isset(${'rows'}['formElements']) && is_array(${'rows'}['formElements']))
						{
							foreach(${'rows'}['formElements'] as $name => $object)
							{
								${'rows'}[$name] = $object->parse();
								${'rows'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
  <tr
    <?php if(array_key_exists('attributes', (array) ${'rows'})) { echo ${'rows'}['attributes']; } elseif(is_object(${'rows'}) && method_exists(${'rows'}, 'getAttributes')) { echo ${'rows'}->getAttributes(); } else { ?>{$rows->attributes}<?php } ?>>
    <?php
						if(!isset(${'rows'}['columns']))
						{
							?>{iteration:rows->columns}<?php
							${'rows'}['columns'] = array();
							$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['fail'] = true;
						}
					$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['iteration'] = ${'rows'}['columns'];
				if(isset(${'rows'}['columns'])) $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['old'] = ${'rows'}['columns'];
				$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['i'] = 1;
				$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['count'] = count($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['iteration']);
				foreach($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['iteration'] as ${'rows'}['columns'])
				{
					if(is_array(${'rows'}['columns']))
					{
						if(!isset(${'rows'}['columns']['first']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['i'] == 1) ${'rows'}['columns']['first'] = true;
						if(!isset(${'rows'}['columns']['last']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['i'] == $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['count']) ${'rows'}['columns']['last'] = true;
						if(isset(${'rows'}['columns']['formElements']) && is_array(${'rows'}['columns']['formElements']))
						{
							foreach(${'rows'}['columns']['formElements'] as $name => $object)
							{
								${'rows'}['columns'][$name] = $object->parse();
								${'rows'}['columns'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
    <td
      <?php if(isset(${'rows'}['columns']) && array_key_exists('attributes', (array) ${'rows'}['columns'])) { echo ${'rows'}['columns']['attributes']; } elseif(is_object(${'rows'}['columns']) && method_exists(${'rows'}['columns'], 'getAttributes')) { echo ${'rows'}['columns']->getAttributes(); } else { ?>{$rows->columns.attributes}<?php } ?>><?php if(isset(${'rows'}['columns']) && array_key_exists('value', (array) ${'rows'}['columns'])) { echo ${'rows'}['columns']['value']; } elseif(is_object(${'rows'}['columns']) && method_exists(${'rows'}['columns'], 'getValue')) { echo ${'rows'}['columns']->getValue(); } else { ?>{$rows->columns.value}<?php } ?>
    </td>
    <?php
					$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['i']++;
				}
					if(isset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['fail']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['fail'] == true)
					{
						?>{/iteration:rows->columns}<?php
					}
				if(isset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['old'])) ${'rows'}['columns'] = $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']['old'];
				else unset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_3']['columns']);
				?>
  </tr>
  <?php
					$this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['fail']) && $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:rows}<?php
					}
				if(isset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['old'])) ${'rows'} = $this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']['old'];
				else unset($this->iterations['7b1891f62555b2f8dd73addf43a07ce1_Datagrid.tpl.php_2']);
				?>
</tbody>
<?php
						if(isset($this->variables['footer']) && count($this->variables['footer']) != 0 && $this->variables['footer'] != '' && $this->variables['footer'] !== false)
						{
							?>
<tfoot>
  <tr
    <?php if(array_key_exists('footerAttributes', (array) $this->variables)) { echo $this->variables['footerAttributes']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFooterAttributes')) { echo $this->variables->getFooterAttributes(); } else { ?>{$footerAttributes}<?php } ?>>
    <td colspan="<?php if(array_key_exists('numColumns', (array) $this->variables)) { echo $this->variables['numColumns']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getNumColumns')) { echo $this->variables->getNumColumns(); } else { ?>{$numColumns}<?php } ?>">
      <div class="form-inline">
        <?php
						if(isset($this->variables['massAction']) && count($this->variables['massAction']) != 0 && $this->variables['massAction'] != '' && $this->variables['massAction'] !== false)
						{
							?>
        <div class="form-group jsMassAction">
          <?php if(array_key_exists('massAction', (array) $this->variables)) { echo $this->variables['massAction']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMassAction')) { echo $this->variables->getMassAction(); } else { ?>{$massAction}<?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php
						if(isset($this->variables['paging']) && count($this->variables['paging']) != 0 && $this->variables['paging'] != '' && $this->variables['paging'] !== false)
						{
							?>
      <div class="text-center">
        <?php if(array_key_exists('paging', (array) $this->variables)) { echo $this->variables['paging']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getPaging')) { echo $this->variables->getPaging(); } else { ?>{$paging}<?php } ?>
      </div>
      <?php } ?>
    </td>
  </tr>
</tfoot>
<?php } ?>
</table>
<?php
						if(isset($this->variables['excludedCheckboxesData']) && count($this->variables['excludedCheckboxesData']) != 0 && $this->variables['excludedCheckboxesData'] != '' && $this->variables['excludedCheckboxesData'] !== false)
						{
							?>
<script type="text/javascript">
  //<![CDATA[
  window.onload = function()
  {
    if (typeof excludedCheckboxesData != undefined) var excludedCheckboxesData = [];
    excludedCheckboxesData['<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } elseif(is_object($this->variables['excludedCheckboxesData']) && method_exists($this->variables['excludedCheckboxesData'], 'getId')) { echo $this->variables['excludedCheckboxesData']->getId(); } else { ?>{$excludedCheckboxesData.id}<?php } ?>'] = {$excludedCheckboxesData.JSON
  }
    ;

    // loop and remove elements
    for (var i in
      excludedCheckboxesData['<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } elseif(is_object($this->variables['excludedCheckboxesData']) && method_exists($this->variables['excludedCheckboxesData'], 'getId')) { echo $this->variables['excludedCheckboxesData']->getId(); } else { ?>{$excludedCheckboxesData.id}<?php } ?>']) {
      $('#<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } elseif(is_object($this->variables['excludedCheckboxesData']) && method_exists($this->variables['excludedCheckboxesData'], 'getId')) { echo $this->variables['excludedCheckboxesData']->getId(); } else { ?>{$excludedCheckboxesData.id}<?php } ?> input[value=' + excludedCheckboxesData['<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } elseif(is_object($this->variables['excludedCheckboxesData']) && method_exists($this->variables['excludedCheckboxesData'], 'getId')) { echo $this->variables['excludedCheckboxesData']->getId(); } else { ?>{$excludedCheckboxesData.id}<?php } ?>'][i] + ']').remove();
    }
  }
  //]]>
</script>
<?php } ?>
<?php
						if(isset($this->variables['checkedCheckboxesData']) && count($this->variables['checkedCheckboxesData']) != 0 && $this->variables['checkedCheckboxesData'] != '' && $this->variables['checkedCheckboxesData'] !== false)
						{
							?>
<script type="text/javascript">
  //<![CDATA[
  window.onload = function()
  {
    if (typeof checkedCheckboxesData != undefined) var checkedCheckboxesData = [];
    checkedCheckboxesData['<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } elseif(is_object($this->variables['checkedCheckboxesData']) && method_exists($this->variables['checkedCheckboxesData'], 'getId')) { echo $this->variables['checkedCheckboxesData']->getId(); } else { ?>{$checkedCheckboxesData.id}<?php } ?>'] = {$checkedCheckboxesData.JSON
  }
    ;

    // loop and remove elements
    for (var i in
      checkedCheckboxesData['<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } elseif(is_object($this->variables['checkedCheckboxesData']) && method_exists($this->variables['checkedCheckboxesData'], 'getId')) { echo $this->variables['checkedCheckboxesData']->getId(); } else { ?>{$checkedCheckboxesData.id}<?php } ?>']) {
      $('#<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } elseif(is_object($this->variables['checkedCheckboxesData']) && method_exists($this->variables['checkedCheckboxesData'], 'getId')) { echo $this->variables['checkedCheckboxesData']->getId(); } else { ?>{$checkedCheckboxesData.id}<?php } ?> input[value=' + checkedCheckboxesData['<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } elseif(is_object($this->variables['checkedCheckboxesData']) && method_exists($this->variables['checkedCheckboxesData'], 'getId')) { echo $this->variables['checkedCheckboxesData']->getId(); } else { ?>{$checkedCheckboxesData.id}<?php } ?>'][i] + ']').prop('checked', true);
    }
  }
  //]]>
</script>
<?php } ?>
