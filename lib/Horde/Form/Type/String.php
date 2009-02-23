<?php
/**
 * String
 */
class Horde_Form_Type_String extends Horde_Form_Type {

    /**
     * Validation regex
     *
     * @type string
     * @var string
     */
    protected $_regex;

    /**
     * Maximum length
     *
     * @type int
     * @var integer
     */
    protected $_maxlength;

    public function isValid($var, $vars, $value, &$message)
    {
        $valid = true;

        if (!empty($this->_maxlength) && String::length($value) > $this->_maxlength) {
            $valid = false;
            $message = sprintf(_("Value is over the maximum length of %s."), $this->_maxlength);
        } elseif ($var->required && empty($this->_regex)) {
            if (!($valid = strlen(trim($value)) > 0)) {
                $message = _("This field is required.");
            }
        } elseif (strlen($this->_regex)) {
            if (!($valid = preg_match($this->_regex, $value))) {
                $message = _("You must enter a valid value.");
            }
        }

        return $valid;
    }

}
