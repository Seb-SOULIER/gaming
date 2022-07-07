<?php

namespace App\Controller;

use App\Service\ApiGaming;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(ApiGaming $apiGaming,
                          PaginatorInterface $paginator,
                          Request $request
                          ): Response
    {
        $list = $apiGaming->list('all','all');
        if($list[0]=== 'error'){
            $list = [];
        }

        $pagination = $paginator->paginate(
            $list,
            $request->query->getInt('page', 1), 
            30
        );
        
        return $this->render('home/index.html.twig', [
            'list' => $pagination,
        ]);
    }

       /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id,
                        ApiGaming $apiGaming,
                        Request $request
                        ): Response
    {
        $game = $apiGaming->game($id);
        
        return $this->render('home/show.html.twig', [
            'list' => $game,
        ]);
    }
}
