<?php

use App\Enums\VaccineRegistrationStatus;
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
        Schema::table('vaccine_registrations', function (Blueprint $table) {
            $table->after('vaccine_center_id', function () use ($table) {
                $table->enum('status', VaccineRegistrationStatus::toArray())
                    ->default(VaccineRegistrationStatus::NOT_SCHEDULED->value);
                $table->date('vaccination_date')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vaccine_registrations', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('vaccination_date');
        });
    }
};
