<?php
namespace Verdient\signature\encoder;

/**
 * EncoderInterface
 * 编码器接口
 * ----------------
 * @author Verdient。
 */
interface EncoderInterface
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
	public function encode(String $data, String $key): String;

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
	public function validate(String $data, String $sign, String $key): Bool;
}