<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id');
                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles');
            });

            $admin = Role::where('name', 'admin')->first();
            $user = Role::where('name', 'user')->first();

            User::firstOrCreate([
                'name'      => 'iqbal',
                'username'  => '112233',
                'password'  => Hash::make('112233'),
                'email'     => 'admin@admin.com',
                'role_id'   => $admin->id
            ]);
            User::firstOrCreate([
                'name'      => 'iqbal',
                'username'  => '332211',
                'password'  => Hash::make('332211'),
                'email'     => 'user@user.com',
                'role_id'   => $user->id
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
