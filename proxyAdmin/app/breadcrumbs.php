<?php

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Principal', URL::route('home'));
});

Breadcrumbs::register('login', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login');
});

Breadcrumbs::register('departamentos', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Departamentos', URL::route('departamentos'));
});

Breadcrumbs::register('departamento', function($breadcrumbs, $departamento) {
    $breadcrumbs->parent('departamentos');
    $breadcrumbs->push($departamento->nome_departamento, URL::route('departamento', [$departamento->codigo_departamento]));
});

Breadcrumbs::register('usuarios', function($breadcrumbs, $departamento) {
    $breadcrumbs->parent('departamentos');
    $breadcrumbs->push($departamento->nome_departamento, URL::route('usuarios', [$departamento->codigo_departamento]));
    $breadcrumbs->push('Usuários', URL::route('usuarios', [$departamento->codigo_departamento]));
});

Breadcrumbs::register('proxy', function($breadcrumbs) {
    $breadcrumbs->parent('departamentos');
    $breadcrumbs->push('Lista de Acessos');
});
