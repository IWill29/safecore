<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * VehicleType - Apdrošināmo objektu klasifikācija atbilstoši Latvijas tirgum.
 * Šis Enum definē galvenās kategorijas OCTA/KASKO polisēm.
 */
enum VehicleType: string implements HasLabel
{
    // Pamata kategorijas
    case CAR = 'car';               // Vieglais auto
    case TRUCK = 'truck';           // Kravas auto
    case MOTORCYCLE = 'motorcycle'; // Motocikls/Mopēds
    case BUS = 'bus';               // Autobuss
    
    // Latvijas specifikas kategorijas
    case TRAILER = 'trailer';       // Piekabes un puspiekabes
    case TRACTOR = 'tractor';       // Lauksaimniecības tehnika (traktori)
    case SPECIAL = 'special';       // Speciālā tehnika (ekskavatori utt.)
    case SCOOTER = 'scooter';       // Elektroskūteri (jauna riska grupa LV)

    /**
     * Helperis, kas atgriež visas enum vērtības masīvā.
     * Noder datubāzes migrācijām un validācijai.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Nosaukums, ko redzēs lietotājs saskarnē (angļu valodā).
     * BAN sistēmā šie teksti vēlāk tiek tulkoti caur lokalizācijas failiem.
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::CAR => 'Passenger Car',
            self::TRUCK => 'Truck',
            self::MOTORCYCLE => 'Motorcycle',
            self::BUS => 'Bus',
            self::TRAILER => 'Trailer',
            self::TRACTOR => 'Tractor / Agricultural',
            self::SPECIAL => 'Special Machinery',
            self::SCOOTER => 'Electric Scooter',
        };
    }
}
