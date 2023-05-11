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
        Schema::create('codiPostal', function (Blueprint $table) {
        $table->id();
        $table->string("localidade");
        $table->string('concelho');
        $table->string('pais'); 
    
        $table->timestamps();
       
           
        
    });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
