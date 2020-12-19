<?php

namespace LibraryBundle\Controller;
use LibraryBundle\Entity\Book;
use LibraryBundle\Entity\Mail;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Swift_SmtpTransport;
use Swift_Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class DefaultController extends Controller
{

    /**
     * Lists all book entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('LibraryBundle:Book')->findAll();

        return $this->render('@Library\Default\index.html.twig', array(
            'books' => $books,
        ));
    }


    public function whatHomeAction(SessionInterface $session)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if ($user === 'annon.') return $this->redirect('login');

        switch ($user->getRoles()[0]) {
            case "ROLE_ADMIN":
                return $this->redirect('adminhome');
                break;
            case "ROLE_CLIENT":
                return $this->redirect('home');
                break;
        }
    }

    public function adminHomeAction()
    {
        $ob = new Highchart();
        $em=$this->getDoctrine()->getManager();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Books Stat');

        $books=$em->getRepository(Book::class)->findAll();
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));



        $data = array();
        $stat=['Book Tittle','Book Qunatity'];
        foreach ($books as $book){
        $stat=array();
        array_push($stat,$book->getBooktitle(),$book->getBookquantity());
        $stat=[$book->getBooktitle(),$book->getBookquantity()];
        array_push($data,$stat);
        }
        $ob->getData()->setArrayToDataTable($data);
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('@Library/Admin/adminDashBoard.html.twig', array(
            'chart' => $ob));
    }

    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('LibraryBundle:Book')->findAll();
        return $this->render('@Library\Default\index.html.twig', array(
            'books' => $books,
        ));
    }

    public function booksAction()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('LibraryBundle:Book')->findAll();
        return $this->render('@Library\Default\index.html.twig', array(
            'books' => $books,
        ));
    }

    public function sendMailAction()
    {

// Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
            ->setUsername('oussema.saadouli@esprit.tn')
            ->setPassword('183JMT1990')
        ;

// Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message('Cour UML'))
            ->setFrom(['oussema.saadouli@esprit.tn' => 'Oussema Esprit'])
            ->setTo(['ahmed.zayani@esprit.tn'=> 'Ahmed'])
            ->setBody('bisous')
        ;

// Send the message
        if($mailer->send($message)){
            echo "Mail Sent...";
    }
        echo    "Failed ";
        return $this->redirectToRoute('library_adminhomepage');
    }

    /**
     * Creates a new Mail entity.
     *
     */
    public function newMailAction(Request $request)
    {
        $mail = new Mail();
        $form = $this->createForm('LibraryBundle\Form\MailType', $mail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mail);
            $em->flush();
// Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
                ->setUsername('')
                ->setPassword('')
            ;

// Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);

// Create a message
            $message = (new Swift_Message($mail->getSubjet()))
                ->setFrom(['oussema.saadouli@esprit.tn' => 'Oussema Esprit'])
                ->setTo([$mail->getToemail()=> 'Ahmed'])
                ->setBody($mail->getMessage())
            ;

// Send the message
            if($mailer->send($message)){
                echo "Mail Sent...";
            }
            echo    "Failed ";

            return $this->redirectToRoute('library_toemail');
        }

        return $this->render('@Library\Mail\newmail.html.twig', array(
            'mail' => $mail,
            'form' => $form->createView(),
        ));
    }
}
