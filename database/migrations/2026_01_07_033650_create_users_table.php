<?php

use Velocix\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->createTable('users', function($table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->dropTable('users');
    }
}