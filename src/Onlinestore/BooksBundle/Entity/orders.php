<?php

namespace Onlinestore\BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Onlinestore\BooksBundle\Repository\ordersRepository")
 */
class orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="book_id", type="integer")
     */
    private $bookId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_purchase", type="datetime")
     */
    private $dateOfPurchase;


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
     * Set bookId
     *
     * @param integer $bookId
     * @return orders
     */
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;

        return $this;
    }

    /**
     * Get bookId
     *
     * @return integer 
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return orders
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateOfPurchase
     *
     * @param \DateTime $dateOfPurchase
     * @return orders
     */
    public function setDateOfPurchase($dateOfPurchase)
    {
        $this->dateOfPurchase = $dateOfPurchase;

        return $this;
    }

    /**
     * Get dateOfPurchase
     *
     * @return \DateTime 
     */
    public function getDateOfPurchase()
    {
        return $this->dateOfPurchase;
    }
}
