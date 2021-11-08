<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

interface DTOBuilderInterface
{
    public function build(string $fileTemplatePath, string $dirOutputPath, string $className, string $namespace): void;

    public function buildFromArray(array $data, string $dirOutputPath, string $className, string $namespace): void;
}
