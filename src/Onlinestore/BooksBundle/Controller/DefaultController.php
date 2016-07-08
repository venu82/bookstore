<?php

namespace Onlinestore\BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Onlinestore\BooksBundle\Entity\orders;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * creates and returns instance of Form
     */
    private function getForm(){
        $form = $this->createFormBuilder()
            ->add('email', 'email')
            ->add('book_id', 'hidden')
            ->getForm();
        return $form;
    }

    private function getDoctrineManager(){
        return $this->getDoctrine()->getManager();
    }

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrineManager();
        $repo = $em->getRepository('BooksBundle:Books');

        $books = $repo->findAll();
        $titles = array();
        $booksViewed = $request->getSession()->get('booksViewed',[]);
        foreach($books as $book){
            $titles['isViewed'] = !empty($booksViewed[$book->getId()]);
            $titles['text'] = $book->getTitle();
            $titles['link'] = $this->generateUrl('book_descriptionpage', array('id' => $book->getId()));
            $titlesList[] = $titles;
        }
        return $this->render('BooksBundle:Default:index.html.twig', array(
            'titleslist' => $titlesList
        ));
    }

    public function bookDescriptionAction(Request $request, $id){

        $em = $this->getDoctrineManager();
        $repo = $em->getRepository('BooksBundle:Books');
        $form = $this->getForm();
        $form->get('book_id')->setData($id);
        $book = $repo->find($id);

        $booksViewed = $request->getSession()->get('booksViewed',[]);

        $booksViewed[$id] = $id;
        $request->getSession()->set('booksViewed', $booksViewed);

        return $this->render('BooksBundle:Default:bookDescription.html.twig', array(
            'title' => $book->getTitle(),
            'description' => $book->getDescription(),
            'form' => $form->createView()
        ));
    }

    public function OrdersAction(Request $request){
        $form = $this->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submitData = $form->getData();
            $order = new orders();
            $order->setBookId($submitData['book_id']);
            $order->setEmail($submitData['email']);
            $order->setDateOfPurchase(new \DateTime('now'));
            $em = $this->getDoctrineManager();
            $repo = $em->getRepository('BooksBundle:Books');
            $itemPurchased = $repo->find($submitData['book_id']);
            $em->persist($order);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'You have successfully Purchased '.$itemPurchased->getTitle().' Document');
            return $this->redirectToRoute('event_homepage');
        }
        else{
            return $this->redirectToRoute('event_homepage');
        }
    }

    public function clearRecentViewsAction(Request $request){
        $request->getSession()->clear();
        return $this->redirectToRoute('event_homepage');
    }
}
