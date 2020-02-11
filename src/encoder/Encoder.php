<?php
namespace Verdient\signature\encoder;

/**
 * Encoder
 * 编码器
 * -------
 * @author Verdient。
 */
abstract class Encoder extends \chorus\BaseObject implements EncoderInterface
{
	/**
	 * validate(String $data, String $sign, String $key)
	 * 校验
	 * -------------------------------------------------
	 * @param String $data 原始数据
	 * @param String $sign 签名
	 * @param String $key 秘钥
	 * ----------------------------
	 * @return Bool
	 * @author Verdient。
	 */
	public function validate(String $data, String $sign, String $key): Bool {
		return hash_equals($this->encode($data, $key), $sign);
	}
}