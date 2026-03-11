<?php

use App\Enums\PolicyStatus;

test('policy status enum has correct values', function () {
    // Pārbaudām, vai visi BAN nepieciešamie statusi eksistē
    expect(PolicyStatus::values())
        ->toBeArray()
        ->toContain('draft', 'active', 'expired', 'cancelled');
});

test('policy status has correct labels in latvian', function () {
    // Pārbaudām, vai tulkojumi darbiniekiem ir pareizi
    expect(PolicyStatus::DRAFT->getLabel())->toBe('Melnraksts')
        ->and(PolicyStatus::ACTIVE->getLabel())->toBe('Aktīva')
        ->and(PolicyStatus::EXPIRED->getLabel())->toBe('Beigusies')
        ->and(PolicyStatus::CANCELLED->getLabel())->toBe('Anulēta');
});

test('policy status has correct filament colors', function () {
    // Aktīvai jābūt zaļai, anulētai sarkanai (standarts)
    expect(PolicyStatus::ACTIVE->getColor())->toBe('success')
        ->and(PolicyStatus::CANCELLED->getColor())->toBe('danger')
        ->and(PolicyStatus::EXPIRED->getColor())->toBe('warning');
});

test('policy status has assigned heroicons', function () {
    // Pārbaudām, vai ikonas ir piešķirtas (Filament UI)
    expect(PolicyStatus::ACTIVE->getIcon())->toBe('heroicon-m-check-badge')
        ->and(PolicyStatus::DRAFT->getIcon())->toContain('pencil');
});
