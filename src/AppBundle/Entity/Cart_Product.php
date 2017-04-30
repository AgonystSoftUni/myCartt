<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart_Product
 *
 * @ORM\Table(name="cart__product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Cart_ProductRepository")
 */
class Cart_Product
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
     * @ORM\Column(name="cart_id", type="integer")
     */
    private $cartId;

    /**
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


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
     * Set cartId
     *
     * @param integer $cartId
     *
     * @return Cart_Product
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;

        return $this;
    }

    /**
     * Get cartId
     *
     * @return int
     */
    public function getCartId()
    {
        return $this->cartId;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     *
     * @return Cart_Product
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Cart_Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}

