# important command to deploy : 
php artisan migrate                 -> create tables in database
php artisan db:seed                 -> create demo data in tables like  admins , setting ,lang, infos ,contacts 
php artisan passport:install        -> create client token for apis auth
php artisan passport:keys --force   -> create oauth-private.key and oauth-public.key for apis auth inside storage folder


# if get error permission exist run this : 
php artisan cache:forget spatie.permission.cache
