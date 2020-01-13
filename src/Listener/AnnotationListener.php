<?php
namespace App\Listener;

use Monolog\Logger;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;



class AnnotationListener
{
    /**
     *
     * @var AnnotationReader
     */
    protected $reader;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     * @param AnnotationReader $reader
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->reader = new AnnotationReader();
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();
        /*
         * $controller passed can be either a class or a Closure.
        * This is not usual in Symfony2 but it may happen.
        * If it is a class, it comes in array format
        *
        */
        if (!is_array($controller)) {
            return;
        }

        list($controllerObject, $methodName) = $controller;

        $monologAnnotation = 'App\Annotation\QMLogger';
        $message = '';

        // Get class annotation
        // Using ClassUtils::getClass in case the controller is an proxy
        $classAnnotation = $this->reader->getClassAnnotation(
            new \ReflectionClass(ClassUtils::getClass($controllerObject)), $monologAnnotation
        );
        if($classAnnotation)
           { $message .=  $classAnnotation->message;}

        // Get method annotation
        $controllerReflectionObject = new \ReflectionObject($controllerObject);
        $reflectionMethod = $controllerReflectionObject->getMethod($methodName);
        $methodAnnotation = $this->reader->getMethodAnnotation($reflectionMethod,$monologAnnotation);
        if($methodAnnotation)
            {$message .=  $methodAnnotation->message;}

        // Override the response only if the annotation is used for method or class
        if($classAnnotation || $methodAnnotation)
            {
            $this->container->get('monolog.logger.trace')->log(Logger::INFO, $message, array('container' => $this->container));
            }
    }
}
?>