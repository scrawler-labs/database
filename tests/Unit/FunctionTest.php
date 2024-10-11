<?php

beforeEach(function (): void {
    db()->getConnection()->executeStatement('DROP TABLE IF EXISTS user; ');
    db()->getConnection()->executeStatement('DROP TABLE IF EXISTS employee; ');
    db()->unfreeze();
});

it('checks model function', function (): void {
    $user = model('user');
    expect($user)->toBeInstanceOf(Scrawler\Arca\Model::class);
    expect($user->getName())->toBe('user');
});

it('checks table_exists function', function (): void {
    $user = model('user');
    $user->name = 'John Doe';
    $user->email = 'john@test.com';
    $user->save();

    $emp = model('employee');
    $emp->name = 'Jane Doe';
    $emp->save();

    expect(table_exists('user'))->toBeTrue();
});

it('checks tables_exist function', function (): void {
    $user = model('user');
    $user->name = 'John Doe';
    $user->email = 'john@test.com';
    $user->save();

    $emp = model('employee');
    $emp->name = 'Jane Doe';
    $emp->save();

    expect(tables_exist(['user', 'employee']))->toBeTrue();
});
