<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

class ApiGaming extends AbstractController
{
    public const STATUS_CODE = 200;

    public function list()
    {   
        $client = HttpClient::create();
        
        $url = 'https://free-to-play-games-database.p.rapidapi.com/api/games';
        
        $response = $client->request('GET', $url,[
            'query' => [           
                'platform' => 'all',
                'title'=>'all'
            ],
            'headers' => [
                'X-RapidAPI-Key' => $this->getParameter('app.rapidApiKey'),
                'X-RapidAPI-Host' => $this->getParameter('app.rapidApiHost')    
                ]
            
        ]);
        
        $statusCode = $response->getStatusCode();
        if ($statusCode === self::STATUS_CODE) {
            return $response->toArray();
        }
        return ['error'];
    }

    public function game($id)
    {   
        $client = HttpClient::create();
        
        $url = 'https://free-to-play-games-database.p.rapidapi.com/api/game';
        
        $response = $client->request('GET', $url,[
            'query' => [           
                'id' => $id
            ],
            'headers' => [
                'X-RapidAPI-Key' => $this->getParameter('app.rapidApiKey'),
                'X-RapidAPI-Host' => $this->getParameter('app.rapidApiHost')    
                ]
            
        ]);
        
        $statusCode = $response->getStatusCode();
        if ($statusCode === self::STATUS_CODE) {
            return $response->toArray();
        }
        return ['error'];
    }
}
