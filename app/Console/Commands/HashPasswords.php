<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HashPasswords extends Command
{
    protected $signature = 'users:hash-passwords';
    protected $description = 'Hash passwords for users in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (strlen($user->password) !== 60 || strpos($user->password, '$2y$') !== 0) {
                $user->password = Hash::make($user->password);
                $user->save();
            
                $this->info("Contraseña para el usuario {$user->id} actualizada.");
            }
        }

        $this->info('Todas las contraseñas han sido actualizadas.');
    }
}
