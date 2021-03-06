<?php

require_once '../bootstrap.php';

use Tester\Assert;
use Tester\Environment;
use App\Model\UserRepository;
use Tester\TestCase;
use Kdyby\Doctrine\EntityManager;
use App\Model\User;
/**
 * Class ArtistRepositoryTest
 */
class UserRepositoryTest extends TestCase
{
    public $userRepository;
    /** @var Nette\DI\Container */
    private $container;


    public function __construct(Nette\DI\Container $container)
    {
        $this->container = $container;
        Tester\Environment::setup();

    }

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $entityManager = $this->container->getByType(EntityManager::class);
        Tester\Environment::lock('database', __DIR__ . '/tmp');
        $this->userRepository=$this->container->getByType(UserRepository::class);//new ChordRepository($entityManager);

    }

    public function testSaveUser() {
        $user=new User('TestUser','passwd',"admin");
        $this->userRepository->save($user);
        $res=$this->userRepository->findByUsername('TestUser');
        Assert::notEqual(null,$res);
        $this->userRepository->delete($res);

    }
    public function testUpdateUser() {
        $user=new User('TestUser','passwd',"admin");
        $this->userRepository->save($user);
        $res=$this->userRepository->findByUsername('TestUser');
        $user->setUsername("TestUser2");
        $this->userRepository->update($user);
        $res=$this->userRepository->findByUsername('TestUser2');
        Assert::notEqual(null,$res);
        $res2=$this->userRepository->findByUsername('TestUser');
        Assert::null($res2);
        $this->userRepository->delete($res);

    }
    public function testDeleteUser() {
        $user=new User('TestUser','passwd',"admin");
        $this->userRepository->save($user);
        $res=$this->userRepository->findByUsername('TestUser');
        Assert::notEqual(null,$res);
        $this->userRepository->delete($res);
        $res=$this->userRepository->findByUsername('TestUser');
        Assert::null($res);
    }
    public function testFindByUsername() {
        $user=new User('TestUser','passwd',"admin");
        $this->userRepository->save($user);
        $res=$this->userRepository->findByUsername('TestUser');
        Assert::notEqual(null,$res);
        $this->userRepository->delete($res);

    }
}

# Spuštění testovacích metod
$testCase = new UserRepositoryTest($container);
$testCase->run();