<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->comment('사용자 아이디');
            $table->string('name')->comment('사용자 이름');
            $table->string('email')->comment('사용자 이메일');
            $table->timestamp('email_verified_at')->nullable()->comment('사용자 이메일 인증');
            $table->string('password')->comment('사용자 비밀번호');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users COMMENT='회원정보'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
