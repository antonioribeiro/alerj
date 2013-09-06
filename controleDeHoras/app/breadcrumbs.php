<?php
//Breadcrumbs::setView('_partials/breadcrumbs');

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Funcionários', route('home'));
});

Breadcrumbs::register('funcionario.login', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login');
});

Breadcrumbs::register('funcionario.edit', function($breadcrumbs, $funcionario) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($funcionario->nome, route('funcionarios.frequency', $funcionario->id));
    $breadcrumbs->push('Ficha cadastral');
});

Breadcrumbs::register('funcionario.frequency', function($breadcrumbs, $funcionario) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($funcionario->nome, route('funcionarios.frequency', $funcionario->id));
});

Breadcrumbs::register('funcionario.expired', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Sessão expirada');
});

Breadcrumbs::register('horas.edit', function($breadcrumbs, $funcionario) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($funcionario->nome, route('funcionarios.frequency', $funcionario->id));
    $breadcrumbs->push('Editar Horário');
});

Breadcrumbs::register('reports.weekly', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Relatório Semanal', route('reports.weekly'));
});
