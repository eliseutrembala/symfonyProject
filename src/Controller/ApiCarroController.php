<?php
namespace App\Controller;

use App\Entity\Carro;
use App\Repository\CarroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/carros', name: 'api_carros_')]
class ApiCarroController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('', methods: ['GET'])]
    public function index(CarroRepository $repository): JsonResponse
    {
        $carros = $repository->findAll();

        $data = array_map(fn (Carro $carro) => [
            'id' => $carro->getId(),
            'marca' => $carro->getMarca(),
            'modelo' => $carro->getModelo(),
            'ano' => $carro->getAno(),
            'cor' => $carro->getCor(),
        ], $carros);

        return new JsonResponse($data);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(Carro $carro): JsonResponse
    {
        $data = [
            'id' => $carro->getId(),
            'marca' => $carro->getMarca(),
            'modelo' => $carro->getModelo(),
            'ano' => $carro->getAno(),
            'cor' => $carro->getCor(),
        ];

        return new JsonResponse($data);
    }

    #[Route('', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $carro = new Carro();
        $carro->setMarca($data['marca']);
        $carro->setModelo($data['modelo']);
        $carro->setAno($data['ano']);
        $carro->setCor($data['cor']);

        $this->em->persist($carro);
        $this->em->flush();

        return new JsonResponse(['message' => 'Carro criado com sucesso'], 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, Carro $carro): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $carro->setMarca($data['marca']);
        $carro->setModelo($data['modelo']);
        $carro->setAno($data['ano']);
        $carro->setCor($data['cor']);

        $this->em->flush();

        return new JsonResponse(['message' => 'Carro atualizado com sucesso']);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Carro $carro): JsonResponse
    {
        $this->em->remove($carro);
        $this->em->flush();

        return new JsonResponse(['message' => 'Carro removido com sucesso']);
    }
}

