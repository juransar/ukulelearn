<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 25.03.2017
 * Time: 21:27
 */

namespace App\Model;
use App\Model\Artist;
use App\Model\CRUD;
use Kdyby\Doctrine\EntityManager;
use Nette\Object;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class ArtistRepository
 * @package App\Model
 */
class ArtistRepository extends Object
{
    use CRUD;


    /**
     * Najde a vrati vsechny interprety
     * @return Artist[]|array interpretu
     */
    public function findAll()
    {
        return $this->artistRepository->findAll();
    }
    /**
     * Najde a vrátí Interpreta podle jeho jmena.
     * @param string|NULL $name jmeno interpreta
     * @return Artist|NULL vrátí entitu interpreta nebo NULL pokud interpret nebyl nalezen
     */
    public function findByName($name)
    {
        return $this->artistRepository->findOneBy(array('name'=>$name));
    }

    /**
     * Najde a vrati vsechny interprety zacinajici na nejake pismeno
     * @param $i prvni pismeno nazvu interpreta
     * @return Artist[]|array interpretu
     */
    public function findByLetter($i){
        $query = $this->em->createQuery('SELECT u FROM App\Model\Artist u WHERE u.name LIKE :foo');
        $query->setParameter('foo', $i.'%');
        $songs = $query->getResult();
        return $songs;
    }

}