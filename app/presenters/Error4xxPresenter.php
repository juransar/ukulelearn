<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 02.04.2017
 * Time: 15:54
 */
namespace App\Presenters;

use Nette;


/**
 * Class Error4xxPresenter
 * @package App\Presenters
 */
class Error4xxPresenter extends BasePresenter
{

    /**
     *
     */
    public function startup()
	{
		parent::startup();
		if (!$this->getRequest()->isMethod(Nette\Application\Request::FORWARD)) {
			$this->error();
		}
	}


    /**
     * @param Nette\Application\BadRequestException $exception
     */
    public function renderDefault(Nette\Application\BadRequestException $exception)
	{
		// load template 403.latte or 404.latte or ... 4xx.latte
		$file = __DIR__ . "/templates/Error/{$exception->getCode()}.latte";
		$this->template->setFile(is_file($file) ? $file : __DIR__ . '/templates/Error/4xx.latte');
	}

}
