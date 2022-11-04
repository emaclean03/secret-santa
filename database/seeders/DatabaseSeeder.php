<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Participant;
use App\Models\SecretList;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create(['email' => 'emaclean03@aol.com']);
        $list = SecretList::factory()->create(['has_been_drawn'=>false, 'list_budget'=> 50]);
        User::findOrFail($user->id)->SecretList()->attach($list);
        Participant::factory(5)->create(['secret_list_id'=>$list->id]);
    }
}
