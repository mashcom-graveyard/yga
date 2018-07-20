<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province');
            $table->string('firstname');
            $table->string('surname');
            $table->string('designation');
            $table->string('national_id')->unique();
            $table->string('email')->unique();
            $table->text('address');
            $table->string('telephone');
            $table->string('mobile');
            $table->date('dob');
            $table->string('sport');
            $table->enum('gender',['Male','Female']);
            $table->text('theme');
            $table->text('barcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
