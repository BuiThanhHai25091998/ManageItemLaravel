<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\ProductType;
use App\BillDetail;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex()
    {
    	$slide = Slide::all();
    	//return view('page.trangchu',['slide'=>$slide]);
    	$new_product = Product::where('new',1)->paginate(4);
    	$product_promotion = Product::where('promotion_price','<>',0)->paginate(8);
    	return view('page.trangchu',compact('slide','new_product','product_promotion'));
    }

    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChiTiet(Request $req)
    {
        $sanpham = Product::where('id',$req->id)->first();
        $sp_cungloai = Product::where('id_type',$sanpham->id_type)->paginate(3);
        $sp_moi = Product::where('new',1)->paginate(4);
        $sp_banchay = BillDetail::where('quatity','<>',1)->get();
    	return view('page.chitiet_sanpham',compact('sanpham','sp_cungloai','sp_moi','sp_banchay'));
    }

    public function getLienHe()
    {
    	return view('page.lienhe');
    }
}
