<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 25.03.2017
 * Time: 21:27
 */

namespace App\Model;
use App\Model\Song;
use Kdyby\Doctrine\EntityManager;
use Nette\Object;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Model\CRUD;
use App\Model\OneLine;

/**
 * Class SongRepository
 * @package App\Model
 */
class SongRepository extends Object
{
    use CRUD;
    /**
     * repository pro tridu OnePart, ktera umoznuje provadet databazove operace nad jejimi objekty
     * @var
     */
    public $onePartRepository;
    /**
     * repository pro tridu OneLine, ktera umoznuje provadet databazove operace nad jejimi objekty
     * @var
     */
    public $oneLineRepository;

    /**
     * inejktuje potrebne repozitare
     * @param OneLineRepository $oneLineRepository
     * @param OnePartRepository $onePartRepository
     */
    public function injectDependencies(OneLineRepository $oneLineRepository, OnePartRepository $onePartRepository)
    {
        $this->oneLineRepository =$oneLineRepository;
        $this->onePartRepository= $onePartRepository;
    }
    /**
     * Najde a vrátí pisen podle jeji ID.
     * @param int|NULL $id ID id pisne
     * @return Song|NULL vrátí entitu pisne nebo NULL pokud pisen nebyla nalezen
     */
    public function getSong($id)
    {
        return isset($id) ? $this->em->find(Song::class, $id) : NULL;
    }

    /**
     * Najde a vrati vsechny pisne
     * @return Song[] seznam skladeb
     */
    public function findAll()
    {
        return $this->em->getRepository(Song::getClassName())->findAll();
    }

    /**
     * Najde a vrati pisne podle interpreta
     * @param $id id interpreta
     * @return Song[] seznam skladeb urciteho interpreta
     */
    public function findbyArtist($id){
        $songs=$this->findAll();
        $result=[];
        foreach ($songs as $song){
            if($song->getArtist()->getId()==$id)$result[]=$song;
        }
        return $result;
    }

    /**
     * Najde a vrati pisne zacinajici na urcite pismeno
     * @param $i pismeno podle ktereho se vyhledava
     * @return Song[] seznam skladeb zacinajici na urcite pismeno
     */
    public function findByLetter($i){
        $query = $this->em->createQuery('SELECT u FROM App\Model\Song u WHERE u.title LIKE :foo');
        $query->setParameter('foo', $i.'%');
        $songs = $query->getResult();
        return $songs;
    }

    /**
     * smaze vsechny OnePart/OneLine nalezici pisnicce s danym id
     * @param $id
     */
    public function deleteLyrics($id){
        $song=$this->getSong($id);
        $text=$song->getText();
        foreach ($text as $line){
            foreach ($line->getParts() as $part){
                $this->onePartRepository->delete($part);
            }
            $this->oneLineRepository->delete($line);
        }

    }
}