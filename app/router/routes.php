<?php
return [
    '/' => 'home@index',
    '/user/create' => 'user@create',
    '/user/[0-9]+' => 'user@index',
    '/user/[0-9]+/name/[a-z]+' => 'user@show',
];
