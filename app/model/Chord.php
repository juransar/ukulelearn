<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 26.03.2017
 * Time: 19:29
 */

namespace App\Model;
use Doctrine\ORM\Mapping as ORM;
use \Kdyby\Doctrine\Entities\BaseEntity;

/**
 * Class Chord
 * @ORM\Entity
 */
class Chord extends BaseEntity
{
    /**
     * id akordu
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * nazev akordu
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * notace akordu
     * @ORM\Column(type="string")
     */
    protected $notation;

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
     * notation getter
     * @return mixed
     */
    public function getNotation()
    {
        return $this->notation;
    }

    /**
     * notation setter
     * @param mixed $notation
     */
    public function setNotation($notation)
    {
        $this->notation = $notation;
    }


}