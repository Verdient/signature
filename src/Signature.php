<?php
namespace Verdient\signature;

use chorus\InvalidConfigException;
use chorus\InvalidParamException;
use chorus\ObjectHelper;
use Verdient\signature\encoder\EncoderInterface;

/**
 * Signature
 * 签名
 * ---------
 * @author Verdient。
 */
class Signature extends \chorus\BaseObject
{
	/**
	 * @var String $key
	 * 秘钥
	 * ----------------
	 * @author Verdient。
	 */
	public $key = null;

	/**
	 * @var String $encoder
	 * 编码器
	 * --------------------
	 * @author Verdient。
	 */
	public $encoder = 'Verdient\signature\encoder\HmacEncoder';

	/**
	 * @var String $_encoder
	 * 编码器实例
	 * ---------------------
	 * @author Verdient。
	 */
	protected $_encoder = false;

	/**
	 * getEncoder()
	 * 获取编码器
	 * ------------
	 * @return EncoderInterface
	 * @author Verdient。
	 */
	public function getEncoder(){
		if($this->_encoder === false){
			$this->_encoder = ObjectHelper::create($this->encoder);
			if(!$this->_encoder instanceof EncoderInterface){
				throw new InvalidConfigException('encoder必须实现EncoderInterface');
			}
		}
		return $this->_encoder;
	}

	/**
	 * sign(String $value[, String $key = null, String $method = null])
	 * 签名
	 * ----------------------------------------------------------------
	 * @param String $value 待签名的值
	 * @param String $key 秘钥
	 * -------------------------------
	 * @return String
	 * @author Verdient。
	 */
	public function sign($value, $key = null){
		$key = $key ?: $this->key;
		return $this->getEncoder()->encode($this->normalizeData($value), $key);
	}

	/**
	 * validate(String $value, String $sign[, String $key, String $method = null])
	 * 验证签名
	 * ---------------------------------------------------------------------------
	 * @param String $value 待签名的内容
	 * @param String $sign 签名
	 * @param String $key 签名秘钥
	 * @param String $method 签名方法
	 * -------------------------------
	 * @return Boolean
	 * @author Verdient。
	 */
	public function validate($value, $sign, $key = null){
		$key = $key ?: $this->key;
		return $this->getEncoder()->validate($this->normalizeData($value), $sign, $key);
	}

	/**
	 * normalizeData(Mixed $data)
	 * 格式化数据
	 * --------------------------
	 * @param Mixed $data 数据
	 * -----------------------
	 * @author Verdient。
	 */
	public function normalizeData($data){
		if(is_string($data)){
			return $data;
		}
		if(is_array($data)){
			ksort($data);
			return json_encode($data, JSON_UNESCAPED_UNICODE);
		}
		throw new InvalidParamException('签名数据必须是字符串或数组');
	}
}