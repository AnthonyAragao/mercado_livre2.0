<?php

namespace App\Http\Controllers;

class StripeWebhookController extends Controller
{
    private $compraController;
    public function __construct(CompraController $compraController)
    {
        $this->compraController = $compraController;
    }

    public function handleWebhook()
    {
        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                if ($event->data->object->payment_status === 'paid') {
                    $this->compraController->processaCompra($event->data->object);
                }
                break;
            case 'checkout.session.async_payment_succeeded':
                $this->compraController->processaCompra($event->data->object);
                break;
            default:
                return response()->json(['error' => 'Invalid webhook event type.'], 400);
        }
    }


}
