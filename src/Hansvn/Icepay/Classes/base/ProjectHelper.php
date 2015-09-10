<?php namespace Hansvn\Icepay;

/**
 *  ProjectHelper class
 *  A helper for all-in-one solutions
 * 
 *  @author Olaf Abbenhuis
 *  @since 1.0.0
 *
 */
class ProjectHelper {

    private static $instance;
    private $_release = "2.5.2";
    private $_basic;
    private $_result;
    private $_postback;
    private $_validate;

    /**
     * Returns the Basicmode class or creates it
     * 
     * @since 1.0.0
     * @access public
     * @return \Basicmode
     */
    public function basic()
    {
        if (!isset($this->_basic))
            $this->_basic = new Basicmode();
        return $this->_basic;
    }

    /**
     * Returns the Result class or creates it
     * 
     * @since 1.0.0
     * @access public
     * @return \Result
     */
    public function result()
    {
        if (!isset($this->_result))
            $this->_result = new Result();
        return $this->_result;
    }

    /**
     * Returns the Postback class or creates it
     * 
     * @since 1.0.0
     * @access public
     * @return \Postback
     */
    public function postback()
    {
        if (!isset($this->_postback))
            $this->_postback = new Postback();
        return $this->_postback;
    }

    /**
     * Returns the Paramater_Validation class or creates it
     * 
     * @since 1.1.0
     * @access public
     * @return \Parameter_Validation
     */
    public function validate()
    {
        if (!isset($this->_validate))
            $this->_postback = new ParameterValidation();
        return $this->_validate;
    }

    /**
     * Returns the current release version
     * 
     * @since 1.1.0
     * @access public
     * @return string 
     */
    public function getReleaseVersion()
    {
        return $this->_release;
    }

    /**
     * Create an instance
     * @since version 1.0.2
     * @access public
     * @return instance of self
     */
    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self();
        return self::$instance;
    }

}