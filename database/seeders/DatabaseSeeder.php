<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Closure;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Textinfo;
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

        $this->command->warn(PHP_EOL . 'Creating About Us Page...');
        $aboutPage = Textinfo::create([
            'key'=>'page-about-us',
            'title'=>'About Us',
            'content'=>'<p>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Sed commodo accumsan arcu, nec vulputate sapien maximus nec. Morbi et nisl in nibh lobortis blandit. Nullam tincidunt accumsan lacus, at feugiat nunc placerat nec. Sed consequat turpis a ipsum tincidunt aliquam. Phasellus eu interdum velit, eu bibendum est. Etiam malesuada leo at pulvinar sollicitudin. Etiam ut iaculis metus. <strong><em>Quisque ac ipsum in odio sodales bibendum. Sed suscipit urna libero. Praesent a laoreet libero. Quisque mollis fermentum commodo. Pellentesque suscipit venenatis faucibus.</em></strong></p><p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque sit amet egestas ipsum, eget interdum lacus. Mauris sed tincidunt massa. Praesent congue tortor quam, sed cursus lectus aliquet id. Maecenas et pharetra nulla, vitae euismod neque. In feugiat elit felis, non tincidunt ex luctus a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In in varius urna, a rutrum tellus. Vestibulum dapibus mauris vitae maximus vulputate. Suspendisse non libero aliquam, cursus dolor a, imperdiet urna. Pellentesque vel vehicula felis.</p><p>Vivamus imperdiet posuere elit ut varius. Suspendisse semper diam eu ex varius lacinia. In ornare semper elementum. In cursus facilisis placerat. Quisque imperdiet libero vitae nisl dignissim pulvinar. Maecenas metus est, pulvinar nec leo sit amet, porttitor tristique urna. Curabitur at purus sed orci auctor tempus id eu ante. Sed lorem nibh, faucibus sed massa vitae, finibus gravida lectus. Donec eu elit turpis. Integer nec eros ut diam posuere blandit in sed nisi. Cras facilisis risus sit amet sodales luctus. Nam convallis malesuada aliquet. Morbi et sapien vulputate, rutrum metus sed, semper orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin imperdiet pretium erat, at iaculis elit vehicula non.</p><p>Mauris dolor diam, ultricies id enim quis, posuere aliquam ipsum. Maecenas et pharetra lorem, a ultricies risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque tempus orci nec lacus finibus semper. Morbi efficitur pellentesque magna, non dictum ex convallis sit amet. Nunc pellentesque pulvinar sem non porta. Nullam eu arcu in felis laoreet hendrerit. Vestibulum sagittis orci eu massa luctus consequat.</p><p>Aliquam dictum ultricies leo, sit amet convallis felis. Praesent faucibus nunc at nunc condimentum, quis pretium dui lobortis. Suspendisse faucibus vulputate augue, nec interdum leo venenatis vel. Sed eu molestie magna, nec convallis augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum aliquet dolor venenatis, mollis est tempus, ultricies ex. Nunc molestie leo vitae erat fermentum, in mattis lorem condimentum. Morbi sit amet elit nibh. Suspendisse dapibus ultrices nunc in pharetra. Mauris et tincidunt nibh, eu tincidunt mi. Cras feugiat dui a tellus varius varius.</p><p>Cras egestas lorem quis sodales convallis. Fusce vel est non libero vulputate interdum. Maecenas feugiat tellus in cursus varius. Maecenas at urna lorem. Vestibulum luctus imperdiet tortor, et laoreet felis iaculis sed. Quisque tempus, quam vel efficitur dictum, sem nulla hendrerit orci, id blandit nibh ex eget lorem. Donec risus nisl, viverra eget viverra eget, suscipit eu sem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed suscipit sagittis tellus eget consequat.</p><p>Vestibulum vel egestas velit. Aliquam in nisl sollicitudin, scelerisque mauris fermentum, ornare elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce laoreet pellentesque sapien, non bibendum ex eleifend ac. Curabitur enim sem, imperdiet eget tempor sit amet, sagittis laoreet magna. Mauris nec fringilla justo, sit amet consequat mi. Ut et sodales nulla, eget suscipit libero. Cras quam ipsum, tincidunt eget leo quis, egestas ultricies nisl. Suspendisse tempus sapien vitae nulla egestas ullamcorper. Nunc eros odio, iaculis vel ultricies vel, tempus sagittis magna. Maecenas eleifend est id magna rutrum, tincidunt mattis orci consectetur. Aenean gravida orci lacus, id mattis elit dapibus a.</p><p>Phasellus consectetur consequat fermentum. Vivamus egestas mauris eu purus fringilla efficitur eget vel nisi. Aenean non lacus pretium, commodo magna vel, sodales magna. Donec gravida laoreet ipsum, sit amet vestibulum mauris tempus vitae. Etiam scelerisque dictum ultricies. In sollicitudin neque sed tincidunt condimentum. Nam aliquet, justo et interdum porta, libero neque aliquet ligula, nec ornare nibh sapien quis nibh. Donec pulvinar quis enim id malesuada. Aliquam laoreet tortor at mauris venenatis, scelerisque tincidunt tortor dignissim. Phasellus congue justo et augue semper, ut accumsan ipsum suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent in placerat est. Aenean eleifend risus tortor, ut interdum elit elementum sed. Nam orci sem, malesuada interdum mattis a, gravida nec augue. Praesent consectetur mi consectetur, suscipit libero a, ultricies mauris.</p><p>Suspendisse sit amet libero nec purus varius auctor. Aenean a nulla id libero eleifend interdum ut at arcu. Proin finibus elit diam, eget iaculis tellus tempor sit amet. Sed vitae felis consectetur, molestie sapien tincidunt, sollicitudin magna. Quisque tincidunt nisl et elit aliquam faucibus. Curabitur euismod aliquet quam et accumsan. Fusce augue est, gravida sit amet sollicitudin viverra, vehicula at purus. Mauris ut tortor elit.</p><p>Cras fermentum mollis pretium. Praesent ut posuere ante. Donec accumsan est et erat imperdiet, quis porttitor dolor tempor. Vivamus non massa faucibus, pellentesque orci non, egestas tellus. Fusce diam velit, fringilla ac lacus egestas, vehicula efficitur urna. Donec a aliquet lacus. Mauris at suscipit purus. Quisque sed dolor porta metus laoreet consectetur at nec velit.</p>',
            'link'=>'',
            'image'=>'01HGFK7K7TYWWQR8P0ED633X1T.jpg',
            'active'=>1,
        ]);
        $this->command->info('About Us Page Created.');

        $this->command->warn(PHP_EOL . 'Creating About Us Widget...');
        $aboutWidget = Textinfo::create([
            'key'=>'footer-about-us',
            'title'=>'About Us',
            'content'=>'<p>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Sed commodo accumsan arcu, nec vulputate sapien maximus nec. Morbi et nisl in nibh lobortis blandit.</p>',
            'link'=>'/pages/about-us',
            'image'=>'',
            'active'=>1,
        ]);
        $this->command->info('About Us widget Created.');

        $this->command->warn(PHP_EOL . 'Creating Copyright Text...');
        $copyText = Textinfo::create([
            'key'=>'footer-copy-text',
            'title'=>config('app.name', 'Laravel'),
            'content'=>'© Copyright,2024. All Rights Reserved.',
            'link'=>url(''),
            'image'=>'',
            'active'=>1,
        ]);
        $this->command->info('Copyright Text Created.');

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
