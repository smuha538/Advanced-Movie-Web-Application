<?php

return [
  'database' => [
    'name' => $_ENV['DATABASE_NAME'] ?? 'movies',
    'user' => $_ENV['DATABASE_USER'] ?? 'root',
    'password' => $_ENV['DATABASE_PASSWORD'] ?? '7as4DCGnJAC4Hn2B',
    'connection' => $_ENV['DATABASE_CONNECTION'] ?? 'mysql:host=34.130.185.250'
  ]
];
