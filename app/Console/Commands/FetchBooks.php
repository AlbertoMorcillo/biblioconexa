<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchBooks extends Command
{
    protected $signature = 'fetch:books';
    protected $description = 'Fetch books from Open Library and store them in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Aquí va tu lógica del comando
    }
}