<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('problems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('solved_by_user_id');
            $table->unsignedBigInteger('system_id');
            $table->unsignedBigInteger('TypeProblem_id');
            $table->string('title');
            $table->dateTime('dateTime_problem');
            $table->string('levels_problem');
            $table->text('reason_problem');
            $table->text('scenario_problem');
            $table->text('longTerm_solution');
            $table->text('shortTerm_solution');
            $table->timestamps();
            $table->foreign('created_by_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('solved_by_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('system_id')
                ->references('id')
                ->on('systems')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('TypeProblem_id')
                ->references('id')
                ->on('type_problems')
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
        Schema::dropIfExists('problems');
    }
}
