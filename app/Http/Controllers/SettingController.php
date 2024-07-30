<?php

    namespace App\Http\Controllers;

    use App\Models\Setting;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;

    class SettingController extends Controller
    {

        public function index()
        {
            Auth::user()->access('CONFIGURATION SITE');

            $setting = Setting::first();
            $title = "Configuration du site";

            return view('setting.index',compact('setting','title'));
        }



        public function save(Request $request)
        {
            
            Auth::user()->access('CONFIGURATION SITE');

            $validator = $request->validate([
                'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'image_mission' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
            
            $data = $request->except(['data']);

            $file = $request->file('image_1');
            if ($file) {
                $filePath = $file->storeAs('public/file', $file->hashName());
                $data['image_1'] = $filePath ?? '';
                $data['image_1'] = str_replace('public/','',$data['image_1']);
            }
            $file = $request->file('image_2');
            if ($file) {
                $filePath = $file->storeAs('public/file', $file->hashName());
                $data['image_2'] = $filePath ?? '';
                $data['image_2'] = str_replace('public/','',$data['image_2']);
            }
            $file = $request->file('image_3');
            if ($file) {
                $filePath = $file->storeAs('public/file', $file->hashName());
                $data['image_3'] = $filePath ?? '';
                $data['image_3'] = str_replace('public/','',$data['image_3']);
            }
            $file = $request->file('image_4');
            if ($file) {
                $filePath = $file->storeAs('public/file', $file->hashName());
                $data['image_4'] = $filePath ?? '';
                $data['image_4'] = str_replace('public/','',$data['image_4']);
            }
            $file = $request->file('image_mission');
            if ($file) {
                $filePath = $file->storeAs('public/file', $file->hashName());
                $data['image_mission'] = $filePath ?? '';
                $data['image_mission'] = str_replace('public/','',$data['image_mission']);
            }
        
            $setting = Setting::updateOrCreate(
                ['id' => $request->id],
                $data
            );
        
        return response()->json(['message' => 'Modification effectué avec succès', 'status' => 'success']);
            

        }

    }
