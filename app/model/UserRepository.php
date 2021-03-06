<?php
/**
 * Created by PhpStorm.
 * User: ondrej.votava
 * Date: 16. 4. 2015
 * Time: 10:55
 */
namespace App\Model;
use App\Model;
use Nette;
use App\Model\CRUD;
use Kdyby;
use Kdyby\Doctrine\EntityManager;

/**
 * Class Users
 * @package App\Model\Repository
 * @author Ondra Votava <ja@ondravotava.cz>
 */
class UserRepository extends Nette\Object
{
    use CRUD;

    /**
     * Repozitar pro uzivatele
     * @var Kdyby\Doctrine\EntityRepository
     */
    private $repository;

    /**
     * UserRepository constructor.
     * @param Kdyby\Doctrine\EntityManager $entityManager
     */
    public function inject(EntityManager $entityManager)
    {
        $this->repository = $entityManager->getRepository(User::class);
    }
    /**
     * Najde a vrati uzivatele podle jeho uzivatelskeho jmena
     * @param $username uzivatelske jmeno
     * @return null|\App\Model\User
     */
    public function findByUsername($username)
    {
        return $this->em->getRepository(User::getClassName())->findOneBy(array('username' => $username));
    }
    /**
     * Najde a vrati uzivatele podle id
     * @param $id id uzivatele
     * @return mixed|null|object
     */
    public function findById($id)
    {
        return $this->em->getRepository(User::getClassName())->findOneBy(array('id' => $id));
    }
}