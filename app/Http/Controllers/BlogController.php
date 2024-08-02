<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Blog;
    use App\Models\Media;
    use Illuminate\Support\Facades\Auth;

    class BlogController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE ACTUALITE');
            $blogs = Blog::paginate(100);
            
            return view('blog.index',compact('blogs'));
        }

        public function add($id)
        {
            $blog = Blog::find($id);

            if(!is_null($blog)){
                $title = "Modifier $blog->title";
                Auth::user()->access('EDITION ACTUALITE');
            }else{
                $blog = new Blog;
                $title = 'Ajouter une actualité';
                Auth::user()->access('AJOUT ACTUALITE');
            }
            
            return view('blog.save',compact('blog','title'));
        }

        public function save(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION ACTUALITE');
            }else{
                Auth::user()->access('AJOUT ACTUALITE');
            }

            $validator = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'title' => 'required|string',
            ]);
            
            $data = $request->except(['image']);
                
            $file = $request->file('image');
            if ($file) {
                $filePath = $file->storeAs('public/projet', $file->hashName());
                $data['image'] = $filePath ?? '';
                $data['image'] = str_replace('public/','',$data['image']);
            }
        
            $data['user_id'] = Auth::user()->id;
            $data['description'] = htmlspecialchars($request->description);

            $blog = Blog::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            $media_ids = explode(',',$request->media_ids);

            foreach($media_ids as $media_id){
                if($media_id!=''){
                    $media = Media::find($media_id);
                    $media->data_id = $blog->id;
                    $media->model = 'Blog';
                    $media->save();
                }
            }
            
            return response()->json(['message' => 'Blog enregistré avec succès', 'status' => 'success']);
            

        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION ACTUALITE');

            $blog = Blog::find($request->id);

            if($blog->delete()){
                return response()->json(['message' => 'Actualité supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }