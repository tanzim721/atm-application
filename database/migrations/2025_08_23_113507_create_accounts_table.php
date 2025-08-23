<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('account_number', 12)->unique();
            $table->enum('account_type', ['savings', 'current', 'fixed_deposit'])->default('savings');
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->string('pin_hash');
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->decimal('daily_limit', 10, 2)->default(5000.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
