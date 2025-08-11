<?php

namespace WeeWorxxSDK\SharedResources\SDK\Console\Config;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\PayFactory;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Factories\SkillsFactory;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders\CompanySeeder;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders\PostSeeder;
use WeeWorxxSDK\SharedResources\Modules\Post\Database\Seeders\PostStatusesSeeder;
use WeeWorxxSDK\SharedResources\Modules\User\Database\Seeders\UserSeeder;
use WeeWorxxSDK\SharedResources\Modules\User\Database\Seeders\UserTypeSeeder;

class ResetTestData extends ModularResetTestDataCommand
{
    protected $signature = 'ww:reset 
        {--testonly : Refreshed only the test data and exclude stable data.}';
    protected $description = 'Restart all test data.';

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);
    }

    protected function process(): array
    {
        return [
            UserTypeSeeder::class,
            PostStatusesSeeder::class,
            PostSeeder::class,
            UserSeeder::class,
        ];
    }

    protected function commandType(): string
    {
        return 'reset';
    }
}
