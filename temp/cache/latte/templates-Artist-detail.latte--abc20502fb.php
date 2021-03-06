<?php
// source: C:\xampp\htdocs\ukulelearn3\app\presenters/templates/Artist/detail.latte

use Latte\Runtime as LR;

class Templateabc20502fb extends Latte\Runtime\Template
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
		if (isset($this->params['u'])) trigger_error('Variable $u overwritten in foreach on line 3');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<ul>
<?php
		$iterations = 0;
		foreach ($songs as $u) {
			?>    <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Song:detail", [$u->id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($u->title) /* line 4 */ ?> - <?php echo LR\Filters::escapeHtmlText($u->artist->name) /* line 4 */ ?></a></li>
<?php
			$iterations++;
		}
		?></ul><?php
	}

}
