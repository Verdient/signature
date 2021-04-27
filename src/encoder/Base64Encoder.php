<?php
namespace Verdient\signature\encoder;

/**
 * Base64编码器
 * @author Verdient。
 */
class Base64Encoder extends AbstractEncoder
{
    /**
     * 编码
     * @param string $data 待编码的数据
     * @param string $key 秘钥
     * @return string
     * @author Verdient。
     */
    public function encode(string $data, string $key): string
    {
        return base64_encode(hash('sha256', $data . $key));
    }
}