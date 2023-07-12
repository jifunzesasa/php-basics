<?php

class PublicKeyLoader
{

    /**
     * Load a public key from a file or a string
     *
     * @param string $key
     * @return string
     */
    public static function load($key)
    {
        // if the key is a file path
        if (self::isFile($key)) {
            $key = self::readFile($key);
        }

        // if the key is a string
        // if the key is not a PEM-formatted string
        if (strpos($key, '-----BEGIN PUBLIC KEY-----') === false) {
            // chunk it into PEM-formatted string
            $key = chunk_split($key, 64, "\n");
            $key = "-----BEGIN PUBLIC KEY-----\n" . $key . "-----END PUBLIC KEY-----";
        }

        return $key;
    }

    /**
     * Check if the key is a file path
     *
     * @param string $key
     * @return boolean
     */
    private static function isFile($key)
    {
        return file_exists($key);
    }

    /**
     * Read key from file
     *
     * @param string $key
     * @return string
     */
    private static function readFile($key)
    {
        return file_get_contents($key);
    }
}

/**
 * Encryption class
 */
class Encryption
{
    /**
     * Options
     *
     * @var array
     */
    private $options;

    /**
     * Construct
     *
     * @param array $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Encrypt using public key
     *
     * @param string $key
     * @return string
     */
    public function encrypt($key)
    {
        $publicKey = PublicKeyLoader::load($this->options['public_key']);
        $encrypted = '';

        try {
            $publicKeyResource = openssl_pkey_get_public($publicKey);

            if (!$publicKeyResource) {
                throw new Throwable(openssl_error_string());
            }
            if (!openssl_public_encrypt($key, $encrypted, $publicKeyResource)) {
                throw new Throwable(openssl_error_string());
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return base64_encode($encrypted);
    }
}

$options = [
    'public_key' => 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEArv9yxA69XQKBo24BaF/D+fvlqmGdYjqLQ5WtNBb5tquqGvAvG3WMFETVUSow/LizQalxj2ElMVrUmzu5mGGkxK08bWEXF7a1DEvtVJs6nppIlFJc2SnrU14AOrIrB28ogm58JjAl5BOQawOXD5dfSk7MaAA82pVHoIqEu0FxA8BOKU+RGTihRU+ptw1j4bsAJYiPbSX6i71gfPvwHPYamM0bfI4CmlsUUR3KvCG24rB6FNPcRBhM3jDuv8ae2kC33w9hEq8qNB55uw51vK7hyXoAa+U7IqP1y6nBdlN25gkxEA8yrsl1678cspeXr+3ciRyqoRgj9RD/ONbJhhxFvt1cLBh+qwK2eqISfBb06eRnNeC71oBokDm3zyCnkOtMDGl7IvnMfZfEPFCfg5QgJVk1msPpRvQxmEsrX9MQRyFVzgy2CWNIb7c+jPapyrNwoUbANlN8adU1m6yOuoX7F49x+OjiG2se0EJ6nafeKUXw/+hiJZvELUYgzKUtMAZVTNZfT8jjb58j8GVtuS+6TM2AutbejaCV84ZK58E2CRJqhmjQibEUO6KPdD7oTlEkFy52Y1uOOBXgYpqMzufNPmfdqqqSM4dU70PO8ogyKGiLAIxCetMjjm6FCMEA3Kc8K0Ig7/XtFm9By6VxTJK1Mg36TlHaZKP6VzVLXMtesJECAwEAAQ=='
];

$encryption = new Encryption($options);
$key = "";
$encrypted = $encryption->encrypt($key);

echo $encrypted;


// $key = "";
// // $pKey = PublicKeyLoader::load($this->options['public_key']);
// // $pKey = "";
// $public_key  = 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEArv9yxA69XQKBo24BaF/D+fvlqmGdYjqLQ5WtNBb5tquqGvAvG3WMFETVUSow/LizQalxj2ElMVrUmzu5mGGkxK08bWEXF7a1DEvtVJs6nppIlFJc2SnrU14AOrIrB28ogm58JjAl5BOQawOXD5dfSk7MaAA82pVHoIqEu0FxA8BOKU+RGTihRU+ptw1j4bsAJYiPbSX6i71gfPvwHPYamM0bfI4CmlsUUR3KvCG24rB6FNPcRBhM3jDuv8ae2kC33w9hEq8qNB55uw51vK7hyXoAa+U7IqP1y6nBdlN25gkxEA8yrsl1678cspeXr+3ciRyqoRgj9RD/ONbJhhxFvt1cLBh+qwK2eqISfBb06eRnNeC71oBokDm3zyCnkOtMDGl7IvnMfZfEPFCfg5QgJVk1msPpRvQxmEsrX9MQRyFVzgy2CWNIb7c+jPapyrNwoUbANlN8adU1m6yOuoX7F49x+OjiG2se0EJ6nafeKUXw/+hiJZvELUYgzKUtMAZVTNZfT8jjb58j8GVtuS+6TM2AutbejaCV84ZK58E2CRJqhmjQibEUO6KPdD7oTlEkFy52Y1uOOBXgYpqMzufNPmfdqqqSM4dU70PO8ogyKGiLAIxCetMjjm6FCMEA3Kc8K0Ig7/XtFm9By6VxTJK1Mg36TlHaZKP6VzVLXMtesJECAwEAAQ==';
// try {
//     $publicKey = openssl_pkey_get_public("-----BEGIN PUBLIC KEY-----\n" . $public_key . "\n-----END PUBLIC KEY-----");
//     openssl_public_encrypt($key, $encrypted, $publicKey);
// } catch (\Throwable $th) {
//     echo openssl_error_string();
// }
// // echo $encrypted;
//         echo base64_encode($encrypted);
