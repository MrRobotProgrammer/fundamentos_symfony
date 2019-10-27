<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", Length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", Length=500)
     */
    private $description;

    /**
     * Pegar valor do ID
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Pegar o valor do nome
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setar o valor do nome
     *
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Retornar o valor da descrição
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Setar o valor da descrição
     *
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

}
