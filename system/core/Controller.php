<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

require_once('app/Emed.php');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller
{

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */

	public $dbemed;
	private $BPJSrequestHeader;

	public function __construct()
	{
		self::$instance = &$this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class) {
			$this->$var = &load_class($class);
		}

		$this->load = &load_class('Loader', 'core');
		$this->load->initialize();
		$this->dbemed = new Emed;
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

	public function getUTCTimestamp()
	{
		$time = strval(time() - strtotime('1970-01-01 00:00:00'));
		return $time;
	}

	public function requestHeader()
	{
		$time = $this->getUTCTimestamp();
		$token = base64_encode(hash_hmac('sha256', PPK . base64_decode(PASWWORD) . $time, base64_decode(SECREET_KEY)));
		$header = array(
			'x-username:' . base64_encode(PPK),
			'x-int:' . base64_encode($time),
			'x-token:' . $token
		);
		return $header;
	}


	public function loadService($host, $method, $header, $body)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $host);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		if ($method == 'GET') {
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
		} else {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}
		$response = curl_exec($ch);
		if (curl_errno($ch) > 0) {
			$response = curl_errno($ch);
		}
		curl_close($ch);
		return $response;
	}

	public function requestHeader_old()
	{
		/*BEGIN : Update @08-06-2022 */
		$httpHeader = [];
		$time = strval(time() - strtotime('1970-01-01 00:00:00'));
		if ($this->session->userdata('x-token') !== null) {
			if ($time - ($this->session->userdata('x-time')) < 10800) {
				$httpHeader = array(
					'x-username:' . PPK,
					'x-token:' . $this->session->userdata('x-token')
				);
				return $httpHeader;
			}
		}
		/*END: Update @08-06-2022 */
		$host = JKN_WS . 'token/gettoken';
		$header = array(
			'x-username:' . $this->session->userdata('ppk'),
			'x-password:' . PASWWORD
		);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $host);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_HTTPGET, 1);
		$response = curl_exec($curl);

		if (curl_errno($curl) > 0) {
			return curl_error($curl);
		} else 
		  if ($data = json_decode($response)) {
			$httpHeader = array(
				'x-username:' . $this->session->userdata('ppk'),
				'x-token:' . $data->response->token
			);
			$headerdata['x-token'] = $data->response->token;
			$headerdata['x-time'] =  strval(time() - strtotime('1970-01-01 00:00:00'));
			$this->session->set_userdata($headerdata);
		}
		curl_close($curl);
		return $httpHeader;
	}

	function createBpjsHeader()
	{
		date_default_timezone_set('UTC');
		$time = strval(time() - strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', CONST_ID . '&' . $time, base64_decode(SECREET_KEY), true);

		$header = array(
			'X-cons-id:' . CONST_ID,
			'X-Timestamp:' . $time,
			'X-Signature:' . base64_encode($signature),
			'user_key:' . USER_KEY
		);
		$this->BPJSrequestHeader = array(
			'X-cons-id' => CONST_ID,
			'X-Timestamp' => $time,
			'X-Signature' => base64_encode($signature),
			'user_key' => USER_KEY
		);
		return $header;
	}

	function decryptString($header, $string)
	{
		$pwd = base64_decode(SECREET_KEY);
		$id = $header['X-cons-id'];
		$timestamp = $header['X-Timestamp'];

		$key = $id . $pwd . $timestamp;
		$encrypt_method = 'AES-256-CBC';
		$key_hash = hex2bin(hash('sha256', $key));

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
		return $output;
	}

	function decompress($string)
	{
		return LZCompressor\LZString::decompressFromEncodedURIComponent($string);
	}

	public function connectBPJS($method = 'GET', $host, $header = '', $body = '')
	{
		$header = $this->createBpjsHeader();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $host);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		if ($method == 'GET') {
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
		} else {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}

		$curl = curl_exec($ch);

		if (curl_errno($ch) > 0) {
			$head['code'] = 201;
			$head['message'] = 'Error on Execute Curl : ' . curl_error($ch) . 'Number of error : ' . curl_errno($ch);
			$response = json_encode(array('metadata' => $head, 'response' => curl_error($ch)));
		} else {
			try {
				$data = json_decode($curl);
				//var_dump($data);
				$head['code'] = $data->metadata->code;
				$head['message'] = $data->metadata->message;

				if (($data->metadata->code == 1) || ($data->metadata->code == 200)) {
					//$result = json_decode($this->loadService(LZ_TOOL, 'POST', $header, $data->response), true);
					$result = json_decode($this->decompress($this->decryptString($this->BPJSrequestHeader, $data->response)), true);
					$response =  json_encode(array('metadata' => $head, 'response' => $result));
				} else {
					$response =  json_encode(array('metadata' => $head));
				}
			} catch (\Throwable $th) {
				$response =  json_encode(array('metadata' => $head, 'response' => $th->getMessage()));
			}
		}
		curl_close($ch);
		return $response;
	}

	public function connectBPJSnoEncrypt($method = 'GET', $host, $header = '', $body = '')
	{
		$header = $this->createBpjsHeader();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $host);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		if ($method == 'GET') {
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
		} else {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}

		try {
			$data = json_decode(curl_exec($ch));

			$head['code'] = $data->metadata->code;
			$head['message'] = $data->metadata->message;

			if (($data->metadata->code == 1) || ($data->metadata->code == 200)) {
				//$result = json_decode($this->loadService(LZ_TOOL, 'POST', $header, $data->response), true);
				$response =  json_encode(array('metadata' => $head, 'response' => $data->response));
			} else {
				$result = $data;
				$response =  json_encode(array('metadata' => $head));
			}
		} catch (\Throwable $th) {
			$response =  json_encode(array('metadata' => $head, 'response' => $th->getMessage()));
		}

		if (curl_errno($ch) > 0) {
			$response = curl_error($ch);
		}
		curl_close($ch);
		return $response;
	}
}
