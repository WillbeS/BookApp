<?php


namespace App\Data;


use App\Exception\FormValidationException;
use App\Traits\FormValidationTrait;

class BookDTO
{
    use FormValidationTrait;

    const MIN_TEXT_LENGTH = 3;

    const MAX_TEXT_LENGTH = 100;

    const MIN_IMAGE_URL = 5;

    const MAX_IMAGE_URL = 100;

    const MIN_ISBN_LENGTH = 10;

    const MAX_ISBN_LENGTH = 20;


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
     * @throws FormValidationException
     */
    public function setName(string $name): BookDTO
    {
        $this->validateLength($name, 'Book name', self::MIN_TEXT_LENGTH, self::MAX_TEXT_LENGTH);

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
     * @throws FormValidationException
     */
    public function setIsbn(string $isbn): BookDTO
    {
        $this->validateMinLength($isbn, 'ISBN', self::MIN_ISBN_LENGTH);
        $this->validateMaxLength($isbn, 'ISBN', self::MAX_ISBN_LENGTH);
        $this->validateWithRegex($isbn, 'ISBN',  '/^[\d-]*$/', 'ISBN can contain only digits and dashes.');
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
     * @throws FormValidationException
     */
    public function setDescription(string $description): BookDTO
    {
        $this->validateMinLength($description, 'Description', self::MIN_TEXT_LENGTH);
        $this->validateMaxLength($description, 'Description', self::MAX_TEXT_LENGTH);
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
     * @throws FormValidationException
     */
    public function setImage(string $image): BookDTO
    {
        $this->validateMinLength($image, 'Image url', self::MIN_IMAGE_URL);
        $this->validateMaxLength($image, 'Image url', self::MAX_IMAGE_URL);
        $this->image = $image;

        return $this;
    }
}