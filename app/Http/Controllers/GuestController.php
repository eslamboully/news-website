<?php

namespace App\Http\Controllers;

use App\Admin\Category;
use App\Admin\News;
use Illuminate\Http\Request;
use App\Http\Interfaces\NewsInterface;
class GuestController extends Controller
{
    public function home_page(NewsInterface $news)
    {
        $first_news = $news->getQueryNews()->skip(3)->first();
        $second_news = $news->getQueryNews()->skip(4)->first();
        $third_news = $news->getQueryNews()->skip(5)->first();
        $side_news = $news->getQueryNews()->skip(6)->take(4)->get();
        $newss = $news->getQueryNews()->skip(2)->take(4)->get();
        $most_news = $news->getQueryNews()->skip(4)->take(4)->get();
        $skip_news = $news->getQueryNews()->skip(9)->take(6)->get();
        $last_news = $news->getQueryNews()->take(3)->get();
        return view('index',compact('first_news','second_news','third_news','side_news','newss','most_news','skip_news','last_news'));
    }
    public function category_page($category_name,NewsInterface $newss)
    {
        $category = Category::where('name_en',str_replace('-',' ',$category_name))->first();
        $news = $newss->getQueryNews()->where('category_id',$category->id)->with('admin','country','category')->paginate(3);
        $side_news = $newss->getQueryNews()->with('admin','country','category')->where('category_id',$category->id)->skip(5)->take(6)->get();
        $last_news = $newss->getQueryNews()->with('admin','country','category')->where('category_id',$category->id)->take(4)->get();
        if ($category_name == 'Home'){
            return redirect()->route('home_page');
        }else{
            return view('category',compact('category','news','side_news','last_news'));
        }
    }
    public function single_page($category_name,$news_name,NewsInterface $newss)
    {
        $date = date('Y-m-d');
        $news = News::where('title',str_replace('-',' ',$news_name))->first();
        $next_news = $newss->getQueryNews()->where('id','<',$news->id)->first();
        $prev_news = $newss->getQueryNews()->where('id','>',$news->id)->first();
        $down_news = $newss->getQueryNews()
            ->where('category_id',$news->category_id)
            ->skip(2)
            ->take(2)
            ->get();
        $most_news = $newss->getQueryNews()
            ->skip(2)
            ->take(4)
            ->get();
        return view('single_page',compact('news','next_news','prev_news','down_news','most_news'));
    }
}
