<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->string('etablissement');
            $table->string('deplome');
            $table->string('description');
            $table->date('debut');
            $table->date('fin'); 
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
        Schema::dropIfExists('formations');
        $table->dropColumn('id');
        $table->dropForeign(['article_id']);
        $table->dropColumn('article_id');
         $table->dropColumn('etablissement');
         $table->dropColumn('description');
         $table->dropColumn('debut');
         $table->dropColumn('fin');
        
    }
}
