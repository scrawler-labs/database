<?php

test('calling function without connection throws error', function (): void {
    db()->get('users');
})->throws(Exception::class, 'Database connection not established please use db()->connect()');

test('tests connect() function', function (): void {
    db()->connect([
        'dbname' => 'test_database',
        'user' => 'admin',
        'password' => 'rootpass',
        'host' => '127.0.0.1',
        'driver' => 'pdo_mysql',
        'useUUID' => false,
    ]);
    $user = db()->create('user');
    $user->name = 'John Doe';
    $user->email = 'johndoe@test.com';
    $user->save();
    expect($user->id)->toBeInt();
});

test('tests saveRequest() function', function (): void {
    $_POST['name'] = 'John Doe';
    $_POST['email'] = 'john@test.com';
    $_POST['csrf'] = '1234';
    $id = db()->saveRequest('user');

    expect($id)->toBeInt();
    $model = db()->getOne('user', $id);
    print_r($model->toArray());
    expect($model->name)->toBe('John Doe');
});

test('tests bindRequest() function', function (): void {
    $_POST['name'] = 'John Doe';
    $_POST['email'] = 'john@test.com';
    $_POST['csrf'] = '1234';
    $model = db()->bindRequest('user');

    expect($model)->toBeInstanceOf(Scrawler\Arca\Model::class);
    expect($model->name)->toBe('John Doe');
    expect($model->email)->toBe('john@test.com');
});
