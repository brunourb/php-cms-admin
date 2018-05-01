<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TagValues
 *
 * @ORM\Table(name="tag_values", indexes={@ORM\Index(name="tag_values_tag", columns={"tag_id"})})
 * @ORM\Entity
 */
class TagValues
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $value;

    /**
     * @var \App\Entity\Tag
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tag_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $tag;


    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set value
     *
     * @param string $value
     *
     * @return TagValues
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set tag
     *
     * @param \App\Entity\Tag $tag
     *
     * @return TagValues
     */
    public function setTag(\App\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \App\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}

