<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Blog
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Usuarios', url('users'));
});

// Home > Blog > create
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users');
    $trail->push('Nuevo usuario', url('users.create'));
});

// Home > Blog > [Category]
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users');
    $trail->push('Editar '.$user->name, url('users.edit', $user));
});

// Afiliados
Breadcrumbs::for('afiliados', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Afiliados', url('afiliados'));
});
Breadcrumbs::for('afiliados.create', function (BreadcrumbTrail $trail) {
    $trail->parent('afiliados');
    $trail->push('Nuevo afiliado', url('afiliados.create'));
});
Breadcrumbs::for('afiliados.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('afiliados');
    $trail->push('Editar '.$user->name, url('afiliados.edit', $user));
});