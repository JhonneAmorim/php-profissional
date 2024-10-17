<?php
return [
    '/' => 'home@index',
    '/user/create' => 'user@create',
    '/user/[a-z0-9]+' => 'user@index',
];
