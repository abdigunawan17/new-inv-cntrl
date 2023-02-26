<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;
use Image;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $allblogs = Blog::latest()->get();
        return view('admin.blogs.blog_alls', compact('allblogs'));
    }

    public function AddBlog()
    {
        $blogcategories = BlogCategory::orderBy('blog_category', 'ASC')->get(); 
        return view('admin.blogs.blogs_add', compact('blogcategories'));
    }

    public function StoreBlog(Request $request)
    {
        $image = $request->file('blog_image');
        $name_gen = hexdec(\uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(430,327)->save('upload/blog/' .$name_gen);

        $save_url = 'upload/blog/' . $name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_subtitle' => $request->blog_subtitle,
            'blog_slug' => $request->blog_slug,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $allblogs = Blog::findOrFail($id);
        $blogcategories = BlogCategory::orderBy('blog_category', 'ASC')->get(); 
        return view('admin.blogs.blog_edit', compact('allblogs','blogcategories'));
    }

    public function UpdateBlog(Request $request)
    {
        $blog_id = $request->id;

        if($request->file('blog_image'))
        {
            $image = $request->file('blog_image');
            $name_gen = hexdec(\uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(430,327)->save('upload/blog/' .$name_gen);

            $save_url = 'upload/blog/' . $name_gen;

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_subtitle' => $request->blog_subtitle,
                'blog_slug' => $request->blog_slug,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Blog Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        } else
        {
            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_subtitle' => $request->blog_subtitle,
                'blog_slug' => $request->blog_slug,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                
            ]);

            $notification = array(
                'message' => 'Blog Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function DeleteBlog($id)
    {
        $blogs = Blog::findOrFail($id);
        $img = $blogs->blog_image;
        unlink($img);

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //frontend
    public function BlogDetails($blog_slug)
    {
        $allblogs = Blog::latest()->limit(5)->get();
        //from trainer, but can't do it with blog_slug
        //$blogs = Blog::findOrFail($id);
        $blogs = Blog::where('blog_slug', $blog_slug)->firstOrFail();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('frontend.home.blog_details', compact('blogs', 'allblogs', 'categories'));
    }

    public function CategoryBlog($id)
    {
        $blogpost = Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->get();
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $categoryname = BlogCategory::findOrFail($id);

        return view('frontend.cat_blog_details', compact('blogpost', 'allblogs', 'categories', 'categoryname'));
    }

    public function HomeBlog()
    {
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allblogs = Blog::latest()->get();
        return view('frontend.blog', compact('allblogs', 'categories'));
    }

}
