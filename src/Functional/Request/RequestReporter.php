<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Request;

use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestReporterInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

/**
 * @codeCoverageIgnore
 */
class RequestReporter implements RequestReporterInterface
{
    const VALID_NAMESPACE_PATTERN = '#[a-z0-9_/-]#i';

    /**
     * @var string
     */
    private $pathToRecord;

    public function __construct(string $pathToRecord)
    {
        try {
            if (!(is_dir($pathToRecord) && is_writable($pathToRecord))) {
                throw new ApiError(sprintf('Path %s passed to RequestInspector must be a directory and writable', $pathToRecord));
            }
        } catch (ApiError $exception) {
            mkdir($pathToRecord, 0777, true);
            if (!file_exists($pathToRecord)) {
                throw new ApiError(sprintf('Failed to create %s path', $pathToRecord), $exception->getCode(), $exception);
            }
        }
        $this->pathToRecord = $pathToRecord;
    }

    public function recordRequestData(string $data, string $namespace): void
    {
        $namespace = ltrim($namespace, '/');

        try {
            $json = Json::encode(Json::decode($data, true), JSON_PRETTY_PRINT);
        } catch (\Throwable $exception) {
            return;
        }
        if (!preg_match(self::VALID_NAMESPACE_PATTERN, $namespace)) {
            throw new ApiError(sprintf('Invalid namespace, given %s, but must match %s', $namespace, self::VALID_NAMESPACE_PATTERN));
        }
        $dirToRecord = $this->pathToRecord.DIRECTORY_SEPARATOR.$namespace;
        if (!file_exists($dirToRecord)) {
            try {
                mkdir($dirToRecord, 0777, true);
            } catch (\Throwable $exception) {
                if (!file_exists($dirToRecord)) {
                    throw new ApiError(sprintf('Failed to create %s path', $dirToRecord));
                }
            }
        }
        file_put_contents($dirToRecord.DIRECTORY_SEPARATOR.(microtime(true) * 10000).'.json', $json);
    }
}
