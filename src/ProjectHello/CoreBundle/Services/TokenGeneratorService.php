<?php

namespace ProjectHello\CoreBundle\Services;

class TokenGeneratorService
{
    /**
     * Initialize service class
     */
    public function __construct()
    {

    }

    /**
     * Encrypts parameters in array format as hashed string
     *
     * @param array $parameters The values to encrypt
     *
     * @return hashed string
     */
    public function getEncryptedToken($parameters = array())
    {
        $key = $this->getKey();
        $string = $this->formatParameters($parameters);

        return base64_encode(mcrypt_encrypt(
            MCRYPT_RIJNDAEL_256,
            md5($key),
            $string,
            MCRYPT_MODE_CBC,
            md5(md5($key))
        ));
    }

    /**
     * Decrypts a token into a readable format
     *
     * @param string $token The hashed string to decrypt
     *
     * @return string
     */
    public function getDecryptedToken($token = '')
    {
        if (!empty($token)) {
            $key = $this->getKey();

            return rtrim(mcrypt_decrypt(
                MCRYPT_RIJNDAEL_256,
                md5($key),
                base64_decode($token),
                MCRYPT_MODE_CBC,
                md5(md5($key))
            ), "\0");
        }

        return $token;
    }

    /**
     * Formats an array of parameters as string that will later on be encrypted as hashed string
     *
     * @param array $parameters The array of parameters to format
     *
     * @return string
     */
    private function formatParameters($parameters = array())
    {
        $stringParam = '';

        $i = 0;
        foreach ($parameters as $each => $value) {
            $i++;
            $stringParam .= $each.'='.$value;

            if ($i < count($parameters)) {
                $stringParam .= '&';
            }
        }

        return $stringParam;
    }

    /**
     * Returns a custom-set private key
     *
     * @return string
     */
    private function getKey()
    {
        return 'this is a very sensitive data';
    }
}