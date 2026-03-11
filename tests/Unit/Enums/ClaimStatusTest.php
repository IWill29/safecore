<?php

use App\Enums\ClaimStatus;

test('claim status enum has correct values', function () {
    // Pārbaudām, vai visi obligātie statusi eksistē (BAN bizness nevar bez tiem)
    expect(ClaimStatus::values())
        ->toBeArray()
        ->toContain('open', 'in_review', 'approved', 'rejected', 'closed');
});

test('claim status has localized labels', function () {
    // Pārbaudām, vai tulkojumi nav pazaudēti
    expect(ClaimStatus::OPEN->getLabel())->toBe('Jauns pieteikums')
        ->and(ClaimStatus::APPROVED->getLabel())->toBe('Apstiprināts');
});

test('claim status has correct filament colors', function () {
    // Pārbaudām, vai krāsas atbilst loģikai (zaļš apstiprinātam, sarkans noraidītam)
    expect(ClaimStatus::APPROVED->getColor())->toBe('success')
        ->and(ClaimStatus::REJECTED->getColor())->toBe('danger');
});

test('claim status can return array for validation', function () {
    // Pārbaudām helper funkciju, ko izmantosim migrations un requests
    $values = ClaimStatus::values();
    
    expect($values)->toHaveCount(5)
        ->and($values)->toContain('in_review');
});
