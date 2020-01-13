<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use  Monolog\Formatter\FormatterInterface;

class Formatter implements FormatterInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function format(array $record) {
        $container = $record['context']['container'];
        $request= $container->get('request_stack')->getCurrentRequest();

        if(isset($record['context']['request_uri'])) {
            $line  = "";
        } else {
            $line = sprintf("[%s]_________________________	%s", date('Y-m-d H:i:s'), $record['message']).PHP_EOL;
            $line .=sprintf("			|____ Adresse IP		__________	%s", $request->getClientIp()).PHP_EOL.
                sprintf("			|____ Route				__________	%s", $request->get('_route')).PHP_EOL.
                sprintf("			|____ Paramètres		__________	%s", json_encode($request->get('_route_params'))).PHP_EOL.
                sprintf("			|____ URL				__________	%s", $request->getUri()).PHP_EOL;
        }
        if($request->getMethod()=='POST') {
            $change = $container->get('session')->get('changeSet');
            $line .= sprintf("			|____ Données postées	__________	%s", json_encode($request->request->all())).PHP_EOL;
            if(!empty($change) && $change!=null) {$line .= sprintf("			|____ Données changées	__________	%s", json_encode($change)).PHP_EOL;}
        }

        return $line.PHP_EOL.PHP_EOL;
    }


    /**
     * Formats a set of log records.
     *
     * @param  array $records A set of records to format
     * @return mixed The formatted set of records
     */
    public function formatBatch(array $records)
    {
        // TODO: Implement formatBatch() method.
    }
}
?>