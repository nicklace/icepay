<?php namespace Phamels\Icepay\API;

/**
 * \API\Logger
 * Handles all the logging
 * 
 * @author Olaf Abbenhuis
 * @author Wouter van Tilburg
 * @since 2.1.0
 */
class Logger {

    private static $instance;

    const NOTICE = 1;
    const TRANSACTION = 2;
    const ERROR = 4;
    const LEVEL_ALL = 1;
    const LEVEL_TRANSACTION = 2;
    const LEVEL_ERRORS = 4;
    const LEVEL_ERRORS_AND_TRANSACTION = 8;

    private $version = '1.0.0';
    protected $_loggingDirectory = 'logs';
    protected $_loggingFile = 'icepay.log';
    protected $_loggingEnabled = false;
    protected $_logToFile = false;
    protected $_logToScreen = false;
    protected $_logToHook = false;
    protected $_logHookClass = null;
    protected $_logHookFunc = null;
    protected $_logLevel = 14; // Log errors and transactions

    /**
     * Enables logging 
     *  
     * @since 2.1.0
     * @access public  
     * @return \Basicmode
     */

    public function enableLogging($bool = true)
    {
        $this->_loggingEnabled = $bool;

        return $this;
    }

    /**
     * Enables logging to file
     * 
     * @since 2.1.0
     * @access public 
     * @param bool $bool
     * @return \Basicmode
     */
    public function logToFile($bool = true)
    {
        $this->_logToFile = $bool;

        return $this;
    }

    /**
     * Enables logging to screen
     * 
     * @since 2.1.0
     * @access public
     * @param bool $bool
     * @return \Basicmode
     */
    public function logToScreen($bool = true)
    {
        $this->_logToScreen = $bool;

        return $this;
    }

    /**
     * Enable or disable logging to a hooked class
     * 
     * @since 2.1.0
     * @access public
     * @param string $className
     * @param string $logFunction 
     * @param bool $bool
     * @return \Basicmode
     */
    public function logToFunction($className = null, $logFunction = null, $bool = true)
    {
        $this->_logToHook = $bool;

        if (class_exists($className))
            $this->_logHookClass = new $className;

        if (is_callable($logFunction))
            $this->_logHookFunc = $logFunction;

        return $this;
    }

    /**
     * Set the directory of the logging file
     * 
     * @since 2.1.0
     * @access public 
     * @param type $dirName 
     * @return \Basicmode
     */
    public function setLoggingDirectory($dirName = null)
    {
        if ($dirName)
            $this->_loggingDirectory = $dirName;

        return $this;
    }

    /**
     * Set the logging file
     * 
     * @since 2.1.0
     * @access public
     * @param string $fileName 
     * @return \Basicmode
     */
    public function setLoggingFile($fileName = null)
    {
        if ($fileName)
            $this->_loggingFile = $fileName;

        return $this;
    }

    /**
     * Set the logging level
     * 
     * @since 2.1.0
     * @access public
     * @param int $level 
     */
    public function setLoggingLevel($level)
    {
        switch ($level) {
            case Logger::LEVEL_ALL:
                $this->_setLoggingFlag(Logger::NOTICE);
                $this->_setLoggingFlag(Logger::TRANSACTION);
                $this->_setLoggingFlag(Logger::ERROR);
                break;
            case Logger::LEVEL_ERRORS:
                $this->_setLoggingFlag(Logger::NOTICE, false);
                $this->_setLoggingFlag(Logger::TRANSACTION, false);
                $this->_setLoggingFlag(Logger::ERROR);
                break;
            case Logger::LEVEL_TRANSACTION:
                $this->_setLoggingFlag(Logger::NOTICE, false);
                $this->_setLoggingFlag(Logger::TRANSACTION);
                $this->_setLoggingFlag(Logger::ERROR, false);
                break;
            case Logger::LEVEL_ERRORS_AND_TRANSACTION:
                $this->_setLoggingFlag(Logger::NOTICE, false);
                $this->_setLoggingFlag(Logger::TRANSACTION);
                $this->_setLoggingFlag(Logger::ERROR);
                break;
        }

        return $this;
    }

    /*
     * Set the logging flag
     * 
     * @since 2.1.0
     * @access private
     * @param int $flag
     * @param bool $boolean
     */

    private function _setLoggingFlag($flag, $boolean = true)
    {
        if ($boolean) {
            $this->_logLevel |= $flag;
        } else {
            $this->_logLevel &= ~$flag;
        }
    }

    /*
     * Check if type is exists 
     * 
     * @since 2.1.0
     * @access private
     * @param int $type
     * @return bool
     */

    private function _isLoggingSet($type)
    {
        return (($this->_logLevel & $type) == $type);
    }

    /**
     * Log given line
     * 
     * @since 2.1.0
     * @access public
     * @param string $line
     * @param int $level
     * @return boolean
     * @throws \Exception 
     */
    public function log($line, $level = 1)
    {
        // Check if logging is enabled
        if (!$this->_loggingEnabled)
            return false;

        // Check if the level is within the required level
        if (!$this->_isLoggingSet($level))
            return false;

        //check if $line is serialized
        $serial = @unserialize($line);
        if($serial === 'b:0;' || $serial !== false) {
            //it was serialized
            if(! is_array($serial))
                $line = $serial;
        }

        $dateTime = date("H:i:s", time());
        $line = "{$dateTime} [ICEPAY]: {$line}" . PHP_EOL;

        // Log to Screen
        if ($this->_logToScreen)
            echo "{$line} <br />";

        // Log to Hooked Class
        if ($this->_logToHook && $this->_logHookClass && $this->_logHookFunc) {
            $function = $this->_logHookFunc;
            $this->_logHookClass->$function($line);
        }

        // Log to Default File
        if ($this->_logToFile) {
            if (!defined('DS')) 
                define("DS", DIRECTORY_SEPARATOR);

            $file = $this->_loggingDirectory . DS . $this->_loggingFile;
            static::checkFolder($this->_loggingDirectory);

            try {
                $fp = fopen($file, "a");
                fwrite($fp, $line);
                fclose($fp);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            };
        }
    }

    /**
     * Get version of API Logger
     * 
     * @since 2.1.0
     * @access public
     * @return version 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Create an instance
     * 
     * @since 2.1.0
     * @access public
     * @return instance of self
     */
    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self();
        return self::$instance;
    }

    private static function checkFolder($dir) {
        if (!file_exists($dir)) {
            if( mkdir($dir, 0770, true) )
                return true;
            else
                return false;
        }
        else {
            return true;
        }
    }
}