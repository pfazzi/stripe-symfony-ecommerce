<?php
declare(strict_types=1);

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController
{
    /**
     * @Route(path="/cart/step-one", methods={"GET"})
     * @param Request $request
     */
    public function stepOneAction(Request $request): void
    {
        $intent = \Stripe\PaymentIntent::create([
            'amount' => 2000,
            'currency' => 'eur',
        ]);
    }
}