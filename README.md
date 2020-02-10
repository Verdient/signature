# Signature
签名
## 安装
```bash
composer require verdient/signature
```
## 创建签名实例
```php
use signature\Signature;

/**
 * 签名秘钥
 */
$key = '****';

/**
 * 编码器
 * 默认为signature\encoder\HmacEncoder
 * 系统内置了HmacEncoder和Base64Encoder，也可以通过实现EncoderInterface来实现自己的编码器
 * 可以通过数组的方式来配置，格式为
 * [
 *     'class' => {className}
 *     ${property1} => ${property1},
 *     ${property2} => ${property2},
 *     ...
 * ]
 */
$encoder = 'signature\encoder\HmacEncoder';

$sign = new Signature([
	'key' => $key,
	'encoder ' => $encoder
]);
```
## 对数据进行签名
```php
/**
 * 待签名的数据
 * 可以为字符串和数组
 */
$data = ['key1' => 1, 'key2' => 2, 'key3' => 3];

$signature = $sign->sign($data);
```
## 验证签名
```php
$sign->validate($data, $signature)
```