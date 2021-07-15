<?php

namespace LukaPeharda\PayPal\Catalog;

class Product
{
    const TYPE_DIGITAL = 'DIGITAL';
    const TYPE_SERVICE = 'SERVICE';
    const TYPE_PHYSICAL = 'PHYSICAL';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $type = 'DIGITAL';

    /**
     * @var string
     */
    protected $category;

    /**
     * Init a product from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $product = new Product();

        if (isset($data['id'])) {
            $product->setId($data['id']);
        }

        if (isset($data['name'])) {
            $product->setName($data['name']);
        }

        if (isset($data['description'])) {
            $product->setDescription($data['description']);
        }

        if (isset($data['type'])) {
            $product->setType($data['type']);
        }

        if (isset($data['category'])) {
            $product->setCategory($data['category']);
        }

        return $product;
    }

    /**
     * Return product as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'type' => $this->getType(),
            'category' => $this->getCategory(),
        ];
    }

    /**
     * Return ID.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ID.
     *
     * @param   string  $id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Return name.
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param   string  $name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Return description.
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param   string  $description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Return type.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type.
     *
     * @param   string  $type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Return category.
     *
     * @return  string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category.
     *
     * @param   string  $category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
