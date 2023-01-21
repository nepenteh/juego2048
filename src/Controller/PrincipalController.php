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

    #[Route('/d', name: 'app_derecha')]
    public function mueveDerecha(): Response
    {       
        $session = $this->requestStack->getSession();
        $tablero = $session->get('tablero');
        $tablero->mueveDerecha();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }

    #[Route('/i', name: 'app_izquierda')]
    public function mueveIzquierda(): Response
    {       
        $session = $this->requestStack->getSession();
        $tablero = $session->get('tablero');
        $tablero->mueveIzquierda();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }

    #[Route('/a', name: 'app_arriba')]
    public function mueveArriba(): Response
    {       
        $session = $this->requestStack->getSession();
        $tablero = $session->get('tablero');
        $tablero->mueveArriba();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }

    #[Route('/b', name: 'app_abajo')]
    public function mueveAbajo(): Response
    {       
        $session = $this->requestStack->getSession();
        $tablero = $session->get('tablero');
        $tablero->mueveAbajo();
        return $this->render('principal/index.html.twig', [
            'tablero' => $tablero,
        ]);
    }
}
