<?php

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts_id_arr = DB::table('posts')->skip(0)->limit(5)->lists('id');
        $tags_id_arr = DB::table('tags')->skip(0)->limit(5)->lists('id');

        foreach ($posts_id_arr as $each_post) {
            foreach ($tags_id_arr as $each_tag) {
                if ($each_tag > $each_post) {
                    $this->insert_record($each_post, $each_tag);
                }
            }
        }
    }

    /**
     * insert the record of the table post_tag
     * @param int $post_id
     * @param int $tag_id
     */
    private function insert_record($post_id, $tag_id)
    {
        DB::table('post_tag')->insert([
            'post_id' => $post_id,
            'tag_id' => $tag_id,
            'created_at' => date_create(),
        ]);

    }
}
