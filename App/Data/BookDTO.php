<?php


namespace App\Data;


class BookDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $isbn;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BookDTO
     */
    public function setName(string $name): BookDTO
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @return BookDTO
     */
    public function setIsbn(string $isbn): BookDTO
    {
        $this->isbn = $isbn;

        return $this;
    }



    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return BookDTO
     */
    public function setDescription(string $description): BookDTO
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return BookDTO
     */
    public function setImage(string $image): BookDTO
    {
        $this->image = $image;

        return $this;
    }
}