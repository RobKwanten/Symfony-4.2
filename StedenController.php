<?php


namespace App\Controller;


use PDO;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class StedenController extends AbstractController
{
    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=testermode', 'root', 'root');
        $this->steden = $this->getSteden();
    }

    /**
     * @Route("/api/steden", methods={"GET"})
     * @return JsonResponse
     */

    public function getSteden(){
        $query = 'SELECT * FROM city INNER JOIN images on cit_img_id = img_id ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return new JsonResponse($rows);
    }

    /**
     * @Route("/steden", name="steden_show")
     */

    public function stedenpage()
    {
        return $this->render('steden/steden.html.twig', [
            'steden' => $this->steden
        ]);
    }

    /**
     * @Route("/steden/{stad}", name="stad_show")
     */

    public function stadpage($stad)
    {
        return $this->render('steden/stad.html.twig', [
            'stad' => $stad
        ]);
    }

}