<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_applications', function (Blueprint $table) {
            $table->id();
            $table->string("date");
            $table->string("name");
            $table->string("phone");
            $table->string("email");
            $table->text("address");
            $table->string("postcode")->nullable();
            $table->text("note")->nullable();
            $table->char("status")->default("pending");
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
        Schema::dropIfExists('membership_applications');
    }
}
