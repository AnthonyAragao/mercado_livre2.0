<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Exemplar;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    private $compraController;
    public function __construct()
    {
        $this->compraController = new CompraController();
    }

    public function handleWebhook(Request $request)
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
                $session = $event->data->object;
                $this->compraController->processaCompra($session);

                Log::info('Processou a compra');
                break;
            case 'checkout.session.async_payment_succeeded':
                $session = $event->data->object;
                $this->compraController->atualizarCompra($session);

                Log::info('Processou a compra');
                break;

            case 'payment_intent.succeeded':
                return route('success');

                $paymentIntent = $event->data->object;
                // $this->handleSuccessfulPaymentIntent($paymentIntent);
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object;
                // $this->handlePaymentMethodAttached($paymentMethod);
                break;
            default:
                http_response_code(400);
                exit();
        }
    }


}
