<?php
namespace Verdient\signature\encoder;

/**
 * HmacEncoder
 * HMAC编码器
 * -----------
 * @author Verdient。
 */
class HmacEncoder extends Encoder
{
	/**
	 * @var String $method
	 * 编码方式
	 * -------------------
	 * @author Verdient。
	 */
	public $method = 'sha256';

	/**
	 * encode(String $data, String $key)
	 * 编码
	 * ---------------------------------
	 * @param String $data 待编码的数据
	 * @param String $key 秘钥
	 * ------------------------------
	 * @return String
	 * @author Verdient。
	 */
	public function encode(String $data, String $key): String {
		return hash_hmac($this->method, $data, $key);
	}
}