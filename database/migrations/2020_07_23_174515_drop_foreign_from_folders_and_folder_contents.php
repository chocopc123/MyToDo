<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignFromFoldersAndFolderContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropForeign('folders_user_id_foreign');
        });
        Schema::table('folder_contents', function (Blueprint $table) {
            $table->dropForeign('folder_contents_folder_id_foreign');
            $table->dropForeign('folder_contents_todo_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            //
        });
    }
}
