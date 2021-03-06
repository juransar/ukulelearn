<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 25.03.2017
 * Time: 23:15
 */
namespace App\Forms;
use App\Model\Chord;
use Nette;
use App\Model;
use Nette\Application\UI\Form;
use Kdyby\Doctrine\EntityManager;

/**
 * Class ChordForm
 * @package App\Forms
 */
class ChordForm extends Nette\Object
{
    /**
     * manager pro praci s databazi
     * @var  EntityManager $em
     */
    private $em;
    /**
     * repository pro tridu Chord, ktera umoznuje provadet databazove operace nad jejimi objekty
     * @var Model\SongRepository
     */
    private $chordRepository;


    /**
     * ChordForm constructor.
     * @param EntityManager $entityManager
     * @param Model\ChordRepository $chordRepository
     */
    public function __construct(EntityManager $entityManager, Model\ChordRepository $chordRepository)
    {
        $this->em = $entityManager;
        $this->chordRepository = $chordRepository;
    }

    /**
     * funkce pro vytvoreni formulare k vkladani noveho akordu
     * @param integer $id
     * @return Form
     */
    public function create($id = null)
    {
        $form = new Form();
        $form->addText('name', 'name of the chord:')
            ->addRule(Form::FILLED, 'Mandatory field - Name');
        $form->addTextArea('notation', 'notation:')
            ->addRule(Form::FILLED, 'Mandatory field - Notation');

        $form->addSubmit('send', 'Save');
        $form->onSuccess[] = $this->songFormSuccess;
        return $form;
    }
    /**
     * po odeslani formulare se novy akord ulozi do databaze
     * @param Form $form
     */
    public function songFormSuccess(Form $form)
    {
        $values = $form->getValues();
        try{


            $chord = new Chord();
            $chord->setName($values->name);
            $chord->setNotation($values->notation);
            $this->chordRepository->save($chord);
            # odešleme zprávu o úspěchu
            $form->getPresenter()->flashMessage('Chord added '.$values->name);

            #presmerujeme sama na sebe
            $form->getPresenter()->redirect('this', array('id' => $chord->getId()));
        }
        catch (\Exception $e)
        {
            $form->addError($e->getMessage());
        }
    }
}