<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cars;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarController extends AbstractController
{
    
    private function form(Request $request, Cars $car, $action) {
        
        $form = $this->createFormBuilder( $car )
            ->setAction( $action )
            ->setMethod('POST')
            ->add('id', HiddenType::class )
            ->add('name', TextType::class )
            ->add('description', TextType::class )
            ->add('price', NumberType::class )
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();
        
        $form->handleRequest($request);
        return $form;
    }
    
    /**
     * @Route("/car/new", name="car_new")
     */
    public function new(Request $request)
    {
        $car = new Cars();        
        $form = $this->form( $request , $car , $this->generateUrl( 'car_new' )  );
        if( $form->isSubmitted() && $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();
            $car = $form->getData();

            $entityManager->persist($car);
            $entityManager->flush();
            $this->addFlash('success', 'The save process of the car to database was successful.');
            
            return $this->redirectToRoute('car_list');
        }        
        return $this->render('car/new.html.twig', [
             'form' => $form->createView(),
        ]);
    }
    
    
    /**
     * @Route("/car/edit/{car}", name="car_edit")
     */
    public function edit(Request $request,Cars $car) {
        $form = $this->form( $request , $car , $this->generateUrl( 'car_edit' , ['car' => $car->getId()] ) );        
        if( $form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();     
            return $this->redirectToRoute('car_list');
        }
        return $this->render('car/edit.html.twig', [
             'form' => $form->createView(),
        ]);        
    }

    /**
     * @Route("/car", name="car_list")
     */
    public function list(PaginatorInterface $paginator, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Cars::class); 
        return $this->render('car/list.html.twig', [ 
            'pagination' => $paginator->paginate(
             $repository->findAll(),$request->query->getInt('page', 1),10) 
        ]); 
    }
    
    
}
