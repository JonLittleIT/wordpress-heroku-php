<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) exit( 'Direct script access denied.' );

class FOXPUSH_API
{
	private $domain;
	private $api_key;
	public  $isset_error;
	public $error_message;

	public function __construct($domain,$api_key)
	{
		if($domain != '' and $api_key != '')
		{
			$this->domain  = $domain;
			$this->api_key = $api_key;

			$this->isset_error = 0;

			return true;
		}
		else{
			$this->isset_error = 1;
			return false;
		}
	}

	public function get_daily_chart()
	{
		$url = 'https://api.foxpush.com/v1/publisher/daily_chart';
		$json_data = json_decode($this->FoxPush_Request($url));
		if(is_object($json_data))
		{
			if($json_data->status == 1 && $json_data->code == 200)
			{
				if(is_array($json_data->chart))
				{
					$arr = array();
					if(count($json_data->chart) > 0)
					{
						foreach ($json_data->chart as $v)
						{
							$arr[$v->date] = $v->subscribers;
						}
					}

					return $arr;
				}
				else
				{
					$this->isset_error = 1;
					return false;
				}
			}
			else
			{
				$this->isset_error = 1;
				$this->error_message = $json_data->error_message;
				return false;
			}
		}
		else
		{
			$this->isset_error = 1;
			return false;
		}
	}

	public function get_publisher_stats()
	{
		$url = 'https://api.foxpush.com/v1/publisher/stats';
		$json_data = json_decode($this->FoxPush_Request($url));
		if(is_object($json_data))
		{
			if($json_data->status == 1 && $json_data->code == 200)
			{
				$arr = array(
					'total_subscribers' => $json_data->total_subscribers,
					'total_campaigns'   => $json_data->total_campaigns,
					'total_views'       => $json_data->total_views,
					'total_clicks'      => $json_data->total_clicks
				);

				return $arr;
			}
			else
			{
				$this->isset_error = 1;
				$this->error_message = $json_data->error_message;
				return false;
			}
		}
		else
		{
			$this->isset_error = 1;
			return false;
		}
	}

	public function get_user_code()
	{
		$url = 'https://api.foxpush.com/v1/publisher/code';
		$json_data = json_decode($this->FoxPush_Request($url));
		if(is_object($json_data))
		{
			if($json_data->status == 1 && $json_data->code == 200)
			{
				$subdomain = $json_data->subdomain;
				$code = "<script type=\"text/javascript\">
                            (function(){
                            var foxscript = document.createElement('script');
                            foxscript.src = '//js.foxpush.com/".$subdomain.".js?v='+Math.random();
                            foxscript.type = 'text/javascript';
                            foxscript.async = 'true';
                            var fox_s = document.getElementsByTagName('script')[0];
                            fox_s.parentNode.insertBefore(foxscript, fox_s);})();
                            </script>";

				return $code;
			}
			else
			{
				$this->isset_error = 1;
				$this->error_message = $json_data->error_message;
				return false;
			}
		}
		else
		{
			$this->isset_error = 1;
			return false;
		}
	}


	private function FoxPush_Request($url,$timeout = 15)
	{
		$ssl = stripos($url,'https://') === 0 ? true : false;

		$curlObj = curl_init();

		$options = [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_FOLLOWLOCATION => 1,
			CURLOPT_AUTOREFERER => 1,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)',
			CURLOPT_TIMEOUT => $timeout,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
			CURLOPT_HTTPHEADER => ['FOXPUSH_DOMAIN: '.$this->domain.'','FOXPUSH_TOKEN: '.$this->api_key.''],
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
		];

		if ($ssl) {
			//support https
			$options[CURLOPT_SSL_VERIFYHOST] = false;
			$options[CURLOPT_SSL_VERIFYPEER] = false;
		}

		curl_setopt_array($curlObj, $options);


		$returnData = curl_exec( $curlObj );

		if (curl_errno($curlObj)) {
			//error message
			$returnData = curl_error($curlObj);
		}
		curl_close($curlObj);
		return $returnData;
	}
}