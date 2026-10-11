<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
Route::get('/', fn()=>view('home',['products'=>config('catalog')]));
Route::get('/demo/{slug}', function (string $slug) {
 $product=collect(config('catalog'))->firstWhere('slug',$slug);
 abort_unless($product,404);
 return view('demo',compact('product'));
})->name('demo');
Route::post('/tu-van', function (Request $request) {
 $data=$request->validate(['name'=>'required|string|max:100','phone'=>['required','regex:/^[0-9+().\s-]{8,30}$/'],'email'=>'nullable|email|max:255','message'=>'nullable|string|max:2000']);
 DB::table('inquiries')->insert([...$data,'created_at'=>now(),'updated_at'=>now()]);
 return redirect('/#lien-he')->with('success','Đã nhận yêu cầu của bạn. Tam Ca Ba Con Mèo sẽ liên hệ tư vấn sớm!');
})->middleware('throttle:5,1')->name('inquiry');
