## Public Admin
Email:donatepur@gmail.com
Password:123DonatepurAdmin@
Public Backend/Admin Lte: 
<p>
Repo:https://github.com/jeroennoten/Laravel-AdminLTE
Documentation: https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Installation
</p>

## Super Admin Panel
<p>
copy all vendor/tcf/voyager /migrations to database/migrations
copy vendor/tcf/voyager/assets/views to resources/
copy vendor/tcf/voyager/routes/voyager.php to routes/
copy all controllers as well [    // $namespacePrefix = '\\'.config('voyager.controllers.namespace').'\\';
]

for css

copy donatepur/vendor/tcg/voyager/publishable to app/
user env.example
for env set up
</p>

make sure :cache clear


## Set up
1. copy email templates     php artisan vendor:publish --tag=laravel-mail



<!-- plugins for frontend users admin panel-->
php artisan adminlte:plugins install --plugin=datatables --plugin=datatablesPlugins
<!-- plugins for frontend users admin panel-->
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## SCREEN BACKGROUNDUSGE
1:Add new command in background: screen -S <session_name> EG. screen -S queue:work

type1: put command run in background
2:Leave command running in background: screen+A+D 

type2:put it into the background but close
To terminate the current screen session (not put it into the background but close), press Ctrl + D or type:

