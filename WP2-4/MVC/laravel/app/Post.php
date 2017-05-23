<?php
/**
 * Created by PhpStorm.
 * User: Anissa
 * Date: 17/04/2017
 * Time: 16:32
 */
namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'content'];
    //zodat je in de database eraan kan


    public function likes(){
        return $this->hasMany('App\Like', 'post_id');
    }
//^ met idt aan te passen moet je weer migraten
    //php migrate artisan:refresh --seed
                    //^de seed erbij zorgt dat die ook weer opneiuw worden uitgevoerd

    public function tags(){
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id')->withTimestamps();
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = strtolower($value);
    }

    public function getTitleAttribute($value) {
        return strtoupper($value);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    //code valt volledig weg omdat de database dit werk nu doet
/*    public function getPosts($session){
        if(!$session->has('posts')){
            $this->createDummyData($session);
        }
        return $session->get('posts');
    }

    public function getPost($session, $id){
        if(!$session->has('posts')){
            $this->createDummyData($session);
        }
        return $session->get('posts')[$id];
    }

    public function addPost($session, $title, $content){
        if(!$session->has('posts')){
            $this->createDummyData($session);
        }
        $posts = $session->get('posts');
        array_push($posts, ['title' => $title, 'content' => $content]);
        $session->put('posts', $posts);
    }

    public function editPost($session, $id, $title, $content){
        $posts = $session->get('posts');
        $posts[$id] = ['title' => $title, 'content' => $content];
        $session->put('posts',$posts);
    }

    private function createDummyData($session){
        $posts = [
            [   'title' => 'Learning Laravel',
                'content' => 'This blog post will get you right on track with Laravel'
            ],
            [ 'title' => 'Something else',
                'content' => 'Some other content']

        ];
        $session->put('posts', $posts);
    }*/

}