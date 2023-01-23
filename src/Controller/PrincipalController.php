<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

use App\Juego2048\Tablero;


class PrincipalController extends AbstractController
{

    
    private $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    #[Route('/', name: 'app_principal')]
    public function index(): Response
    {
        
        $session = $this->requestStack->getSession();
        $tablero = $session->get('tablero');
        if(!$tablero) {
            $tablero = new Tablero();
            $session->set('tablero',$tablero);
        }
            
        
        return $this->render('principal/index.html.twig', [            
            'tablero' => $tablero,
        ]);
    }

    #[Route('/nuevo', name: 'app_nuevo')]
    public function nuevo(): Response
    {
        $tablero = new Tablero();  

        $session = $this->requestStack->getSession();
        $session->set('tablero',$tablero);
        
        return $this->render('principal/index.html.twig', [            
            'tablero' => $tablero,
        ]);
    }

    #[Route('/derecha', name: 'app_derecha')]
    public function mueveDerecha(): Response
    {   
        $tablero = $this->obtenerTablero();
        if(!$tablero) return $this->redirectToRoute('app_nuevo');
        if($tablero->vacias()>0 || !$tablero->noUnionesDerecha()) $tablero->mueveDerecha();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }

    #[Route('/izquierda', name: 'app_izquierda')]
    public function mueveIzquierda(): Response
    {       
        $tablero = $this->obtenerTablero();
        if(!$tablero) return $this->redirectToRoute('app_nuevo');
        if($tablero->vacias()>0 || !$tablero->noUnionesDerecha()) $tablero->mueveIzquierda();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }

    #[Route('/arriba', name: 'app_arriba')]
    public function mueveArriba(): Response
    {       
        $tablero = $this->obtenerTablero();
        if(!$tablero) return $this->redirectToRoute('app_nuevo');
        if($tablero->vacias()>0 || !$tablero->noUnionesAbajo()) $tablero->mueveArriba();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }

    #[Route('/abajo', name: 'app_abajo')]
    public function mueveAbajo(): Response
    {       
        $tablero = $this->obtenerTablero();
        if(!$tablero) return $this->redirectToRoute('app_nuevo');
        if($tablero->vacias()>0 || !$tablero->noUnionesAbajo()) $tablero->mueveAbajo();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }

    private function obtenerTablero(): Tablero
    {
        $session = $this->requestStack->getSession();
        $tablero = $session->get('tablero');
        return $tablero;
    }
}
