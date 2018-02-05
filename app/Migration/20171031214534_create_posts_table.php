<?php

use App\Migration\Migration;
use App\Model\PostModel;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{

    public function up()
    {
        $this->schema()->create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->longText('content')->nullable();
            $table->string('title', 160);
            $table->timestamps();
        });
        PostModel::insert([
            ['title' => 'Hello World!', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eleifend, enim vitae vehicula rutrum, tortor odio pulvinar nisi, eu tincidunt enim mi eget quam. Proin ultrices volutpat rhoncus. Nullam feugiat nulla justo, et ullamcorper massa sodales ut. Donec finibus, ex et vulputate convallis, justo libero finibus tellus, maximus pulvinar risus odio in magna. Phasellus velit ex, rhoncus vitae feugiat nec, finibus id sem. Aliquam erat volutpat. Praesent rutrum ipsum nunc, nec viverra libero condimentum id. Vivamus pellentesque, urna quis interdum lacinia, nibh arcu gravida tortor, vel tristique libero purus condimentum ligula. Etiam vitae ligula tincidunt, rhoncus neque nec, pharetra lectus.'],
            ['title' => 'Hola Mundo!', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices ut massa id maximus. Sed in neque arcu. Morbi vitae lectus non eros gravida venenatis et sit amet justo. Mauris quis massa ac nibh posuere pretium ac sit amet sapien. Ut vitae nisi imperdiet, feugiat dolor ac, tempor orci. Proin consequat odio a ornare placerat. Praesent scelerisque sit amet dolor ut semper. Nullam suscipit erat nec feugiat suscipit. Donec aliquet lorem augue, quis dictum risus luctus ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam sapien neque, placerat nec egestas eget, ultrices iaculis lectus.'],
            ['title' => 'Ciao mondo!', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tincidunt mi quis cursus dapibus. Cras quis finibus est. Donec at interdum odio, vel laoreet est. Sed efficitur vestibulum justo vel tempor. Sed vitae ante ac neque tincidunt blandit. Curabitur convallis risus tempus finibus tincidunt. Integer a pulvinar turpis, in tempus leo. Quisque vel tortor risus. Vivamus molestie scelerisque facilisis. Fusce sed ipsum risus. Nam et ipsum a nisl accumsan varius. Cras semper blandit dapibus. Pellentesque faucibus ipsum et dolor elementum, eu volutpat nisi vestibulum. Maecenas odio tortor, aliquet aliquam risus eu, efficitur bibendum risus. Suspendisse potenti. Duis placerat dolor sed.'],
            ['title' => 'Hej Verden!', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dictum purus quis sagittis imperdiet. Nullam facilisis luctus mauris in efficitur. Integer rhoncus, libero eu tincidunt lobortis, turpis magna finibus tellus, eget porta felis dolor porta ligula. Proin turpis orci, vehicula sit amet augue quis, facilisis rhoncus lorem. Ut ac luctus velit. Nulla massa sem, malesuada eu varius sit amet, placerat eu velit. Nulla facilisi. Curabitur blandit justo vel odio mollis accumsan. Aliquam sem sem, luctus vel tincidunt eu, malesuada vel quam. Praesent ornare nulla arcu, sit amet sodales sapien tincidunt a. Nulla neque massa, viverra sit amet magna ut, dignissim.'],
            ['title' => 'Bonjour le monde!', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fringilla sapien vel ante tincidunt porttitor. Vivamus congue id libero eget dictum. Nunc tempor nisl sit amet justo congue pretium. Etiam nec fermentum nunc. Praesent varius augue id massa posuere hendrerit. Praesent quis augue nisl. Nam iaculis turpis tortor, in rhoncus nibh fringilla vel. In metus ex, aliquet sed arcu id, luctus aliquet ipsum. Curabitur sed pellentesque urna. Pellentesque finibus arcu fringilla est aliquam, ut interdum turpis suscipit. Nulla et turpis eu lacus fermentum consequat non at mauris. Suspendisse potenti. Donec semper euismod lorem et tincidunt. Proin auctor enim leo. Suspendisse.']
        ]);
    }

    public function down()
    {
        $this->schema()->drop('posts');
    }

}
