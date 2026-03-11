<?php

use App\Enums\UserRole;

test('user role enum has correct values', function () {
    // Pārbaudām, vai visas BAN definētās lomas eksistē
    expect(UserRole::values())
        ->toBeArray()
        ->toHaveCount(3)
        ->toContain('admin', 'agent', 'viewer');
});

test('user role has correct labels for latvian interface', function () {
    // Pārbaudām, vai tulkojumi darbinieku panelim ir precīzi
    expect(UserRole::ADMIN->getLabel())->toBe('Administrators')
        ->and(UserRole::AGENT->getLabel())->toBe('Apdrošināšanas aģents')
        ->and(UserRole::VIEWER->getLabel())->toBe('Skatītājs (Audits)');
});

test('user role has correct filament colors', function () {
    // Adminam jābūt pamanāmam (sarkanam), skatītājam neitrālam
    expect(UserRole::ADMIN->getColor())->toBe('danger')
        ->and(UserRole::VIEWER->getColor())->toBe('gray')
        ->and(UserRole::AGENT->getColor())->toBe('success');
});

test('user role can return values for validation', function () {
    // Šo izmantosim, kad reģistrēsim jaunus darbiniekus
    $values = UserRole::values();
    
    expect($values)->toContain('admin')
        ->and($values)->not->toContain('super-user');
});
