<?php
// source: C:\xampp\htdocs\ukulelearn3\app\presenters/templates/Song/addsong.latte

use Latte\Runtime as LR;

class Templatee6a29cd6d7 extends Latte\Runtime\Template
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div style="width:800px;margin: 0 auto">
    <p>When adding the lyrics, please put the chords inside square brackets => "[Chord] Text"</p>
<?php
		/* line 4 */ $_tmp = $this->global->uiControl->getComponent("songForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
		?></div><?php
	}

}
