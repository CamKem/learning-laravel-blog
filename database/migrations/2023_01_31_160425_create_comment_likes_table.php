<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->id();

           //

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_likes');
    }
};