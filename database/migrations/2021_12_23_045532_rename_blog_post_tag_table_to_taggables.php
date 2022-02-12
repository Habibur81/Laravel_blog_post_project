<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameBlogPostTagTableToTaggables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_post_tag', function (Blueprint $table) {

            $table->dropForeign(['blog_post_id']);
            $table->dropColumn('blog_post_id');

        });//foreign key and foreign key column drop kora hoyeche old table theke


        Schema::rename('blog_post_tag', 'taggables');//old table theke new table create kora hoyeche


        Schema::table('taggables', function(Blueprint $table){

            $table->morphs('taggable');

        });//polymorphic relation create hoyeche column create hobe taggable_id and taggable_type
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taggables', function (Blueprint $table) {

            $table->dropMorphs('taggable');

        });

        Schema::rename('taggables', 'blog_post_tag');

        Schema::disableForeignKeyConstraints();

        Schema::table('blog_post_tag', function(Blueprint $table){

            $table->unsignedBigInteger('blog_post_id')->index();

            $table->foreign('blog_post_id')->references('id')
                ->on('blog_posts')
                ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }
}
