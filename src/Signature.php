<?php
namespace Verdient\signature;

use chorus\BaseObject;
use chorus\Configurable;
use chorus\InvalidConfigException;
use chorus\InvalidParamException;
use chorus\ObjectHelper;
use Verdient\signature\encoder\EncoderInterface;

/**
 * 签名
 * @author Verdient。
 */
class Signature extends BaseObject
{
    use Configurable;

    /**
     * @var string 秘钥
     * @author Verdient。
     */
    public $key = null;

    /**
     * @var string 编码器
     * @author Verdient。
     */
    public $encoder = 'Verdient\signature\encoder\HmacEncoder';

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public function __construct($config = [])
    {
        $this->configuration($config);
    }

    /**
     * 获取编码器
     * @return EncoderInterface
     * @author Verdient。
     */
    public function getEncoder(){
        $encoder = ObjectHelper::create($this->encoder);
        if(!$encoder instanceof EncoderInterface){
            throw new InvalidConfigException('encoder must instance of EncoderInterface');
        }
        return $encoder;
    }

    /**
     * 签名
     * @param string $value 待签名的值
     * @param string $key 秘钥
     * @return string
     * @author Verdient。
     */
    public function sign($value, $key = null){
        $key = $key ?: $this->key;
        return $this->getEncoder()->encode($this->normalizeData($value), $key);
    }

    /**
     * 验证签名
     * @param string $value 待签名的内容
     * @param string $sign 签名
     * @param string $key 签名秘钥
     * @return Boolean
     * @author Verdient。
     */
    public function validate($value, $sign, $key = null){
        $key = $key ?: $this->key;
        return $this->getEncoder()->validate($this->normalizeData($value), $sign, $key);
    }

    /**
     * 格式化数据
     * @param string|array $data 数据
     * @throws InvalidParamException
     * @return string
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