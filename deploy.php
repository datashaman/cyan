<?php
namespace Deployer;

require 'recipe/laravel.php';

set('application', 'cyan.datashaman.com');
set('git_tty', true); 
set('repository', 'git@github.com:datashaman/cyan.git');
set('writable_mode', 'chmod');
set('writable_use_sudo', true);

add('shared_dirs', []);
add('shared_files', []);
add('writable_dirs', []);

host('cyan.datashaman.com')
    ->set('deploy_path', '/var/www/{{application}}');
    
task('build', function () {
    run('cd {{release_path}} && build');
});

after('deploy:failed', 'deploy:unlock');
before('deploy:symlink', 'artisan:migrate');
