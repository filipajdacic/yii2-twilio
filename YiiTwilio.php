<?php

namespace filipajdacic\yiitwilio;

use yii\base\Component;
use \Twilio\Rest\Client;

/**
 * YiiTwilio class
 * @author Filip Ajdacic <ajdasoft@gmail.com>
 * @license MIT
 * @version 1.0
 * @copyright (C) 2016 Filip Ajdacic <ajdasoft@gmail.com>
 * @see http://github.com/filipajdacic
 * */

class YiiTwilio extends Component
{

    /**
     * The internal Twilio object.
     *
     * @var object Twilio
     */
    private $twilioClass;


    /**
     ** @var string $account_sid -> Twilio Account ID
     */
    public $account_sid;


    /**
     ** @var string $auth_key -> Twilio Authorization Key
     */

    public $auth_key;

    /**
     * init() called by yii.
     */

    public function init()
    {   
          try {
                $this->twilioClass = new \Twilio\Rest\Client($this->account_sid, $this->auth_key);
          } catch (Exception $e) {
                throw $e;
          }  
    }

    public function initTwilio() {
        return $this->twilioClass;
    }

    /**
     * Use magic PHP function __call to route function calls to the Twilio class.
     * Look into the Twilio class for possible functions.
     *
     * @param string $methodName Method name from Twilio class
     * @param array $methodParams Parameters pass to method
     * @return mixed
     */

    public function __call($methodName, $methodParams)
    {
        if (method_exists($this->twilioClass, $methodName)) {
            return call_user_func_array(array($this->twilioClass, $methodName), $methodParams);
        } else {
            return parent::__call($methodName, $methodParams);
        }
    }

}
