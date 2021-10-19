<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\SubscribeUser;
use Validator;
use App\Console\Commands\SendMailCommand;
use Mail;

class HomeController extends Controller
{
    /**
     * Subscribe Website
     */
    public function subscribe(Request $request){

         $rules = [
            'website_id' => 'required|exists:websites,id',
            'email'      => 'required|email',
          ];
    
          $validator = Validator::make($request->all(), $rules );
    
          if ($validator->fails()) {
              $errors =  $validator->errors()->all();
              return response(['status' => false , 'message' => $errors[0]],200);              
          }

          $user  = User::where('email',$request->email)->first();

          $isSubscribed = 0;
          if($user){
              $isSubscribed = SubscribeUser::where('user_id',$user->id)->where('website_id',$request->website_id)->count();
              if($isSubscribed){
                  return response(['status' => false , 'message' => 'Already Subscribed Website'],200);    
              }
          }

          try{ 
              if(empty($user)){
                  $user = new User;
                  $user->email = $request->email;
                  $user->save();
              }
              $user->subscriptions()->create(['website_id'=>$request->website_id]);
              return response(['status' => true , 'message' => 'Subscribed Successful'],200);    
          }catch(\Exception $e){
              return $e->getMessage();
          }
           return response(['status' => false , 'message' => 'Failed to subscribe'],200);    
    }

    public function postCreate(Request $request){

         $rules = [
            'website_id'   => 'required|exists:websites,id',
            'title'        => 'required',
            'description'  => 'required'
          ];
    
          $validator = Validator::make($request->all(), $rules );
    
          if ($validator->fails()) {
              $errors =  $validator->errors()->all();
              return response(['status' => false , 'message' => $errors[0]],200);              
          }

          $isExistPost = Post::where('website_id',$request->website_id)->whereRaw('LOWER(posts.title) like ?' , '%'.strtolower($request->title).'%')->count();

          if($isExistPost){
              return response(['status' => false , 'message' => 'Post already exist'],200);    
          }

          $post = new Post;
          $post->website_id = $request->website_id;
          $post->title   = $request->title;
          $post->description = $request->description;
          
          if($post->save()){
            $subscribers =  $post->website->subscriptions;
            if($subscribers->toarray()){
                  foreach($subscribers as $key => $subscriber){
                    dispatch(new SendMailCommand(['to_email' => $subscriber->user->email,'title'=>$post->title,'description'=>$post->description,'created_at'=>$post->created_at]));
                  }
            }
            return response(['status' => true , 'message' => 'Post created successful'],200);    
          }

           return response(['status' => false , 'message' => 'Failed to create post'],200);    
    }
}
