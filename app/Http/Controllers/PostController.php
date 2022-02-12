<?php

namespace App\Http\Controllers;

use App\Events\BlogPostPosted;
use App\Facades\CounterFacade;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $counter;
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
        // $this->middleware('locale');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // database connection query
        // DB::enableQueryLog();

        // $posts = BlogPost::all();
        // $posts = BlogPost::with('comments')->get();
        // foreach( $posts as $post   ){
        //     foreach($post->comments as $comment){
        //        echo $comment->content."<br><br>";
        //     }
        // }


        //Let's Start cache work for our site
            // $MostCommented = Cache::remember('MostCommented', 60, function () {
            //     return  BlogPost::mostCommented()->take(5)->get();
            // });

            // $mostActiveUser = Cache::remember('mostActiveUser', 60, function () {
            //     return User::withMostCommentBlogPosts()->take(5)->get();
            // });

            // $mostActiveLastMonth = Cache::remember('mostActiveLastMonth', 60, function () {
            //     return  User::withBlogPostsLastMonth()->take(5)->get();
            // });


        return view('posts.index',
            [
                'post' => BlogPost::latest()
                ->withCount('comments')
                ->with('user')
                ->with('tags')->get(),

                //latest() global query scope used for post orderBy desc

                // 'MostCommented' =>   $MostCommented, //BlogPost::mostCommented()->take(5)->get(),//mostCommented() is local query scope used for show most commend post

                // 'mostActiveUser' =>  $mostActiveUser, //User::withMostCommentBlogPosts()->take(5)->get(),//withMostCommentedBlogPost() is local query scope used for show most commend post

                // 'mostActiveLastMonth' =>  $mostActiveLastMonth, //User::withBlogPostsLastMonth()->take(5)->get(),//withBlogPostsLastMonth() is local query scope used for show most commend post

            ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('posts.create');

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StorePost $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = $request->user()->id;

        $post = BlogPost::create($validatedData);

        if(  $request->hasFile('thumbnail') )
        {

            $path = $request->file('thumbnail')->store('Thumbnails');

            $post->image()->save(

                Image::make(['path' => $path])

            );//the file pathe save in Image model path column

        }//store the file in public thumbnails folder and Image model store pathe of this file

        event(  new BlogPostPosted($post) );

        $request->session()->flash('status', 'Blog post was created!');

       return redirect()->route('posts.show', [$post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // return view('posts.show', [

        //     'post' => BlogPost::with(['comments' => function($query){

        //         return $query->latest();

        //     }])->findOrfail($id)

        // ]); // eivabe kaj kore local query scope

        $blogpost = Cache::remember('blog-post-{$id}', 60, function () use($id) {

            return BlogPost::with('comments', 'tags', 'user', 'comments.user')->findOrfail($id);

        }); //used cached for show blogPost details

//        $counter = resolve(Counter::class);

        return view('posts.show', [

            'post' => $blogpost,

            'counter' => CounterFacade::increment("blog-post-{$id}", ["blog-post"]),

        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = BlogPost::findOrFail($id);

        $this->authorize($post); // same work this Gate and Authorize

        // if( Gate::denies('update-post', $post) ){

        //     abort(403, " You can't edit blog post");
        // };

        return view('posts.edit', ['post' =>  $post ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( StorePost $request, $id)
    {

        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        $validated = $request->validated();

        $post->fill($validated);

        if(  $request->hasFile('thumbnail') )
        {

            $path = $request->file('thumbnail')->store('Thumbnails');

            if( $post->image ){

                Storage::delete( $post->image->path );

                $post->image->path = $path;

                $post->image->save();

            }else{

                $post->image()->save(
                    Image::make(['path' => $path])
                );//the file pathe save in Image model path column

            }

        }//store the file in public thumbnails folder and Image model store pathe of this file

        $post->save();

        $request->session()->flash('status', 'Blog post was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrfail($id);

        $this->authorize($post);

        // if( Gate::denies('delete-post', $post)  ){

        //     abort(403, "You can't delete blog post");

        // }

        $post->delete();

        session()->flash('status', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }

}
