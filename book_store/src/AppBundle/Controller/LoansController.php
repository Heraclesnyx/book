<?php 

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Entity\Customer;
use AppBundle\Form\LoanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityManagerInterface;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Class LoansController
 * @package AppBundle\Controller
 *
 * @Route("/customer/loans")
 */
class LoansController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/", name="list_loans", methods={"GET"})
     */
    public function showAction(Request $request)
    {
        #   Your own logic
         $loansBook = $this->getDoctrine()
            ->getRepository(Book::class)
            ->getAllLoans();

        return $this->render('loans/index.html.twig', array(
            'loans' => $loansBook,
        ));


    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     *
     * @Route(
     *     "/{id}",
     *     name = "show_customer_loans",
     *     methods = {"GET", "POST"},
     *     requirements = {
     *          "id" = "\d+"
     *     }
     * )
     */
    public function showCustomerAction(Request $request, int $id)
    {
        $customerLoan = $this->getDoctrine()->getRepository(Customer::class)->getLoanRecords($id);


        if (!$customerLoan)
            throw new NotFoundHttpException();

        $form = $this->createForm(LoanType::class, $customerLoan);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if (!$request->request->get('loan')['available_books'])
                die();

            #   On charge le proxy pour limiter le nombre de requête
            /**
             * @var Book $book
             */
            $book = $em->getReference(Book::class, $request->request->get('loan')['available_books']);


            $book
                ->setCustomer($customerLoan)
                ->setLaonDate(new \DateTime('now'));

            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('list_loans');
        }
        return $this->render('loans/loan.html.twig', [
            'customer' => $customerLoan,
            'form' => $form->createView()
        ]);


    }

    /**
     * Deletes a loan.
     *
     *@Route("/{id}/delete", name="loan_delete")
     *@Method("POST")
     */
    public function BringBackAction(Request $request, int $id)
    {
        /*dump($book);die();*/


        $customerLoan= $this->getDoctrine()->getRepository(Book::class)->getOneBookById($id);

        /*$entityManager = $this->getDoctrine()->getManager();*/
        /*dump($customerLoan);*/
        $customerLoan->setCustomer(null);
        $customerLoan->setLaonDate(null);

        $em = $this->getDoctrine()->getManager();
        $em->persist($customerLoan);

        $em->flush();

        return $this->redirectToRoute("show_customer_loans");


    }


}