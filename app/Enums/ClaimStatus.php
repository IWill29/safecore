<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

/**
 * ClaimStatus - Apdrošināšanas atlīdzību lietu statusi.
 * Backed Enum nodrošina, ka datubāzē tiek glabāts string, bet kodā izmantojam objektu.
 */
enum ClaimStatus: string implements HasLabel, HasColor, HasIcon
{
    case OPEN = 'open';           // Jauns pieteikums (piem. klients tikko iesniedzis)
    case IN_REVIEW = 'in_review'; // Eksperts veic izpēti un tāmēšanu
    case APPROVED = 'approved';   // Lēmums par izmaksu pieņemts
    case REJECTED = 'rejected';   // Atlīdzība noraidīta (nav apdrošināšanas gadījums)
    case CLOSED = 'closed';       // Lieta pabeigta un arhivēta

    /**
     * Helperis: Atgriež visus statusu stringus.
     * Noder validācijai: Rule::in(ClaimStatus::values())
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Filament HasLabel: Teksts, ko redzēs BAN darbinieks saskarnē.
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::OPEN => 'Jauns pieteikums',
            self::IN_REVIEW => 'Izskatīšanā',
            self::APPROVED => 'Apstiprināts',
            self::REJECTED => 'Noraidīts',
            self::CLOSED => 'Slēgts',
        };
    }

    /**
     * Filament HasColor: Statusa krāsa (Badge).
     * Nodrošina ātru vizuālo atpazīstamību.
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OPEN => 'info',      // Zila
            self::IN_REVIEW => 'warning', // Oranža
            self::APPROVED => 'success', // Zaļa
            self::REJECTED => 'danger',  // Sarkana
            self::CLOSED => 'gray',      // Pelēka
        };
    }

    /**
     * Filament HasIcon: Ikona blakus statusa tekstam.
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::OPEN => 'heroicon-m-sparkles',
            self::IN_REVIEW => 'heroicon-m-arrow-path',
            self::APPROVED => 'heroicon-m-check-circle',
            self::REJECTED => 'heroicon-m-x-circle',
            self::CLOSED => 'heroicon-m-archive-box',
        };
    }
}
