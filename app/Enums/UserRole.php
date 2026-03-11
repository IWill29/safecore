<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

/**
 * UserRole - BAN darbinieku lomas un piekļuves līmeņi.
 */
enum UserRole: string implements HasLabel, HasColor
{
    case ADMIN = 'admin';   // Sistēmas vadītājs (var visu)
    case AGENT = 'agent';   // Apdrošināšanas aģents (veido polises/pieteikumus)
    case VIEWER = 'viewer'; // Audits/Grāmatvedība (tikai lasīšanas režīms)

    /**
     * Helperis validācijai.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Lomu nosaukumi latviski Filament panelim.
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::ADMIN => 'Administrators',
            self::AGENT => 'Apdrošināšanas aģents',
            self::VIEWER => 'Skatītājs (Audits)',
        };
    }

    /**
     * Krāsas lomu badge vizualizācijai.
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ADMIN => 'danger',  // Sarkans (augsta prioritāte)
            self::AGENT => 'success', // Zaļš (aktīvs darbinieks)
            self::VIEWER => 'gray',    // Pelēks (ierobežots)
        };
    }
}
