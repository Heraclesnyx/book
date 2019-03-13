<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loans
 *
 * @ORM\Table(name="loans")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LoansRepository")
 */
class Loans
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
     * @ORM\Column(name="id_book", type="integer")
     */
    private $idBook;

    /**
     * @var int
     *
     * @ORM\Column(name="id_customer", type="integer")
     */
    private $idCustomer;


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
     * Set idBook
     *
     * @param integer $idBook
     *
     * @return Loans
     */
    public function setIdBook($idBook)
    {
        $this->idBook = $idBook;

        return $this;
    }

    /**
     * Get idBook
     *
     * @return int
     */
    public function getIdBook()
    {
        return $this->idBook;
    }

    /**
     * Set idCustomer
     *
     * @param integer $idCustomer
     *
     * @return Loans
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;

        return $this;
    }

    /**
     * Get idCustomer
     *
     * @return int
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }
}

