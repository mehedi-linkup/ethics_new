<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("company_name");
            $table->string("ownername")->nullable();
            $table->string("ownerdesignation")->nullable();
            $table->string("mobile");
            $table->string("email")->nullable();
            $table->text("address")->nullable();
            $table->string("mobile_second")->nullable();
            $table->string("email_second")->nullable();
            $table->text("address_second")->nullable();
            $table->string("logo")->nullable();
            $table->string("navicon")->nullable();
            $table->string("ownerimage")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string("twitter")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("youtube")->nullable();
            $table->integer("minimum_qty")->nullable();
            $table->string("hotImage_one")->nullable();
            $table->string("hotText_one")->nullable();
            $table->string("hotImage_two")->nullable();
            $table->string("hotText_two")->nullable();
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
        Schema::dropIfExists('settings');
    }
}
