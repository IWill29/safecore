<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

/**
 * PolicyStatus - BAN apdrošināšanas polišu dzīves cikla statusi.
 */
enum PolicyStatus: string implements HasLabel, HasColor, HasIcon
{
    case DRAFT = 'draft';         // Polise tiek sagatavota (cenas kalkulācija)
    case ACTIVE = 'active';       // Polise ir apmaksāta un ir spēkā
    case EXPIRED = 'expired';     // Polises termiņš ir beidzies (pagātne)
    case CANCELLED = 'cancelled'; // Polise anulēta pirms termiņa (piem. auto pārdošana)

    /**
     * Helperis validācijai un DB migrācijām.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Teksts, ko BAN darbinieks redzēs sarakstā.
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::DRAFT => 'Melnraksts',
            self::ACTIVE => 'Aktīva',
            self::EXPIRED => 'Beigusies',
            self::CANCELLED => 'Anulēta',
        };
    }

    /**
     * Krāsas Filament badge komponentam.
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DRAFT => 'gray',      // Neitrāls
            self::ACTIVE => 'success',  // Zaļš (viss kārtībā)
            self::EXPIRED => 'warning', // Oranžs (jāpiedāvā jauna)
            self::CANCELLED => 'danger',// Sarkans (pārtraukta)
        };
    }

    /**
     * Ikona ātrai vizuālai atpazīšanai.
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::DRAFT => 'heroicon-m-pencil-square',
            self::ACTIVE => 'heroicon-m-check-badge',
            self::EXPIRED => 'heroicon-m-clock',
            self::CANCELLED => 'heroicon-m-no-symbol',
        };
    }
}
