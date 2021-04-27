<?php
namespace Verdient\signature\encoder;

/**
 * HMAC编码器
 * @author Verdient。
 */
class HmacEncoder extends AbstractEncoder
{
    /**
     * @var string 编码方式
     * @author Verdient。
     */
    public $method = 'sha256';

    /**
     * 编码
     * @param string $data 待编码的数据
     * @param string $key 秘钥
     * @return string
     * @author Verdient。
     */
    public function encode(string $data, string $key): string
    {
        return hash_hmac($this->method, $data, $key);
    }
}