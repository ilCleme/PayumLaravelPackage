<?php
namespace Payum\LaravelPackage\Controller;

use Payum\Core\Reply\ReplyInterface;
use Payum\Core\Request\Notify;
use Symfony\Component\HttpFoundation\Request;

class NotifyController extends PayumController
{
    public function doUnsafeAction($gateway_name)
    {
        $gateway = $this->getPayum()->getGateway($gateway_name);

        $gateway->execute(new Notify(null));

        return \Response::make(null, 204);
    }

    public function doAction($payumToken)
    {
        /** @var Request $request */
        $request = app('request');
        $request->attributes->set('payum_token', $payumToken);

        $token = $this->getPayum()->getHttpRequestVerifier()->verify($request);

        $gateway = $this->getPayum()->getGateway($token->getGatewayName());

        try {
            $gateway->execute(new Notify($token));
        } catch (ReplyInterface $reply) {
           return $this->convertReply($reply);
        }

        return \Response::make(null, 204);
    }
}
