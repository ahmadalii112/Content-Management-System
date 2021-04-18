<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $author1 =User::create([
           'name'=> 'Ali Ahmad',
           'email'=> 'Ali@Ahmad',
           'password'=> Hash::make('password'),
        ]);
        $author2 =User::create([
           'name'=> 'Ahmad Ali',
           'email'=> 'Ahmad@Ali',
           'password'=> Hash::make('password'),
        ]);
        $author3 =User::create([
           'name'=> 'Muhammad Ali',
           'email'=> 'Muhammad@Ali',
           'password'=> Hash::make('password'),
        ]);
        $category1 =Category::create([
            'name'=>'News'
        ]);

        $category2 =Category::create([
            'name'=>'Design'
        ]);
        $category3 =Category::create([
            'name'=>'Programming'
        ]);


         $post1 = Post::create([
             'title'=>'We relocated our office to a new designed garage',
             'description'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At commodi culpa illo laudantium nam porro reiciendis sed vel velit veniam!',
             'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At commodi culpa illo laudantium nam porro reiciendis sed vel velit veniam!',
             'category_id'=> $category1->id,
             'image'=>'uploads/1.jpg',
             'user_id'=>$author1->id,
//             'subcategory_id'=>$subcategory1
         ]);
         $post2 = $author2->posts()->create([
             'title'=>'Top 5 brilliant content marketing strategies',
             'description'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At commodi culpa illo laudantium nam porro reiciendis sed vel velit veniam!',
             'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At commodi culpa illo laudantium nam porro reiciendis sed vel velit veniam!',
             'category_id'=> $category2->id,
             'image'=>'uploads/2.jpg',
//             'subcategory_id'=>$subcategory2
         ]);
         $post3 = $author1->posts()->create([
             'title'=>'Best practices for minimalist design with example',
             'description'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At commodi culpa illo laudantium nam porro reiciendis sed vel velit veniam!',
             'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At commodi culpa illo laudantium nam porro reiciendis sed vel velit veniam!',
             'category_id'=> $category3->id,
             'image'=>'uploads/3.jpg',
//             'subcategory_id'=>$subcategory3

         ]);

        $tag1 =Tag::create([
            'name'=>'Record'
        ]);
        $tag2 =Tag::create([
            'name'=>'Progress'
        ]);
        $tag3 =Tag::create([
            'name'=>'Customers'
        ]);

        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post3->tags()->attach([$tag1->id,$tag3->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
    }
}
