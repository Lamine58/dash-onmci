<?php

    namespace App\Http\Controllers;

    use App\Models\Setting;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class WebsiteController extends Controller
    {
       

        public function page($page)
        {
            Auth::user()->access('GESTION DE PAGE');

            $setting = Setting::first();
            $title = Setting::pages()[$page][0];
            $page = Setting::pages()[$page][1];

            return view('website.page',compact('page','title','setting'));
        }

        public function save(Request $request){

            $setting = Setting::first();
            foreach($request->all() as $key => $value){
                if(!in_array($key,['_token','id']))
                    $setting->$key = $value;
            }
            $setting->save();
        
            return response()->json(['message' => 'Modification effectué avec succès', 'status' => 'success']);
        }

    }
