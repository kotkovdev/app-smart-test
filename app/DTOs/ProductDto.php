<?php
declare(strict_types=1);

namespace App\DTOs;

class ProductDto
{
    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var string|null
     */
    public ?string $image;

    /**
     * @var string|null
     */
    public ?string $category;

    /**
     * ProductDto constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setName($data['product_name'])
            ->setCategory($data['categories']);

        if (isset($data['image_url'])) {
            $this->setImage($data['image_url']);
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return \App\DTOs\ProductDto
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     *
     * @return \App\DTOs\ProductDto
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     *
     * @return \App\DTOs\ProductDto
     */
    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
