<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 26.03.2017
 * Time: 22:59
 */

namespace App\Presenters;
use App\Forms\LoginForm;
use Nette\Application\UI\Presenter;


/**
 * Class LoginPresenter
 * @package App\Presenters
 */
class LoginPresenter extends BasePresenter
{
    /**
     * Trida pro formulare k prihlasovani
     * @var  LoginForm @inject */
    public $loginManager;

    /**
     * Create Login Form
     * @return \Nette\Application\UI\Form $form
     */
    public function createComponentLoginForm()
    {
        $form = $this->loginManager->create();
        $form->onSuccess[] = function ($form)
        {
            # po uspěšném přihlášení přesměrujeme do administrace
            $this->getPresenter()->redirect('Homepage:default');
        };
        return $form;
    }
    # odhlaseni uzivatele
    /**
     * Odhlasuje uzivatele a presmerovava na domovskou stranku
     */
    public function actionOut()
    {
        $this->getUser()->logout(TRUE);
        $this->redirect('Homepage:default');
    }


}
