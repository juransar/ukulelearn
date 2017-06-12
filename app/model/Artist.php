<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 25.03.2017
 * Time: 20:32
 */

namespace App\Model;
use Doctrine\ORM\Mapping as ORM;
use \Kdyby\Doctrine\Entities\BaseEntity;
/**
 * Class Artist
 * @ORM\Entity
 */
class Artist extends BaseEntity
{
    /**
     * Id Interpreta
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * Jmeno interpreta
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     *seznam pisni interpreta
     * @ORM\OneToMany(targetEntity="Song", mappedBy="artist")
     * @var Song[]
     */
    protected $songs;

    /**
     * id getter
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * id setter
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * name getter
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * name setter
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * songs getter
     * @return Song[]
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * songs setter
     * @param Song $songs
     */
    public function setSongs($songs)
    {
        $this->songs = $songs;
    }


}