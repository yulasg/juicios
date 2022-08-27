<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();

        // Seed test admin
        $seededAdminEmail = 'admin@admin.com';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Admin',
                'first_name'                     => 'Germán',
                'last_name'                      => 'Santelli',
                'email'                          => $seededAdminEmail,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => '127.0.0.1',
                'admin_ip_address'               => '127.0.0.1',
            ]);

            $user->profile()->save($profile);
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed test user
        $user = User::where('email', '=', 'user@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'User',
                'first_name'                     => 'Thomas',
                'last_name'                      => 'Romero',
                'email'                          => 'user@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => '127.0.0.1',
                'signup_confirmation_ip_address' => '127.0.0.1',
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }
        

        $user = User::where('email', '=', 'gerente@gmail.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Gerente',
                'first_name'                     => 'Carmen',
                'last_name'                      => 'España',
                'email'                          => 'gerente@gmail.com',
                'password'                       => Hash::make('12345678'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => '127.0.0.1',
                'signup_confirmation_ip_address' => '127.0.0.1',
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }
        
        $user = User::where('email', '=', 'abogado@gmail.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Abogado',
                'first_name'                     => 'Franklin',
                'last_name'                      => 'Rubio',
                'email'                          => 'abogado@gmail.com',
                'password'                       => Hash::make('12345678'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => '127.0.0.1',
                'signup_confirmation_ip_address' => '127.0.0.1',
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }

        $user = User::where('email', '=', 'consulta@gmail.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Consulta',
                'first_name'                     => 'Rober',
                'last_name'                      => 'Garcia',
                'email'                          => 'consulta@gmail.com',
                'password'                       => Hash::make('12345678'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => '127.0.0.1',
                'signup_confirmation_ip_address' => '127.0.0.1',
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }

        $user = User::where('email', '=', 'mantenimiento@gmail.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Mantenimiento',
                'first_name'                     => 'Yoce',
                'last_name'                      => 'Valera',
                'email'                          => 'mantenimiento@gmail.com',
                'password'                       => Hash::make('12345678'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => '127.0.0.1',
                'signup_confirmation_ip_address' => '127.0.0.1',
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }

        $user = User::where('email', '=', 'especialidades@gmail.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'Especialidades',
                'first_name'                     => 'Germán',
                'last_name'                      => 'Santelli',
                'email'                          => 'especialidades@gmail.com',
                'password'                       => Hash::make('12345678'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => '127.0.0.1',
                'signup_confirmation_ip_address' => '127.0.0.1',
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }
        

        // Seed test users
        // $user = factory(App\Models\Profile::class, 5)->create();
        // $users = User::All();
        // foreach ($users as $user) {
        //     if (!($user->isAdmin()) && !($user->isUnverified())) {
        //         $user->attachRole($userRole);
        //     }
        // }
    }
}
