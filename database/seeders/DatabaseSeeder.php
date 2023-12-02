<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Closure;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Tags\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $adminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'name'  =>  'Admin User',
            'password' => bcrypt( 'admin123' ),
        ]);
        $this->command->info('Admin user created.');
        
        $this->command->warn(PHP_EOL . 'Creating user...');
        $testUser = User::factory()->create([
            'email' => 'test@example.com',
            'name'  =>  'Test User',
            'password' => bcrypt( 'password' ),
        ]);
        $this->command->info('User created.');
        
        $this->command->warn(PHP_EOL . 'Creating New Role...');
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $this->command->info('Role created.');

        $this->command->warn(PHP_EOL . 'Assigning Roles...');
        $adminUser->assignRole($adminRole);
        $testUser->assignRole($userRole);
        $this->command->info('Role Assigned.');
        
        $this->command->warn(PHP_EOL . 'Creating few more Dummy User...');
        $users = User::factory(20)->create();
        foreach($users as $user){
            $user->assignRole('user');
        }
        $this->command->info('Dummy User Created.');
        
        $this->command->warn(PHP_EOL . 'Posting Some Dummy Data');
        Category::factory(20)->create();
        $posts = Post::factory(20)->create();
        foreach($posts as $post){
            Tag::findOrCreate(['test', 'jit']);
            $post->attachTags(['test', 'jit']);
        }

        Comment::factory(20)->create();
        $this->command->info('Dummy Data Seeded.');

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
