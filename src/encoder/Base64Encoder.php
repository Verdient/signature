<?php
namespace Verdient\signature\encoder;

/**
 * Base64Encoder
 * Base64编码器
 * -------------
 * @author Verdient。
 */
class Base64Encoder extends Encoder
{
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
		return base64_encode(hash('sha256', $data . $key));
	}
}