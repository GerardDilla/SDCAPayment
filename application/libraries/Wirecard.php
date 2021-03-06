<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Exception\GuzzleException;
class wirecard 
{
	
	public function test(){
		return 'test';
	}
	/**
	 * Functions which are used for registering a payment by all 3 types of integration.
	 */

	/**
	 * Creates a payload for standalone or embedded payment page based on the example request JSON file,
	 * which can be used as the body of a register payment POST request.
	 *
	 * @param $paymentMethod
	 * @return array An array containing all the required parameters of the POST body.
	 */
	function createPayload($paymentMethod)
	{
		require_once('../util/globals.php');

		$payloadText = file_get_contents(PATHS_TO_SAMPLE_REQUESTS[$paymentMethod]);
		return modifyPayload($payloadText);
	}

	/**
	 * Modifies the payload. It sets a unique request id. The base url of the application is added to the success,
	 * cancel and fail url.
	 *
	 * @param $payloadText
	 * @return array An array containing all the required parameters of the POST body.
	 */
	function modifyPayload($payloadText)
	{
		$payload = json_decode($payloadText, $assoc = true);
		$uuid = $payload["payment"]["request-id"];
		if ($payload["payment"]["request-id"] === "") {
			$uuid = uniqid();
			$payload["payment"]["request-id"] = $uuid;
		}
		$_SESSION["uuid"] = $uuid;

		foreach ($payload["payment"]["notifications"]["notification"] as $key => &$value) {
			$value["url"] = getBaseUrl() . $value["url"];
		}

		$payload["payment"]["success-redirect-url"] = getBaseUrl() . $payload["payment"]["success-redirect-url"];
		$payload["payment"]["fail-redirect-url"] = getBaseUrl() . $payload["payment"]["fail-redirect-url"];
		$payload["payment"]["cancel-redirect-url"] = getBaseUrl() . $payload["payment"]["cancel-redirect-url"];
		return $payload;
	}

	/**
	 * Sends a POST request to the WPP register payment endpoint.
	 *
	 * @param $payload
	 * @param $paymentMethod
	 * @return array|mixed The response from WPP as an array if the request was successful.
	 *      An array with the number and the description of the curl error if the request was not successful.
	 * @throws GuzzleException
	 */
	function postRegisterRequest($payload, $paymentMethod)
	{
		$username = MERCHANT[$paymentMethod]["username"];
		$password = MERCHANT[$paymentMethod]["password"];

		$client = new GuzzleHttp\Client();
		$headers = [
			'Content-type' => 'application/json; charset=utf-8',
			'Accept' => 'application/json',
			'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
		];

		$response = $client->request('POST', WPP_CUSTOMER_TEST_URL . WPP_REGISTER_URL, [
			'headers' => $headers,
			'body' => json_encode($payload),
		]);

		$contents = $response->getBody()->getContents();
		return json_decode($contents, true);
	}

	/**
	 * Retrieves a payment-redirect-url from the WPP register payment endpoint and writes this URL into the session.
	 *
	 * @param $payload
	 * @param $paymentMethod
	 * @return bool TRUE if the request was successful and the response contained a redirect URL. FALSE otherwise.
	 * @throws GuzzleException
	 */
	function retrievePaymentRedirectUrl($payload, $paymentMethod)
	{
		$responseContent = $this->postRegisterRequest($payload, $paymentMethod);
		// An error response looks like this:
		// { "errors" : [
		//      {
		//          "code" : "E7001",
		//          "description" : "Violation of field payment.requestedAmount.currency: size must be between 3 and 3"
		//      },
		//      {
		//          "code" : "E7001",
		//          "description" : "Requested payment method is not supported."
		//      }
		// ] }
		if (array_key_exists("errors", $responseContent)) {
			echo "The registration of the payment failed: <br>";
			foreach ($responseContent["errors"] as $error) {
				echo "code: " . $error["code"] . " description: " . $error["description"] . "<br>";
			}

			return false;
		}

		// A successful response looks like this:
		// { "payment-redirect-url" : "https://wpp-test.wirecard.com/?wPaymentToken=eQloDaTU-QvoB-whatever" }

		if (!isset($_SESSION)) {
			session_start();
		}

		$paymentRedirectUrl = $responseContent["payment-redirect-url"];
		$_SESSION["payment-redirect-url"] = $paymentRedirectUrl;

		return true;
	}


}