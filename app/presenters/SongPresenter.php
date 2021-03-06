<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 24.03.2017
 * Time: 22:57
 */

namespace App\Presenters;
use App\Forms\SongForm;
use App\Forms\UserForm;
use App\Model\NoDataFound;

use Nette;
use App\Model;
use Kdyby;

/**
 * Class SongPresenter
 * @package App\Presenters
 */
class SongPresenter extends BasePresenter
{
    /**
     * repository pro tridu Artist, ktera umoznuje provadet databazove operace nad jejimi objekty
     * @var
     */
    protected $artistRepository;
    /**
     * repository pro tridu Song, ktera umoznuje provadet databazove operace nad jejimi objekty
     * @var
     */
    protected $songRepository;
    /**
     * trida pro formulare k pisnickam
     * @var
     */
    protected $songForm;

    /**
     * injektuje zavislosti
     * @param Model\ArtistRepository $artistModel
     * @param Model\SongRepository $songRepository
     * @param SongForm $songForm
     */
    public function injectDependencies(Model\ArtistRepository $artistModel,
                                       Model\SongRepository $songRepository,
                                       SongForm $songForm)
    {
        $this->artistRepository = $artistModel;
        $this->songRepository= $songRepository;
        $this->songForm=$songForm;
    }
    /**
     * zobrazuje seznam vsech pisnicek
     */
    public function renderDefault() {
        $alphas = range('A', 'Z');
        /** TODO - nastavení atributu šablony users */
        $this->template->songs = $this->songRepository->findAll();
        $this->template->letters=$alphas;

    }
    /**
     * Zobrazuje detail jedne pisnicky
     * @param $id
     */
    public function renderDetail($id) {
        /** TODO - nastavení atributu šablony users */
        $this->template->song=$this->songRepository->getSong($id);


    }

    /**
     * Zobrazuje seznam pisnicek zacinajicich na urcite pismeno
     * @param $i
     */
    public function renderLetterSearch($i){
        $this->template->songs=$this->songRepository->findByLetter($i);
        $alphas = range('A', 'Z');
        $this->template->letters=$alphas;
    }

    /**
     * Vytvari formular pro pridani pisnicky
     * @return Nette\Application\UI\Form
     */
    public function createComponentSongForm()
    {
        //$id = $this->getPresenter()->getParameter('id');
        $form = $this->songForm->createAddForm();
        $form->onSuccess[] = function (Nette\Forms\Form $form) {
            $this->redirect('Song:default');
        };
        return $form;
    }
    /**
     * Vytvari formular pro editaci pisnicky
     * @return Nette\Application\UI\Form
     */
    public function createComponentSongEditForm()
    {
        $id = $this->getPresenter()->getParameter('id');
        $form = $this->songForm->createEditForm($id);
        $form->onSuccess[] = function (Nette\Forms\Form $form) {
            $this->redirect('Song:default');
        };
        return $form;
    }

    /**
     * Naplnuje formular pro editaci pisnicky daty
     * @param $id
     */
    public function actionEditSong($id) {
        $form = $this['songEditForm'];
        $song = $this->songRepository->getSong($id);
        $form->setDefaults(['title'=>$song->getTitle(),'text'=>$song->getEntireText(),'artist'=>$song->getArtist()->getName()]);

    }

    /**
     * Zobrazuje formular pro pridani pisnicky
     * @param $id
     */
    public function renderAddSong($id)
    {
    }

    /**
     * Zobrazuje formular pro editaci pisnicky
     * @param $id
     */
    public function renderEditSong($id)
    {
    }

    /**
     * Kontroluje jestli je uzivatel prihlasen
     */
    public function beforeRender()
    {
        if(!$this->getUser()->isLoggedIn()){
            $this->redirect("Login:default");
        }
    }

    /**
     * Akce pro mazání pisnicky
     * @param int $id id pisne
     */
    public function actionDelete($id) {
        $this->songRepository->deleteLyrics($id);
        $this->songRepository->delete($this->songRepository->getSong($id));
        $this->redirect('Song:default');

    }
}