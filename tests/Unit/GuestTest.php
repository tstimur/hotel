<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\GuestController;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionMethod;

class GuestTest extends TestCase
{
    /**
     * Test getCountryCode method with valid phone number.
     *
     * @return void
     * @throws Exception
     * @throws ReflectionException
     */
    public function testGetCountryCodeFromValidPhone(): void
    {
        $mockPhoneUtil = $this->createMock(PhoneNumberUtil::class);

        $mockPhoneUtil->method('parse')
            ->willReturnSelf();

        $mockPhoneUtil->method('getRegionCodeForNumber')
            ->willReturn('RU');

        $controller = new GuestController();
        $reflectionMethod = new ReflectionMethod(GuestController::class, 'getCountryCode');
        $reflectionMethod->setAccessible(true);

        $countryCode = $reflectionMethod->invoke($controller, '+79295558899');

        $this->assertEquals('RU', $countryCode);
    }

    /**
     * Test getCountryCode method with invalid phone number.
     *
     * @return void
     * @throws Exception
     * @throws ReflectionException
     */
    public function testGetCountryCodeWithInvalidPhoneNumber(): void
    {
        $phoneNumber = 'invalid-phone';

        $mockPhoneUtil = $this->createMock(PhoneNumberUtil::class);
        $mockPhoneUtil->method('parse')
            ->willThrowException(new NumberParseException(
                NumberParseException::NOT_A_NUMBER,
                'Invalid phone number format'
            ));

        $controller = new GuestController();
        $reflectionMethod = new ReflectionMethod(GuestController::class, 'getCountryCode');
        $reflectionMethod->setAccessible(true);

        $response = $reflectionMethod->invoke($controller, $phoneNumber);

        $this->assertEquals([
            'status' => false,
            'message' => 'Invalid phone number'
        ],
            $response
        );
    }
}
