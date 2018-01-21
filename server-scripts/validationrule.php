
<?php

/*Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017*/
/**
 * Defines a validation rule for each field in the form.
 */
class ValidationRule
{

    private $_fieldname;
    private $_message;

    /**
     * One of a predefined set of types of rule
     *
     * @var string
     */
    private $_ruletype;

    /**
     * Optional additional criteria to evaluate the rule (e.g. a min length)
     *
     * @var mixed
     */
    private $_criteria = null;
    
    public function __construct($fieldname, $message, $ruletype, $criteria = null)
    {
        $this->_fieldname = $fieldname;
        $this->_message = $message;
        $this->_ruletype = $ruletype;
        $this->_criteria = $criteria;
    }
    
    /**
     * To get private properties, prepends an underscore
     * 
     * @param   string $property The requested property
     * @return  mixed
     */
    public function __get($property)
    {
        $name = '_' . $property;
        if (isset ($this->$name)) {
            return $this->$name;
        }
        return false;
    }
}