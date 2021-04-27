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
     * 编码
     * @param string $data 待编码的数据
     * @param string $key 秘钥
     * @return string
     * @author Verdient。
     */
    public function encode(string $data, string $key): string;

    /**
     * 校验
     * @param string $data 原始数据
     * @param string $sign 签名
     * @param string $key 秘钥
     * @return bool
     * @author Verdient。
     */
    public function validate(string $data, string $sign, string $key): bool;
}