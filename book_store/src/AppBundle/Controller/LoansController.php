<?php 

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Class LoansController.
 *
 * @Route("/customer/loans")
 */
class LoansController extends Controller
{
	/**
     * @param Request $request.
     *
     * @Route("/", name="list_loans")
     * @Method("GET")
     */

	public function showAction(Customer $customer)
	{
		$em = $this->getDoctrine()->getManager();


		// $repository = $em->getRepository('AppBundle:Book');

		//$em->getRepository('AppBundle:Book')->getLoanedBooks();

        // $loans = $em->getRepository('AppBundle:Book')->findBy(array("customer" => true));

        // return $this->render('loans/index.html.twig', array(
        //     'loans' => $loans,
        // ));
        dump(count($customer->getBooks()));die();
	}


	/**
     * @param Request $request.
     * @param int $id 
     *
     * @Route("/{id}", name="show_customer_loans",methods ={"GET","POST"}, requirements ={ "id" = "\d+"})
     *
     */

	public function showCustomer(Request $request, int $id)
	{

	}

}