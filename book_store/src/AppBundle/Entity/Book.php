<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="books")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BooksRepository")
 */
class Book
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="books")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */

    private $customer;

    /**
     * @var date
     *
     * @ORM\Column(name="loan_date", type="date", nullable=true)
     */
    private $loan_date;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Books
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Books
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Books
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set customer
     *
     * @param integer $customer
     *
     * @return Books
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }


    /**
     * Get customer
     *
     * @return integer
     */
    public function getCustomer()
    {
        return $this->customer;
    }


    /**
     * Get loan_date
     *
     * @return date
     */
    public function getLoanDate()
    {
        return $this->loan_date;
    }

    /**
     * Set loan_date
     *
     * @param date $loan_date
     *
     * @return Books
     */
    public function setLaonDate($loan_date)
    {
        $this->loan_date = $loan_date;

        return $this;
    }
}

