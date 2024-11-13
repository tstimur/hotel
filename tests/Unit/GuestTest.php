<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\GuestController;
use libphonenumber\PhoneNumberUtil;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class GuestTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testGetCountryCodeFromValidPhone(): void
    {
        $mockPhoneUntil = $this->createMock(PhoneNumberUtil::class);

        $mockPhoneUntil->method('parse')
            ->willReturnSelf();

        $mockPhoneUntil->method('getRegionCodeForNumber')
            ->willReturn('RU');

        $controller = new GuestController();
        $reflectionMethod = new ReflectionMethod(GuestController::class, 'getCountryCode');
        $reflectionMethod->setAccessible(true);

        $countryCode = $reflectionMethod->invoke($controller, '+79295558899');

        $this->assertEquals('RU', $countryCode);
    }
}
