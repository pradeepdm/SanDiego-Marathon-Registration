
<?php

/*Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017*/

/**
 * Validate form entries according to specified rules
 * Trying to implement a object oriented approach for validation.
 * references: w3 schools and PHP documentation
 * http://php.net/manual/en/language.oop5.php
 */
class FormValidator 
{    
    /**
     * An array of rule objects
     *
     * @var array
     */
    private $_rules = array();
    
    /**
     * An array of fields to be checked in the form: fieldname => value
     * 
     * @var array 
     */
    private $_fields = array();
    
    /**
     * An array of errors in the form: fieldname => The error which needs to be displayed
     * 
     * @var array 
     */
    private $_errors = array();

    public function addRule($fieldname, $message, $ruletype, $criteria = null)
    {
        $this->_rules[] = new ValidationRule($fieldname, $message, $ruletype, $criteria);
    }

    public function addEntries($fields) {
        foreach ($fields as $fieldname => $value) {
            $this->_fields[$fieldname] = $this->sanitize($value);
        }
    }
    
    /**
     * Return the fields after they've been cleaned
     * 
     * @return  array   The form data
     */
    public function getEntries() {
        return array_values($this->_fields);
    }
    
    /**
     * Loop through all the supplied rules and test each field against its rule
     * 
     * @see _testRule()
     * @return  void 
     */
    public function validate() {
        foreach ($this->_rules as $rule) {
            $this->_testRule($rule);
        }
    }
    
    /**
     * Check if errors were found
     * 
     * @return  boolean 
     */
    public function foundErrors()
    {
        if (count($this->_errors)) {
            return true;
        }
        return false;
    }

    /**
     * Append messages to the errors list
     * @param $msg
     */
    public function appendErrors($msg)
    {
        array_push($this->_errors,$msg);
    }


    /**
     * Retrieve the error messages in the form: fieldname => msg
     * 
     * @return  array   The error messages 
     */
    public function getErrors()
    {
        return $this->_errors;
    }  

    public function longerThan($value, $min)
    {
        if (strlen($value) >= $min) {
            return true;
        }
        return false;
    }

    public function asNumber($value)
    {
        if (preg_match("/^[-+]?[0-9]*\.?[0-9]+$/", $value)) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if a number is between two values
     * 
     * @param   mixed   $value  The number to test
     * @param   array   $range  An array containing the min and max
     * @return  boolean 
     */
    public function numberBetween($value, $range)
    {
        $min = $range[0];
        $max = $range[1];
        
        if ((preg_match("/^[-+]?[0-9]*\.?[0-9]+$/", $value)) && $value >= $min && $value <= $max) {
            return true;
        }
        return false;
    }
    
    /**
     * Validate the input as a zip code
     * 
     * @param   string    $value    The value to test
     * @return  boolean 
     */
    public function asZip($value)
    {
        /*
         * 5 digits followed by optional - and 4 more
         */
        if(preg_match("/^[0-9]{5}( *- *[0-9]{4})?$/",$value)) { 
            return true;
        }
        return false;
    }
    
    /**
     * Validate the input as an email address
     * 
     * @param   string  $value The value to test
     * @return  boolean
     */    
    public function asEmail($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    /**
     * Validate the input as a phone number
     * 
     * @param   string  $value  The value to test
     * @return  boolean 
     */
    public function asPhoneNumber($value)
    {
        /*
         * Optional enclosing parentheses, 3 digits, a set of 3 digits followed
         * by a set of 4 with optional spaces and a dash between them         *  
         */
        if (preg_match("/^\(?[0-9]{3}\)? *-? *[0-9]{3} *-? *[0-9]{4}$/", $value)) {
            return true;
        }
        return false;
    }
    
    /**
     * Clean up a string to remove html tags, strip slashes, etc.
     * 
     * @param   string  $text  The input text
     * @return  string
     */
    public function sanitize($text)
    {
        $text = trim(strip_tags($text));

        if (get_magic_quotes_gpc()) {
            $text = stripslashes($text);
        }
        return $text;
    }
    
    /**
     * Test a field against a given validation rule
     * 
     * @param   ValidationRule  $rule  A rule object
     * @return  void 
     */
    private function _testRule($rule) 
    {
        if (isset($this->_errors[$rule->fieldname])) {
            return;
        }

        if (isset($this->_fields[$rule->fieldname])) {
            $value = $this->_fields[$rule->fieldname];
        } 
        else {
            $value = null;
        }

        switch ($rule->ruletype) {
            case 'required' :
                if (empty($value)) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'minlength' :
                if (!($this->longerThan($value, $rule->criteria))) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'numeric' :
                if (!($this->asNumber($value))) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'numeric-range' :
                if (!($this->numberBetween($value, $rule->criteria))) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'in-array' :
                if (!(in_array($value, $rule->criteria))) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'email' :
                if (!($this->asEmail($value))) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'phonenumber' :
                if (!($this->asPhoneNumber($value))) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'zip' :
                if (!($this->asZip($value))) {
                    $this->_errors[$rule->fieldname] = $rule->message;
                    return;
                }
                break;
            case 'callback' :
                if (is_callable($rule->criteria)) {
                    $return = call_user_func($rule->criteria, $this);
                    if (!$return) {
                        $this->_errors[$rule->fieldname] = $rule->message;
                        return;
                    }
                }
                break;
        }
    }
}