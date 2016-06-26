<?php

namespace filipajdacic\yiitwilio;

use yii\base\Component; //include YII component class
use Twilio\Services\Twilio;

class YiiTwilio extends Component
{



    /**
     * The internal Adldap object.
     *
     * @var object Adldap
     */
    private $twilioClass;


    /**
     * Options variable for the Twilio module.
     * See Twilio __construct function for possible values.
     *
     * @var array Array with option values
     */
    public $options = [];



    /**
     * init() called by yii.
     */


    public function init()
    {
       
        try {
            $this->twilioClass = new Services_Twilio($this->options);
        } catch (Exception $e) {
            throw $e;
        }

       
    }



}
