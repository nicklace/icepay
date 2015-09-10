<?php namespace Hansvn\Icepay;

class IcepayManager {

	/**
	 * Config
	 *
	 * @var array
	 */
	public $config = array();
	private $logger = null;

	 /**
	 * Creates new instance of Icepay
	 *
	 * @param array $config
	 */
	public function __construct(array $config = array()) {
		$this->configure($config);

		define('MERCHANTID', \Config::get('icepay::MERCHANTID'));
		define('SECRETCODE', \Config::get('icepay::SECRETCODE'));

		if(\Config::get('icepay::log')) {
			$this->logger = API\Logger::getInstance();
			$this->logger->enableLogging()
					->setLoggingLevel(API\Logger::LEVEL_ALL)
					->logToFile()
					->setLoggingDirectory(storage_path('logs'))
					->setLoggingFile("icepay.log");
		}
	}

	/**
	 * Overrides configuration settings
	 *
	 * @param array $config
	 */
	public function configure(array $config = array())
	{
		$this->config = array_replace($this->config, $config);
		return $this;
	}

	public function paymentObject() {
		return new PaymentObject();
	}

	public function basicMode() {
		$basicmode = Basicmode::getInstance();
		$basicmode	->setMerchantID(MERCHANTID)
					->setSecretCode(SECRETCODE)
					->setLogger($this->logger);

		return $basicmode;
	}

	public function result() {
		$result = new Result();
		$result	->setMerchantID(MERCHANTID)
				->setSecretCode(SECRETCODE)
				->setLogger($this->logger);

		return $result;
	}

	public function postback() {
		$postback = new Postback();
		$postback	->setMerchantID(MERCHANTID)
					->setSecretCode(SECRETCODE)
					->setLogger($this->logger);

		return $postback;
	}

}