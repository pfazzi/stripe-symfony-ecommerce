<?php
declare(strict_types=1);

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    /**
     * @Route(path="/cart/step-one", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function stepOneAction(Request $request): Response
    {
        $intent = \Stripe\PaymentIntent::create([
            'amount' => 2000,
            'currency' => 'eur',
        ]);

        return $this->render('checkout/step-one.html.twig');
    }
}