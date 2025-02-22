<?php

declare(strict_types=1);

namespace Jose\Performance\JWS;

use Jose\Component\Core\JWK;
use Jose\Component\Signature\Algorithm\SignatureAlgorithm;
use Override;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(4096)
 * @Groups({"JWS", "EdDSA", "Ed25519"})
 */
final class EdDSABench extends SignatureBench
{
    public function dataSignature(): array
    {
        return [
            [
                'algorithm' => 'EdDSA',
            ],
        ];
    }

    public function dataVerification(): array
    {
        return [
            [
                'input' => 'eyJhbGciOiJFZERTQSJ9.SXTigJlzIGEgZGFuZ2Vyb3VzIGJ1c2luZXNzLCBGcm9kbywgZ29pbmcgb3V0IHlvdXIgZG9vci4gWW91IHN0ZXAgb250byB0aGUgcm9hZCwgYW5kIGlmIHlvdSBkb24ndCBrZWVwIHlvdXIgZmVldCwgdGhlcmXigJlzIG5vIGtub3dpbmcgd2hlcmUgeW91IG1pZ2h0IGJlIHN3ZXB0IG9mZiB0by4.zwhKxTMnLVgl0KSn9GT2ongThN0hOZkp046k3S296_TKwAXZH3n4OGMavgUgmuhXER3_zRz-nBqJMfUDIoRHBQ',
            ],
        ];
    }

    public function dataVerify(): array
    {
        return [
            [
                'signature' => 'zwhKxTMnLVgl0KSn9GT2ongThN0hOZkp046k3S296_TKwAXZH3n4OGMavgUgmuhXER3_zRz-nBqJMfUDIoRHBQ',
            ],
        ];
    }

    #[Override]
    protected function getAlgorithm(): SignatureAlgorithm
    {
        return $this->getSignatureAlgorithmsManager()
            ->get('EdDSA')
        ;
    }

    #[Override]
    protected function getInput(): string
    {
        return 'eyJhbGciOiJFZERTQSJ9.SXTigJlzIGEgZGFuZ2Vyb3VzIGJ1c2luZXNzLCBGcm9kbywgZ29pbmcgb3V0IHlvdXIgZG9vci4gWW91IHN0ZXAgb250byB0aGUgcm9hZCwgYW5kIGlmIHlvdSBkb24ndCBrZWVwIHlvdXIgZmVldCwgdGhlcmXigJlzIG5vIGtub3dpbmcgd2hlcmUgeW91IG1pZ2h0IGJlIHN3ZXB0IG9mZiB0by4';
    }

    #[Override]
    protected function getPrivateKey(): JWK
    {
        return new JWK([
            'kty' => 'OKP',
            'crv' => 'Ed25519',
            'd' => 'nWGxne_9WmC6hEr0kuwsxERJxWl7MmkZcDusAxyuf2A',
            'x' => '11qYAYKxCrfVS_7TyWQHOg7hcvPapiMlrwIaaPcHURo',
        ]);
    }

    #[Override]
    protected function getPublicKey(): JWK
    {
        return $this->getPrivateKey()
            ->toPublic()
        ;
    }
}
