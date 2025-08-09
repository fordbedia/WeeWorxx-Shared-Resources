<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Benefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\PostBenefits;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\PostSkills;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Skills;
use WeeWorxxSDK\SharedResources\SDK\Database\MakeSeeder;

class PostSeeder extends MakeSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()
            ->count(100)
            ->create();
        // Skills
        foreach($this->skills() as $skill) {
            Skills::create([
                'name' => $skill,
                'identifier' => Str::snake($skill),
            ]);
        }
        PostSkills::factory()->count(100)->create();
        foreach($this->benefits() as $benefit) {
            Benefits::create([
                'name' => $benefit,
                'identifier' => Str::snake($benefit),
            ]);
        }
        PostBenefits::factory()->count(100)->create();
    }

    /**
     * Revert the database seeds.
     */
    public function revert(): void
    {
        Schema::disableForeignKeyConstraints();
        Post::where('is_test', 1)->delete();
        Skills::truncate();
        PostSkills::truncate();
        Benefits::truncate();
        PostBenefits::truncate();
        DB::statement('ALTER TABLE posts AUTO_INCREMENT = 1');
        Schema::enableForeignKeyConstraints();
    }

    protected function skills(): array
    {
        return [
            'PHP', 'Python', 'JavaScript', 'TypeScript',
            'React', 'Vue', 'Angular',
            'Docker', 'Kubernetes', 'AWS',
            'MySQL', 'PostgreSQL', 'Redis',
        ];
    }

    protected function benefits(): array
    {
        return [
            '401(k)', 'Paid time off', 'Vision insurance', 'Dental insurance',
            'Disability insurance', 'Happy hour', 'Passion Friday',
            'Free Friday', 'PTO', 'AWS',
        ];
    }
}
