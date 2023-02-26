<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Carbon\Carbon;
use Image;


class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $get_portfolio_data = Portfolio::latest()->get();

        return view('admin.portfolio.portfolio_all', compact('get_portfolio_data'));
    }

    public function AddPortfolio()
    {
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request)
    {

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Hey portfolio name is required',
            'portfolio_title.required' => 'Hey portfolio title is required',
        ]);

            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();

            Image::make($image)->resize(1020, 519)->save('upload/portfolio/'.$name_gen);

            $save_url = 'upload/portfolio/'.$name_gen;

            Portfolio::insert([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Portfolio inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id)
    {
        $get_portfolio_data = Portfolio::findOrFail($id);

        return view('admin.portfolio.portfolio_edit', compact('get_portfolio_data'));
    }

    public function UpdatePortfolio(Request $request)
    {
        $get_portfolio_id = $request->id;

        if($request->file('portfolio_image'))
        {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();

            Image::make($image)->resize(1020, 519)->save('upload/portfolio/'.$name_gen);

            $save_url = 'upload/portfolio/'.$name_gen;

            Portfolio::findOrFail($get_portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Portfolio Page Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);
        }else{
            Portfolio::findOrFail($get_portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,    

            ]);
            $notification = array(
                'message' => 'Portfolio Page Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }

    }

    public function DeletePortfolio($id)
    {
        $get_portfolio_data = Portfolio::findOrFail($id);
        $img = $get_portfolio_data->portfolio_image;
        unlink($img);

        Portfolio::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DetailsPortfolio($id)
    {
        $get_detail_portfolio = Portfolio::findOrFail($id);

        return view('frontend.portfolio_details', compact('get_detail_portfolio'));
    }
}
