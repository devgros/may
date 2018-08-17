<?php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;


class EasyAdminSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array();
    }

    
}