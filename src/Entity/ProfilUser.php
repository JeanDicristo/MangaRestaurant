<?php

namespace App\Entity;

use App\Repository\ProfilUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfilUserRepository::class)]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
#[UniqueEntity('email')]
class ProfilUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Length(min: 0, max: 255)]
    #[Assert\Email()]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private array $roles = [];

    /**
     * @var string The hashed password
     */

     private  $plainPassword = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?string $password = 'password';

    #[ORM\Column]
    #[Assert\Positive()]
    private ?float $numberGuest = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Allergy::class)]
    private Collection $allergy;

    #[ORM\ManyToMany(targetEntity: Reservation::class)]
    private Collection $reservation;

    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->allergy = new ArrayCollection();
        $this->reservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNumberGuest(): ?float
    {
        return $this->numberGuest;
    }

    public function setNumberGuest(float $numberGuest): self
    {
        $this->numberGuest = $numberGuest;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

     /**
      * Get the value of plainPassword
      */ 
     public function getPlainPassword()
     {
          return $this->plainPassword;
     }

     /**
      * Set the value of plainPassword
      *
      * @return  self
      */ 
     public function setPlainPassword($plainPassword)
     {
          $this->plainPassword = $plainPassword;

          return $this;
     }

     /**
      * @return Collection<int, Allergy>
      */
     public function getAllergy(): Collection
     {
         return $this->allergy;
     }

     public function addAllergy(Allergy $allergy): self
     {
         if (!$this->allergy->contains($allergy)) {
             $this->allergy->add($allergy);
         }

         return $this;
     }

     public function removeAllergy(Allergy $allergy): self
     {
         $this->allergy->removeElement($allergy);

         return $this;
     }

     /**
      * @return Collection<int, Reservation>
      */
     public function getReservation(): Collection
     {
         return $this->reservation;
     }

     public function addReservation(Reservation $reservation): self
     {
         if (!$this->reservation->contains($reservation)) {
             $this->reservation->add($reservation);
         }

         return $this;
     }

     public function removeReservation(Reservation $reservation): self
     {
         $this->reservation->removeElement($reservation);

         return $this;
     }
}
