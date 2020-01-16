<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\RequestService;
use App\Entity\RequestType;
use App\Form\RequestServiceType;
use App\Repository\RequestServiceRepository;
use App\Service\PriorityServiceFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/request/service")
 */
class RequestServiceController extends AbstractController
{
    /**
     * @Route("/", name="request_service_index", methods={"GET"})
     */
    public function index(RequestServiceRepository $requestServiceRepository): Response
    {
        return $this->render('request_service/index.html.twig', [
            'request_services' => $requestServiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="request_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $requestService = new RequestService();

        $clients = [];
        $clientsDoctrine = $this->getDoctrine()->getRepository(Client::class);
        $clientsAr = $clientsDoctrine->findAll();
        foreach($clientsAr as $client){
            $clients[$client->getName()] = $client->getId();
        }

        $types = [];
        $typesDoctrine = $this->getDoctrine()->getRepository(RequestType::class);
        $typesAr = $typesDoctrine->findAll();
        foreach($typesAr as $type){
            $types[$type->getName()] = $type->getId();
        }

        $form = $this->createFormBuilder($requestService)
            ->add('client_id', ChoiceType::class, array( 'choices'=>array($clients)))
            ->add('type_id', ChoiceType::class, array( 'choices'=>array($types), 'label' => 'Тип запроса'))
            ->add('body', TextareaType::class, ['label' => 'Текст запроса'])
            ->add('parent_id', NumberType::class, ['label' => 'Запрос, по которому прислано уочнение', 'required' => false])
            ->add('save', SubmitType::class, ['label' => 'отправить запрос'])->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // установка текущей даты
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $requestService->setDateCreate($dateTime);

            //Получение значения приоритета
            $priority = PriorityServiceFacade::getPriority($requestService);
            $requestService->setPriority($priority);
            echo '<pre>';
            print_r($requestService);
            echo '</pre>';


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($requestService);
            $entityManager->flush();

            return $this->redirectToRoute('request_service_index');
        }

        return $this->render('request_service/new.html.twig', [
            'request_service' => $requestService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="request_service_show", methods={"GET"})
     */
    public function show(RequestService $requestService): Response
    {
        return $this->render('request_service/show.html.twig', [
            'request_service' => $requestService,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="request_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RequestService $requestService): Response
    {
        $form = $this->createForm(RequestServiceType::class, $requestService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('request_service_index');
        }

        return $this->render('request_service/edit.html.twig', [
            'request_service' => $requestService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="request_service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RequestService $requestService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$requestService->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($requestService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('request_service_index');
    }
}
