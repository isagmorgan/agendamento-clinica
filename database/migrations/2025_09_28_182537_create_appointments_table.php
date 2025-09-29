<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // médico
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->integer('duration_minutes')->default(30);
            $table->enum('status', ['scheduled','canceled','done'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id','date']);
            $table->index('patient_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
