<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
        //  $table->bigInteger('user_id');
        //  $table->unsignedBigInteger('institution_id');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('institution_id')->constrained();
            $table->foreignId('hosteltype_id')->constrained();
       //   $table->bigInteger('hosteltype_id');            
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->text('utilities');
            $table->double('price', 10, 2);
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
        Schema::dropIfExists('hostels');
    }
}
