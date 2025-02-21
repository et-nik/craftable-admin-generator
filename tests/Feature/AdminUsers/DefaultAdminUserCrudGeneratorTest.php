<?php

namespace Brackets\AdminGenerator\Tests\Feature\Users;

use Brackets\AdminGenerator\Tests\UserTestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DefaultAdminUserCrudGeneratorTest extends UserTestCase
{
    use DatabaseMigrations;

    /** @test */
    function all_files_should_be_generated_under_default_namespace(){
        $controllerPath = base_path('app/Http/Controllers/Admin/AdminUsersController.php');
        $indexRequestPath = base_path('app/Http/Requests/Admin/AdminUser/IndexAdminUser.php');
        $storePath = base_path('app/Http/Requests/Admin/AdminUser/StoreAdminUser.php');
        $updatePath = base_path('app/Http/Requests/Admin/AdminUser/UpdateAdminUser.php');
        $destroyPath = base_path('app/Http/Requests/Admin/AdminUser/DestroyAdminUser.php');
        $routesPath = base_path('routes/web.php');
        $indexPath = resource_path('views/admin/admin-user/index.blade.php');
        $listingJsPath = resource_path('js/admin/admin-user/Listing.js');
        $indexJsPath = resource_path('js/admin/admin-user/index.js');
        $elementsPath = resource_path('views/admin/admin-user/components/form-elements.blade.php');
        $createPath = resource_path('views/admin/admin-user/create.blade.php');
        $editPath = resource_path('views/admin/admin-user/edit.blade.php');
        $formJsPath = resource_path('js/admin/admin-user/Form.js');
        $factoryPath = base_path('database/factories/ModelFactory.php');

        $this->assertFileNotExists($controllerPath);
        $this->assertFileNotExists($indexRequestPath);
        $this->assertFileNotExists($storePath);
        $this->assertFileNotExists($updatePath);
        $this->assertFileNotExists($destroyPath);
        $this->assertFileNotExists($indexPath);
        $this->assertFileNotExists($listingJsPath);
        $this->assertFileNotExists($elementsPath);
        $this->assertFileNotExists($createPath);
        $this->assertFileNotExists($editPath);
        $this->assertFileNotExists($formJsPath);
		$this->assertFileNotExists($indexJsPath);


        $this->artisan('admin:generate:admin-user');

        $this->assertFileExists($controllerPath);
        $this->assertFileExists($indexRequestPath);
        $this->assertFileExists($storePath);
        $this->assertFileExists($updatePath);
        $this->assertFileExists($destroyPath);
        $this->assertFileExists($indexPath);
        $this->assertFileExists($listingJsPath);
        $this->assertFileExists($elementsPath);
        $this->assertFileExists($createPath);
        $this->assertFileExists($editPath);
        $this->assertFileExists($formJsPath);
		$this->assertFileExists($indexJsPath);
        $this->assertStringStartsWith('<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\AdminUser\IndexAdminUser;
use App\Http\Requests\Admin\AdminUser\StoreAdminUser;
use App\Http\Requests\Admin\AdminUser\UpdateAdminUser;
use App\Http\Requests\Admin\AdminUser\DestroyAdminUser;
use Brackets\AdminListing\Facades\AdminListing;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Support\Facades\Config;
use Brackets\AdminAuth\Services\ActivationService;
use Brackets\AdminAuth\Activation\Facades\Activation;
use Spatie\Permission\Models\Role;

class AdminUsersController extends Controller', File::get($controllerPath));
        $this->assertStringStartsWith('<?php namespace App\Http\Requests\Admin\AdminUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class IndexAdminUser extends FormRequest
{', File::get($indexRequestPath));
        $this->assertStringStartsWith('<?php namespace App\Http\Requests\Admin\AdminUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class StoreAdminUser extends FormRequest
{', File::get($storePath));
        $this->assertStringStartsWith('<?php namespace App\Http\Requests\Admin\AdminUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UpdateAdminUser extends FormRequest
{', File::get($updatePath));
        $this->assertStringStartsWith('<?php namespace App\Http\Requests\Admin\AdminUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DestroyAdminUser extends FormRequest
{', File::get($destroyPath));
        $this->assertStringStartsWith('<?php



/* Auto-generated admin routes */
Route::middleware([\'auth:\' . config(\'admin-auth.defaults.guard\'), \'admin\'])->group(function () {
    Route::get(\'/admin/admin-users\',                            \'Admin\AdminUsersController@index\');
    Route::get(\'/admin/admin-users/create\',                     \'Admin\AdminUsersController@create\');
    Route::post(\'/admin/admin-users\',                           \'Admin\AdminUsersController@store\');
    Route::get(\'/admin/admin-users/{adminUser}/edit\',           \'Admin\AdminUsersController@edit\')->name(\'admin/admin-users/edit\');
    Route::post(\'/admin/admin-users/{adminUser}\',               \'Admin\AdminUsersController@update\')->name(\'admin/admin-users/update\');
    Route::delete(\'/admin/admin-users/{adminUser}\',             \'Admin\AdminUsersController@destroy\')->name(\'admin/admin-users/destroy\');
    Route::get(\'/admin/admin-users/{adminUser}/resend-activation\',\'Admin\AdminUsersController@resendActivationEmail\')->name(\'admin/admin-users/resendActivationEmail\');', File::get($routesPath));
        $this->assertStringStartsWith('@extends(\'craftable/admin-ui::admin.layout.default\')', File::get($indexPath));
        $this->assertStringStartsWith('import AppListing from \'../app-components/Listing/AppListing\';

Vue.component(\'admin-user-listing\'', File::get($listingJsPath));
        $this->assertStringStartsWith('<div ', File::get($elementsPath));
        $this->assertStringStartsWith('@extends(\'craftable/admin-ui::admin.layout.default\')', File::get($createPath));
        $this->assertStringStartsWith('@extends(\'craftable/admin-ui::admin.layout.default\')', File::get($editPath));
        $this->assertStringStartsWith('import AppForm from \'../app-components/Form/AppForm\';

Vue.component(\'admin-user-form\'', File::get($formJsPath));
        $this->assertStringStartsWith('import \'./Listing\';', File::get($indexJsPath));
        $this->assertStringStartsWith('<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class', File::get($factoryPath));
    }

}
