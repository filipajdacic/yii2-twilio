<?php

namespace filipajdacic\yiitwilio;

use yii\base\Component; //include YII component class
use Twilio\Services\Twilio;

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
            $this->twilioClass = new Services_Twilio($this->account_sid, $this->auth_key);
      } catch (Exception $e) {
            throw $e;
      }

       
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
