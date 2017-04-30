<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\Cart_Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Cart controller.
 *
 * @Route("cart")
 */
class CartController extends Controller
{
    /**
     * Lists all cart entities.
     *
     * @Route("/", name="cart_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carts = $em->getRepository('AppBundle:Cart')->findAll();

        return $this->render('cart/index.html.twig', array(
            'carts' => $carts,
        ));
    }

    /**
     * Creates a new cart entity.
     *
     * @Route("/new", name="cart_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $cart = $em->getRepository('AppBundle:Cart')->findOneBy(['status'=>'active']);
        if(!$cart){
            $cart = new Cart;
            $cart->setUserId($this->get('security.token_storage')->getToken()->getUser()->getId());
            $cart->setStatus('active');
            $cart->setCreatedAt(new \DateTime("now"));
            $em->persist($cart);
            $em->flush();
        }
        $newItem =  new Cart_Product;
        $newItem->setCartId($cart->getId());
        $newItem->setProductId($request->get('product_id'));
        $newItem->setQuantity($request->get('quantity'));
        $em->persist($newItem);
        $em->flush();

        $this->addFlash('success', 'Product added');
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Finds and displays a cart entity.
     *
     * @Route("/{id}", name="cart_show")
     * @Method("GET")
     */
    public function showAction(Cart $cart)
    {
        $deleteForm = $this->createDeleteForm($cart);

        return $this->render('cart/show.html.twig', array(
            'cart' => $cart,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cart entity.
     *
     * @Route("/{id}/edit", name="cart_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cart $cart)
    {
        $deleteForm = $this->createDeleteForm($cart);
        $editForm = $this->createForm('AppBundle\Form\CartType', $cart);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cart_edit', array('id' => $cart->getId()));
        }

        return $this->render('cart/edit.html.twig', array(
            'cart' => $cart,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cart entity.
     *
     * @Route("/{id}", name="cart_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cart $cart)
    {
        $form = $this->createDeleteForm($cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cart);
            $em->flush();
        }

        return $this->redirectToRoute('cart_index');
    }

    /**
     * Creates a form to delete a cart entity.
     *
     * @param Cart $cart The cart entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cart $cart)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cart_delete', array('id' => $cart->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
