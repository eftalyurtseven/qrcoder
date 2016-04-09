<?php
/**
 * QRCODER - Image Generator (PNG)
 *
 * @package QRCODER
 * @category QRCODER
 * @name QRCODER
 * @version 1.0
 * @author Eftal Yurtseven
 * @authorURI: http://e-yurtseven.net

 */
final class QRCoder {
	/**
	 * Chart API URL
	 */
	const API_CHART_URL = "http://chart.apis.google.com/chart";

	/**
	 * Code data
	 *
	 * @var string $_data
	 */
	private $_data;

	/**
	 * Bookmark code
	 *
	 * @param string $title
	 * @param string $url
	 */
	public function bookmark($title = null, $url = null) {
		$this->_data = "MEBKM:Başlık:{$title};URL:{$url};;";
	}

	/**
	 * MECARD code
	 *
	 * @param string $name
	 * @param string $address
	 * @param string $phone
	 * @param string $email
	 */
	public function contact($name = null, $address = null, $phone = null, $email = null) {
		$this->_data = "Ben|Ad:{$name};SoyAd:{$address};Tel:{$phone};Email:{$email};;";
	}

	/**
	 * Create code with GIF, JPG, etc.
	 *
	 * @param string $type
	 * @param string $size
	 * @param string $content
	 */

	/**
	 * Generate QR code image
	 *
	 * @param int $size
	 * @param string $filename
	 * @return bool
	 */
	public function draw($size = 150, $filename = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::API_CHART_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$size}x{$size}&cht=qr&chl=" . urlencode($this->_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$img = curl_exec($ch);
		curl_close($ch);

		if($img) {
			if($filename) {
				if(!preg_match("#\.png$#i", $filename)) {
					$filename .= ".png";
				}
				
				return file_put_contents($filename, $img);
			} else {
				header("Content-type: image/png");
				print $img;
				return true;
			}
		}

		return false;
	}

	/**
	 * Email address code
	 *
	 * @param string $email
	 * @param string $subject
	 * @param string $message
	 */
	public function email($email = null, $subject = null, $message = null) {
		$this->_data = "MATMSG:TO:{$email};SUB:{$subject};BODY:{$message};;";
	}

	/**
	 * Geo location code
	 *
	 * @param string $lat
	 * @param string $lon
	 * @param string $height
	 */
	public function geo($lat = null, $lon = null, $height = null) {
		$this->_data = "GEO:{$lat},{$lon},{$height}";
	}

	/**
	 * Telephone number code
	 *
	 * @param string $phone
	 */
	public function phone($phone = null) {
		$this->_data = "TEL:{$phone}";
	}

	/**
	 * SMS code
	 *
	 * @param string $phone
	 * @param string $text
	 */
	public function sms($phone = null, $text = null) {
		$this->_data = "SMSTO:{$phone}:{$text}";
	}

	/**
	 * Text code
	 *
	 * @param string $text
	 */
	public function text($text = null) {
		$this->_data = $text;
	}

	/**
	 * URL code
	 *
	 * @param string $url
	 */
	public function url($url = null) {
		$this->_data = preg_match("#^https?\:\/\/#", $url) ? $url : "http://{$url}";
	}

	/**
	 * Wifi code
	 *
	 * @param string $type
	 * @param string $ssid
	 * @param string $password
	 */
	public function wifi($type = null, $ssid = null, $password = null) {
		$this->_data = "WIFI:Kullanıcı Adı:{$ssid};Type: {$type}; Şifre:{$password};";
	}
}
?>