<?php
namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
/**
* @ORM\Entity(repositoryClass=BookRepository::class)
*/
class Books
{
/**
* @ORM\Id
* @ORM\GeneratedValue
* @ORM\Column(type="integer")
*/
private $id;

/**
* @ORM\Column(type="string", length=255)
*/
private $title;

/**
* @ORM\Column(type="string", length=255)
*/
private $author;

/**
* @ORM\Column(type="text")
*/
private $description;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Upload your image")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
private $img;

/**
* @ORM\Column(type="integer")
*/
private $year;


public function getId(): ?int
{
return $this->id;
}

public function getTitle(): ?string
{
return $this->title;
}

public function setTitle(string $title): self
{
$this->title = $title;

return $this;
}

public function getAuthor(): ?string
{
return $this->author;
}
public function setAuthor(string $author): self
{
$this->author = $author;

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

public function getImg(): ?string
{
return $this->img;
}
public function setImg(string $img): self
{
$this->img = $img;

return $this;
}

public function getYear(): ?int
{
return $this->year;
}
public function setYear(string $year): self
{
$this->year = $year;

return $this;
}



}
