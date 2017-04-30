<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromotionRepository")
 */
class Promotion
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
     * @ORM\Column(name="promotionable_id", type="integer")
     */
    private $promotionableId;

    /**
     * @var string
     *
     * @ORM\Column(name="promotionable_type", type="string", length=255)
     */
    private $promotionableType;

    /**
     * @var int
     *
     * @ORM\Column(name="discount", type="integer")
     */
    private $discount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetimetz")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetimetz")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="category")
     * @ORM\JoinColumn(name="promotionable_id", referencedColumnName="id")
    */
    private $category;

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
     * Set promotionableId
     *
     * @param integer $promotionableId
     *
     * @return Promotion
     */
    public function setPromotionableId($promotionableId)
    {
        $this->promotionableId = $promotionableId;

        return $this;
    }

    /**
     * Get promotionableId
     *
     * @return int
     */
    public function getPromotionableId()
    {
        return $this->promotionableId;
    }

    /**
     * Set promotionableType
     *
     * @param string $promotionableType
     *
     * @return Promotion
     */
    public function setPromotionableType($promotionableType)
    {
        $this->promotionableType = $promotionableType;

        return $this;
    }

    /**
     * Get promotionableType
     *
     * @return string
     */
    public function getPromotionableType()
    {
        return $this->promotionableType;
    }

    /**
     * Set discount
     *
     * @param integer $discount
     *
     * @return Promotion
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Promotion
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Promotion
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getCategory(){
        return $this->category;
    }
}

