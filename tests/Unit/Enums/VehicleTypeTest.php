<?php

namespace Tests\Unit\Enums;

use App\Enums\VehicleType;
use Tests\TestCase;

class VehicleTypeTest extends TestCase
{
    /**
     * Pārbauda, vai Enum satur visas 8 Latvijas tirgum specifiskās kategorijas.
     */
    public function test_vehicle_type_enum_has_all_latvian_market_values(): void
    {
        $values = VehicleType::values();

        $this->assertIsArray($values);
        $this->assertCount(8, $values); // Tagad mums ir 8 kategorijas
        
        // Pārbaudām pamata grupu
        $this->assertContains('car', $values);
        $this->assertContains('truck', $values);
        $this->assertContains('motorcycle', $values);
        $this->assertContains('bus', $values);
        
        // Pārbaudām Latvijas specifiku
        $this->assertContains('trailer', $values);
        $this->assertContains('tractor', $values);
        $this->assertContains('special', $values);
        $this->assertContains('scooter', $values);
    }

    /**
     * Pārbauda, vai angļu valodas nosaukumi (labels) ir pareizi definēti.
     */
    public function test_vehicle_type_has_correct_english_labels(): void
    {
        $this->assertEquals('Passenger Car', VehicleType::CAR->getLabel());
        $this->assertEquals('Trailer', VehicleType::TRAILER->getLabel());
        $this->assertEquals('Electric Scooter', VehicleType::SCOOTER->getLabel());
        $this->assertEquals('Tractor / Agricultural', VehicleType::TRACTOR->getLabel());
    }

    /**
     * Pārbauda, vai Enum vērtības atbilst "Backed Enum" string tipam.
     */
    public function test_vehicle_type_values_are_strings(): void
    {
        foreach (VehicleType::cases() as $case) {
            $this->assertIsString($case->value);
        }
    }
}
