<?php

namespace Beepsend\Resource;

use Beepsend\Request;
use Beepsend\ResourceInterface;

class Hlr implements ResourceInterface {
    
    /**
     * Beepsend request handler
     * @var Beepsend\Request
     */
    private $request;
    
    /**
     * Action to call
     * @var array
     */
    private $actions = array(
        'hlr' => '/hlr/',
        'validate' => '/hlr/validate'
    );
    
    /**
     * Init customer resource
     * @param Beepsend\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * Run intermediate HLR call
     * @param int $msisdn Msisdn that we are looking HLR request
     * @param string $connection Connection id
     * @return array
     */
    public function intermediate($msisdn, $connection = 'me')
    {
        $response = $this->request->call($this->actions['hlr'] . $msisdn, 'GET', array('connection' => $connection));
        return $response->get();
    }
    
    /**
     * Run bulk HLR call, will receive result to your connection's specified DLR
     * @param array $msisdns Array of msisdns
     * @return array
     */
    public function bulk($msisdns)
    {
        $response = $this->request->call($this->actions['hlr'], 'POST', array('msisdn' => $msisdns));
        return $response->get();
    }
    
    /**
     * Validate HLR request
     * @param int $msisdn Msisdn that we are looking HLR request
     * @param string $connection Connection id
     * @return array
     */
    public function validate($msisdn, $connection = 'me')
    {
        $response = $this->request->call($this->actions['validate'], 'POST', array('msisdn' => $msisdn, 'connection' => $connection));
        return $response->get();
    }
    
}