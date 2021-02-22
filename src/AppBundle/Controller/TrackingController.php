<?php

namespace AppBundle\Controller;

use AppBundle\Form\TrackType;
use AppBundle\Service\AlipaczkaClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrackingController extends Controller
{
    private $aliPaczkaClient;

    public function __construct(AlipaczkaClient $aliPaczkaClient)
    {
        $this->aliPaczkaClient = $aliPaczkaClient;
    }

    /**
     * @Route("/", name="tracking")
     * @param Request $request
     * @return Response|null
     */
    public function trackingAction(Request $request)
    {
        $form = $this->createForm(TrackType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $list = $form->getData();
            $response = $this->aliPaczkaClient->getTrackDelivery($list['numberList']);
            return new JsonResponse($response);

        }
        return $this->render('tracking/tracking.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
