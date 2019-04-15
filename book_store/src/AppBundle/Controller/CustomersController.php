<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Customer controller.
 *
 * @Route("/customer")
 */
class CustomersController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/", name="customer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('AppBundle:Customer')->findAll();

        return $this->render('customers/index.html.twig', array(
            'customers' => $customers,
        ));
    }

    /**
     * Creates a new customer entity.
     *
     * @Route("/new", name="customer_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm('AppBundle\Form\CustomersType', $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('customer_show', array('id' => $customer->getId()));
        }

        return $this->render('customers/new.html.twig', array(
            'customer' => $customer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a customer entity.
     *
     * @Route(
     *     "/{id}",
     *     name="customer_show",
     *     methods = {"GET"},
     *     requirements = {
     *          "id" = "\d+"
     *     }
     * )
     */
    public function showAction(Customer $customer)
    {
        /*dump($customer);die();*/
        //dump(count($customer->getBooks()));die();
        $deleteForm = $this->createDeleteForm($customer);

        return $this->render('customers/show.html.twig', array(
            'customer' => $customer,
            'delete_form' => $deleteForm->createView(),
        ));

    }

    /**
     * Displays a form to edit an existing customer entity.
     *
     * @Route("/{id}/edit", name="customer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Customer $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);
        $editForm = $this->createForm('AppBundle\Form\CustomersType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_edit', array('id' => $customer->getId()));
        }

        return $this->render('customers/edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a customer entity.
     *
     * @Route("/{id}/delete", name="customer_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, Customer $customer)
    {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();
        }

        return $this->redirectToRoute('customer_index');
    }

    /**
     * Creates a form to delete a customer entity.
     *
     * @param Customers $customer The customer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customer $customer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customer_delete', array('id' => $customer->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
