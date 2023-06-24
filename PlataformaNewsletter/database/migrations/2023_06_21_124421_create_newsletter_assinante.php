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
        Schema::create('newsletter_assinante', function (Blueprint $table) {
            $table->unsignedBigInteger('newsletter_id');
            $table->foreign('newsletter_id')->references('id')->on('newsletters')->onDelete('cascade');
            
            $table->unsignedBigInteger('assinante_id');
            $table->foreign('assinante_id')->references('id')->on('assinantes')->onDelete('cascade');

            $table->primary(['newsletter_id', 'assinante_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsletter_assinante');
    }
};
?>
