<?php
declare(strict_types=1);

namespace App\Controller;


use Stripe\PaymentIntent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class CheckoutController extends AbstractController
{
    /**
     * @Route(path="/cart/pay", methods={"GET"}, name="app_checkout_pay")
     *
     * @param Request $request
     * @return Response
     */
    public function stepOneAction(Request $request, SessionInterface $session): Response
    {
        if (!$session->has('intent_client_secret')) {
            $intent = \Stripe\PaymentIntent::create([
                'amount' => 2000,
                'currency' => 'eur',
            ]);

            $session->set('intent_client_secret', $intent->client_secret);
        }

        $clientSecret = $session->get('intent_client_secret');

        return $this->render('checkout/pay.html.twig', [
            'client_secret' => $clientSecret
        ]);
    }

    /**
     * @Route(path="/cart/thank-you", methods={"GET"})
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function thankYouAction(Request $request, SessionInterface $session)
    {
        $session->remove('intent_client_secret');

        return $this->render('checkout/thank-you.html.twig');
    }
}