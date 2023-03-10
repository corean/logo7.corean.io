@servers(['web' => 'logo2@logo.corean.io'])

@task('list', ['on' => 'web'])
ls -l
@endtask

@setup
    $repository = 'git@github.com:corean/logo7.corean.io.git';
    $releases_dir = '/home3/logo2/www/releases';
    $app_dir = '/home3/logo2/www';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    clone_repository
    run_composer
    npm_install
    update_symlinks
    optimize
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --optimize-autoloader --no-dev
@endtask

@task('npm_install')
    echo "npm install ({{ $release }})"
    cd {{ $new_release_dir }}
    npm install
    npm run build
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('optimize')
    echo "optimize laravel"
    cd {{ $new_release_dir }}
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
@endtask


