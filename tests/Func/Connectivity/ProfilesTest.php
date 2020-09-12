<?php


namespace Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Profiles;
use MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity\AbstractTest;

class ProfilesTest extends AbstractTest
{
    /**
     * @var Profiles
     */
    private $profiles;

    public function setUp(): void
    {
        parent::setUp();
        $this->profiles = new Profiles($this->requestManager);
    }

    public function testListProfilesRaw()
    {
        $raw = $this->profiles->listProfilesRaw(true);

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"user_id":', $raw);
        self::assertStringContainsString('"name":', $raw);
        self::assertStringContainsString('"active":', $raw);
        self::assertStringContainsString('"is_default":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
    }

    public function testListProfiles()
    {
        $profiles = $this->profiles->listProfiles(true);

        self::assertIsString($profiles[0]->getId());
        self::assertIsString($profiles[0]->getName());
        self::assertIsString($profiles[0]->getUserId());
        self::assertInstanceOf(\DateTimeInterface::class, $profiles[0]->getCreatedAt());
        self::assertIsBool($profiles[0]->isActive());
        self::assertIsBool($profiles[0]->isDefault());
    }

    public function testGetProfileRaw()
    {
        $profiles = $this->profiles->listProfiles(true);
        $raw = $this->profiles->getProfileRaw($profiles[0]->getId());

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"user_id":', $raw);
        self::assertStringContainsString('"name":', $raw);
        self::assertStringContainsString('"active":', $raw);
        self::assertStringContainsString('"is_default":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
    }

    public function testGetProfile()
    {
        $profiles = $this->profiles->listProfiles(true);
        $profile = $this->profiles->getProfile($profiles[0]->getId());

        self::assertIsString($profile->getId());
        self::assertIsString($profile->getName());
        self::assertIsString($profile->getUserId());
        self::assertInstanceOf(\DateTimeInterface::class, $profile->getCreatedAt());
        self::assertIsBool($profile->isActive());
        self::assertIsBool($profile->isDefault());
    }

    private function providerDefaultAndOtherProfile()
    {
        $default = $other = null;
        $profiles = $this->profiles->listProfiles(true);

        foreach ($profiles as $profile) {
            if ($profile->isDefault() && !$default) {
                $default = $profile;
            }
            if (!$profile->isDefault() && !$other) {
                $other = $profile;
            }
            if ($default && $other) {
                break;
            }
        }

        return [$default, $other];
    }

    public function testCreateProfileTransferRaw()
    {
        list($default, $other) = $this->providerDefaultAndOtherProfile();

        if (!$default || !$other) {
            $this->markTestIncomplete(
                'Data is missing for test'
            );
        }

        $raw = $this->profiles->createProfileTransferRaw($default->getId(), $other->getId(), 'USD', 15);

        self::assertStringContainsString('OK', $raw);
    }

    public function testCreateProfileTransfer()
    {
        list($default, $other) = $this->providerDefaultAndOtherProfile();

        if (!$default || !$other) {
            $this->markTestIncomplete(
                'Data is missing for test'
            );
        }

        $bool = $this->profiles->createProfileTransfer($default->getId(), $other->getId(), 'USD', 15);

        self::assertTrue($bool);
    }
}
