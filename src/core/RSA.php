<?php

class RSA
{
    private string|false $publicKey;
    private string|false $privateKey;

    public function __construct($publicKeyPath, $privateKeyPath)
    {
        if (file_exists($publicKeyPath) && file_exists($privateKeyPath)) {
            $this->publicKey = file_get_contents($publicKeyPath);
            $this->privateKey = file_get_contents($privateKeyPath);
        } else {
            $this->generateKeys();
            $this->saveKeysToFile($publicKeyPath, $privateKeyPath);
        }
    }

    public function generateKeys($bits = 2048): void
    {
        $config = array(
            "private_key_bits" => $bits,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        $res = openssl_pkey_new($config);

        openssl_pkey_export($res, $privateKey);

        $this->privateKey = $privateKey;
        $this->publicKey = openssl_pkey_get_details($res)['key'];
    }

    private function saveKeysToFile($publicKeyPath, $privateKeyPath): void
    {
        file_put_contents($publicKeyPath, $this->publicKey);
        file_put_contents($privateKeyPath, $this->privateKey);
    }

    public function encrypt($data): string
    {
        openssl_public_encrypt($data, $encrypted, $this->publicKey);
        return base64_encode($encrypted);
    }

    public function decrypt($data): string
    {
        $encrypted = base64_decode($data);
        openssl_private_decrypt($encrypted, $decrypted, $this->privateKey);
        return $decrypted;
    }

    public function verify($input, $hashed): bool
    {
        $decrypted = $this->decrypt($hashed);
        return $decrypted === $input;
    }
}