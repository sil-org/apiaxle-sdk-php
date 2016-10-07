<?php
namespace Apiaxle\middleware;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use CalcApiSig\HmacSigner;

class AuthSubscriber implements SubscriberInterface
{
    public function getEvents()
    {
        return [
            // need to attach before request
            'before'   => ['addAuthParams', RequestEvents::PREPARE_REQUEST],
        ];
    }

    public function addAuthParams(BeforeEvent $event)
    {
        /*
         * Get key and secret from auth and then unset it
         */
        $auth = $event->getClient()->getDefaultOption('auth');
        if ($auth === null) {
            throw new \Exception('Http client is missing \'auth\' parameters', 1466965269);
        }
        $key = $auth[0];
        $secret = isset($auth[1]) ? $auth[1] : null;
        $event->getClient()->setDefaultOption('auth', null);

        /*
         * Make sure key/secret do not stay in auth headers
         */
        $currentHeaders = $event->getRequest()->getHeaders();
        unset($currentHeaders['Authorization']);
        $event->getRequest()->setHeaders($currentHeaders);

        /*
         * Add request params for key and secret if needed
         */
        $params = [
            'api_key' => $key,
        ];

        /*
         * Calculate signature if secret is present
         */
        if ($secret !== null) {
            $signature = HmacSigner::CalcApiSig($key, $secret);
            $params['api_sig'] = $signature;
        }

        $query = $event->getRequest()->getQuery();
        $query->overwriteWith($params);
        $event->getRequest()->setQuery($query);
    }
    
}
