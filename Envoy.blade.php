@servers(['prod' => ['udibagas@dashboard.wide.co.id']])

@task('deploy', ['on' => 'prod'])
    cd apps/wide
    git pull
    php artisan migrate --force
@endtask
