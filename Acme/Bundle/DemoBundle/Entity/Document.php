<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ORM Entity Document.
 *
 * @ORM\Entity()
 * @ORM\Table(name="custom_table_for_test")
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=250,
     *     nullable=false
     * )
     */
    private $name;

    /**
     * @ORM\Column(
     *      name="type",
     *      type="string", 
     *      length=255,
     *      nullable=false
     * )
     */
    private $type;
    const TYPES = ['web', 'local', 'dual'];


    /**
     * @ORM\Column(
     *      name="description",
     *      type="string", 
     *      length=200,
     *      nullable=true
     * )
     */
    private $description;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        if (!in_array($type, self::TYPES)) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
