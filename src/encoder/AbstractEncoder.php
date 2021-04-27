<?php
namespace Verdient\signature\encoder;

use chorus\BaseObject;
use chorus\Configurable;

/**
 * 抽象编码器
 * @author Verdient。
 */
abstract class AbstractEncoder extends BaseObject implements EncoderInterface
{
    use Configurable;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public function __construct($config = [])
    {
        $this->configuration($config);
    }

    /**
     * 校验
     * @param string $data 原始数据
     * @param string $sign 签名
     * @param string $key 秘钥
     * @return bool
     * @author Verdient。
     */
    public function validate(string $data, string $sign, string $key): bool
    {
        return hash_equals($this->encode($data, $key), $sign);
    }
}