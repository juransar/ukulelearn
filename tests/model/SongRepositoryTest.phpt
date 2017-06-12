<?php

require_once '../bootstrap.php';

use Tester\Assert;
use Tester\Environment;
use App\Model\ArtistRepository;
use App\Model\SongRepository;
use Tester\TestCase;
use Kdyby\Doctrine\EntityManager;
use App\Model\Artist;
use App\Model\Song;

/**
 * Class SongRepositoryTest
 */
class SongRepositoryTest extends TestCase
{
    public $songRepository;
    /** @var Nette\DI\Container */
    private $container;
    private $artist;
    public $artistRepository;

    public function __construct(Nette\DI\Container $container)
    {
        $this->container = $container;
        Tester\Environment::setup();

    }

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->songRepository = $this->container->getByType(SongRepository::class);//new ChordRepository($entityManager);
        $this->artistRepository = $this->container->getByType(ArtistRepository::class);//new ChordRepository($entityManager);
Tester\Environment::lock('database', __DIR__ . '/tmp');

        $this->artist = new Artist();
        $this->artist->setName('TestSongArtist');
        $this->artistRepository->save($this->artist);
        $res = $this->artistRepository->findByName('TestSongArtist');
        $this->artist = $res;
    }

    public function tearDown()
    {
        $this->artistRepository->delete($this->artist);

    }

    public function testSaveSong()
    {
        $song = new Song();
        $song->setTitle("TestSong");
        $song->setEntireText("[TestChord]TestText");
        $song->setArtist($this->artist);
        $this->songRepository->save($song);
        $res = $this->songRepository->findByArtist($this->artist->getId());
        Assert::notEqual(null, $res);
        Assert::same($this->artist->getId(),$res[0]->getArtist()->getId());
        $this->songRepository->delete($res);
    }

    public function testUpdateSong()
    {
        $song = new Song();
        $song->setTitle("TestSong");
        $song->setEntireText("[TestChord]TestText");
        $song->setArtist($this->artist);
        $this->songRepository->save($song);
        $res = $this->songRepository->findByArtist($this->artist->getId());
        $song->setTitle("TestSong2");
        $this->songRepository->update($song);
        $res = $this->songRepository->findByArtist($this->artist->getId());
        Assert::same($res[0]->getTitle(), "TestSong2");
        $this->songRepository->delete($res);
    }

    public function testDeleteSong()
    {
        $song = new Song();
        $song->setTitle("TestSong");
        $song->setEntireText("[TestChord]TestText");
        $song->setArtist($this->artist);
        $this->songRepository->save($song);
        $res = $this->songRepository->findByArtist($this->artist->getId());
        $this->songRepository->delete($res);
        $res = $this->songRepository->findByArtist($this->artist->getId());
        Assert::equal(count($res),0);
    }

    public function testFindByLetter() {
        $song = new Song();
        $song->setTitle("TestSong");
        $song->setEntireText("[TestChord]TestText");
        $song->setArtist($this->artist);
        $this->songRepository->save($song);
        $song2 = new Song();
        $song2->setTitle("TestSong2");
        $song2->setEntireText("[TestChord]TestText");
        $song2->setArtist($this->artist);
        $this->songRepository->save($song2);
        $res=$this->songRepository->findByLetter('T');
        Assert::notEqual(0, count($res));
        Assert::notEqual(1, count($res));
        $this->songRepository->delete($res);
    }
}

# Spuštění testovacích metod
$testCase = new SongRepositoryTest($container);
$testCase->run();