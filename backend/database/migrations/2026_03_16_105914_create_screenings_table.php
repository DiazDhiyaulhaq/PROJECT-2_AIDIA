<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');

            $table->integer('blood_sugar')->nullable();
            $table->string('blood_pressure')->nullable();

            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('bmi')->nullable();

            $table->float('waist_circumference')->nullable();
            $table->boolean('physical_activity')->default(false);
            $table->boolean('family_history')->default(false);

            $table->integer('age')->nullable();

            $table->enum('risk_level',['low','medium','high'])->default('low');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};
