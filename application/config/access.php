<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['delimiter'] = ',';
$config['menu'] = [
    'dashboard' => [
        'index'  => 'index',
        'action' => ['index', 'detail', 'create', 'update', 'delete'],
    ],
    'users' => [
        'index'  => 'index',
        'action' => ['index', 'detail', 'create', 'update', 'delete'],
    ],
    'group' => [
        'index'  => 'index',
        'action' => ['index', 'detail', 'create', 'update', 'delete'],
    ],
    'user-access' => [
        'index'  => 'index',
        'action' => ['index', 'detail', 'create', 'update', 'delete'],
    ],
];