<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('type_problems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_problem');
            $table->unsignedBigInteger('problem_id');
            $table->timestamps();
            $table->foreign('problem_id')
                ->references('id')
                ->on('problems')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_problems');
    }
}
