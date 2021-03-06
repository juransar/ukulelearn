<?php
// source: C:\xampp\htdocs\ukulelearn3\app\presenters/templates/Artist/default.latte

use Latte\Runtime as LR;

class Template8e4c7d125a extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['u'])) trigger_error('Variable $u overwritten in foreach on line 4, 11');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div id="letternav">
    <ul>
<?php
		$iterations = 0;
		foreach ($letters as $u) {
			?>            <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Artist:lettersearch", [$u])) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent() ? 'active' : NULL])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><?php
			echo LR\Filters::escapeHtmlText($u) /* line 6 */ ?></a></li>
<?php
			$iterations++;
		}
?>
    </ul>
</div>
<ul>
<?php
		$iterations = 0;
		foreach ($artists as $u) {
			?>    <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Artist:detail", [$u->id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($u->name) /* line 13 */ ?></a></li>
<?php
			$iterations++;
		}
		?></ul><?php
	}

}
