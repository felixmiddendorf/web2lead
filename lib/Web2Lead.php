<?php
/**
 * Web2Lead - A php library for sending leads to Salesforce CRM
 *
 * This library is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.
 * If not, see <{@link http://www.gnu.org/licenses/lgpl-3.0.txt}>.
 *
 * @author Felix Middendorf
 * @copyright 2010 Felix Middendorf
 * @link http://www.felixmiddendorf.eu/
 * @package Web2Lead
 * @version 0.1
 * @license http://www.gnu.org/licenses/lgpl-3.0.txt GNU Lesser General Public License 3.0
 */

/**
 * Use this class to send leads to Salesforce. Please ensure that the cURL
 * library is installed (see http://php.net/curl/).
 * 
 * Usage:
 * <code>
 * $web2lead = new Web2Lead($your_org_id);
 * $web2lead->setLeadSource('online_shop');
 * // either
 * $web2lead->toSalesforce(array('first_name' => 'Bobby'));
 * // or
 * $web2lead->toSalesforce($object);
 * // where $object is an instance of SalesforceLead
 * </code>
 * @see http://php.net/curl/
 */
class Web2Lead{
	/**
	 * Web2Lead library version number.
	 * @var string
	 */
	const VERSION = '0.1';
	
	/**
	 * Salesforce organization ID.
	 * @var string
	 */
	private $oid = '';
	
	/**
	 * The source transferred leads will be associated with.
	 * @var string
	 */
	private $lead_source = '';
	
	/**
	 * Encoding used when transferring leads. Default is UTF-8.
	 * @var string
	 */
	private $encoding = 'UTF-8';
	
	/**
	 * Use debug mode offered by Salesforce. Default is false.
	 * @var bool
	 */
	private $debug = false;
	
	/**
	 * Debug email address sent in debug mode. There is no default.
	 * @var string
	 */
	private $debugEmail = '';
	
	/**
	 * Use SSL when transferring leads. Default is false.
	 * @var bool
	 */
	private $ssl = false;
	
	/**
	 * Salesforce URL (without protocol).
	 * @var string
	 */
	private $url = "www.salesforce.com/servlet/servlet.WebToLead";
	
	/**
	 * Last response.
	 * @var string
	 */
	private $response = '';
	
	/**
	 * Last error.
	 * @var string
	 */
	private $error = '';

	/**
	 * Ensures that the cURL library is installed; otherwise an error is
	 * triggered.
	 * @see http://php.net/curl/
	 * @param string $oid organization ID
	 */
	public function __construct($oid = NULL){
		// check if cURL is installed
		if(!function_exists('curl_init')){
			// TODO error/exception ok?
			trigger_error('cURL Library could not be found', E_USER_ERROR);
		}
		if($oid !== NULL){
			$this->oid = $oid;
		}
	}

	/**
	 * Set the organization ID used when transferring leads to Salesforce.
	 * @param string $oid
	 */
	public function setOrganizationID($oid){
		$this->oid = $oid;
	}

	/**
	 * Set the lead source.
	 * @param string $lead_source
	 */
	public function setLeadSource($lead_source){
		$this->lead_source = $lead_source;
	}

	/**
	 * Enable or disable SSL mode. Default is disabled. SSL mode is
	 * experimental.
	 * @param bool $ssl set true to enable.
	 */
	public function setSSL($ssl){
		$this->ssl = (bool) $ssl;
	}

	/**
	 * Enable or disable Salesforce's debug mode. Default is disabled.
	 * @param bool $debug set true to enable
	 */
	public function setDebug($debug){
		$this->debug = (bool) $debug;
	}

	/**
	 * Set the debug email address send to Salesforce (only used when in debug
	 * mode).
	 * @param string $debugEmail
	 */
	public function setDebugEmail($debugEmail){
		$this->debugEmail = $debugEmail;
	}

	/**
	 * Sends a lead to Salesforce. <code>$lead</code> can be either an array or
	 * an instance of a class that implements the <code>SalesforceLead</code>
	 * interface.
	 * @param mixed $lead lead to be sent to Salesforce
	 * @return true on success, else false
	 */
	public function toSalesforce($lead){
		if(is_object($lead) && $lead instanceof SalesforceLead){
			$lead = $lead->exportLead();
		}
		if(!is_array($lead) || count($lead) === 0){
			// TODO error/exception?
			return false;
		}
		$handler = curl_init();
		if(($this->error = curl_error($handler)) && $this->error !== ''){
			return false;
		}
		$options = array(
			CURLOPT_URL => $this->getURL(),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FAILONERROR => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $this->postFields($lead),
			CURLOPT_SSL_VERIFYPEER => false // TODO
		);
		curl_setopt_array($handler, $options);
		$this->response = curl_exec($handler);
		curl_close($handler);
		$return = ($this->response !== false);
		return $return;
	}

	/**
	 * Returns the last response.
	 * @return string
	 */
	public function getResponse(){
		return $this->response;
	}

	/**
	 * Returns the last error.
	 * @return string
	 */
	public function getError(){
		return $this->error;
	}

	/**
	 * Returns the URL the data will be send to.
	 * @return string
	 */
	private function getURL(){
		return (($this->ssl) ? 'https://' : 'http://').$this->url;
	}

	/**
	 * Returns a url-encoded string containing the information in
	 * <code>$fields</code> and some of the attributes of <code>$this</code>.
	 * @param array $fields
	 * @return string url-encoded string
	 */
	private function postFields($fields){
		// TODO what about overwrites!?
		$defaults = array(
			'oid' => $this->oid,
			'encoding' => $this->encoding,
			'debug' => $this->debug
		);
		$post = array_merge($defaults, $fields);
		if($post['debug'] && empty($post['debugEmail'])){
			// add debugEmail if debugging is set
			$post['debugEmail'] = $this->debugEmail;
		}
		if(empty($post['lead_source']) && !empty($this->lead_source)){
			// add lead_source if it is not already set
			$post['lead_source'] = $this->lead_source;
		}
		// arg_separator.output can not always be trusted, therfore '&' will
		// always be used as the separator for POST requests
		return http_build_query($post, '', '&');
	}
}
