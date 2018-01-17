<?php

namespace App\Command;

use App\Base\Command;
use App\Model\UserModel;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class UserGivePermissionCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UserGivePermissionCommand extends Command
{

    public function arguments(): array
    {
        return [
            ['username', InputArgument::REQUIRED, 'The user who you wish to assing permissions to.'],
            ['permissions', InputArgument::OPTIONAL, 'The names of the permissions you wish to assign to the user.']
        ];
    }

    public function description(): string
    {
        return '';
    }

    public function handle()
    {
        // 
        $username = $this->argument('username');
        if (!$user = UserModel::where('username', $username)->first()) {
            return $this->error('User not found');
        }

        // 
        if ($this->option('all')) {
            $user->giveAllPermissions();
            return $this->info('All permissions granted');
        }

        // 
        if (!$permissions = array_filter(array_map('trim', explode(',', $this->argument('permissions'))))) {
            return $this->question(sprintf('Please state which permissions you wish to assign to %s!', $username));
        }

        // 
        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                $this->comment(sprintf('%s already has permission to %s!', $username, strtolower($permission)));
            } elseif (!$user->givePermission($permission)) {
                $this->error(sprintf('Could not assign permission "%s" to %s!', strtolower($permission), $username));
            } else {
                $this->info(sprintf('Successfully gave %s permission to %s!', $username, strtolower($permission)));
            }
        }

        // 
        return $this->info('Done!');
    }

    public function help(): string
    {
        return '';
    }

    public function name(): string
    {
        return 'user:givepermission';
    }

    public function options(): array
    {
        return [
            ['all', 'a', InputOption::VALUE_OPTIONAL, '', false]
        ];
    }

}
