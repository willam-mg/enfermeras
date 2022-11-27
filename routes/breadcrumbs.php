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
Breadcrumbs::for('afiliados.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('afiliados');
    $trail->push('Editar '.$model->name, url('afiliados.edit', $model));
});
Breadcrumbs::for('afiliados.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('afiliados');
    $trail->push('Ver '.$model->name, url('afiliados.show', $model));
});

// Aportes
Breadcrumbs::for('aportes', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Aportes', url('aportes'));
});
Breadcrumbs::for('aportes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('aportes');
    $trail->push('Nuevo aporte', url('aportes.create'));
});
Breadcrumbs::for('aportes.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('aportes');
    $trail->push('Editar '.$model->gestion, url('aportes.edit', $model));
});
Breadcrumbs::for('aportes.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('aportes');
    $trail->push('Ver '.$model->gestion, url('aportes.show', $model));
});

// Pagos
Breadcrumbs::for('pagos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pagos', url('pagos'));
});
Breadcrumbs::for('pagos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('pagos');
    $trail->push('Nuevo pago', url('pagos.create'));
});
Breadcrumbs::for('pagos.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('pagos');
    $trail->push('Editar '.$model->fecha, url('pagos.edit', $model));
});
Breadcrumbs::for('pagos.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('pagos');
    $trail->push('Ver '.$model->fecha, url('pagos.show', $model));
});

// Obsequios
Breadcrumbs::for('obsequios', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Obsequios', url('obsequios'));
});
Breadcrumbs::for('obsequios.create', function (BreadcrumbTrail $trail) {
    $trail->parent('obsequios');
    $trail->push('Nuevo obsequio', url('obsequios.create'));
});
Breadcrumbs::for('obsequios.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('obsequios');
    $trail->push('Editar '.$model->fecha, url('obsequios.edit', $model));
});
Breadcrumbs::for('obsequios.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('obsequios');
    $trail->push('Ver '.$model->fecha, url('obsequios.show', $model));
});