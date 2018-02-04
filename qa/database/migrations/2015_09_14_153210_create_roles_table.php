<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->smallInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->nullable();
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->smallInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('permission_groups', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->smallInteger('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('permission_dependencies', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('dependency_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('dependency_id')->references('id')->on('permissions');
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign('role_user_user_id_foreign');
            $table->dropForeign('role_user_role_id_foreign');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });

        Schema::drop('permission_role');
        Schema::drop('role_user');
        Schema::drop('roles');
        Schema::drop('permission_groups');
        Schema::drop('permission_dependencies');
        Schema::drop('permissions');
    }
}
