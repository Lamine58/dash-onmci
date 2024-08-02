<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Project;
    use App\Models\Media;
    use Illuminate\Support\Facades\Auth;

    class ProjectController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE PROJET');
            $projects = Project::paginate(100);
            
            return view('project.index',compact('projects'));
        }

        public function add($id)
        {
            $project = Project::find($id);

            if(!is_null($project)){
                $title = "Modifier $project->title";
                Auth::user()->access('EDITION PROJET');
            }else{
                $project = new Project;
                $title = 'Ajouter un projet';
                Auth::user()->access('AJOUT PROJET');
            }
            
            return view('project.save',compact('project','title'));
        }

        public function save(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION PROJET');
            }else{
                Auth::user()->access('AJOUT PROJET');
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

            $project = Project::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            $media_ids = explode(',',$request->media_ids);

            foreach($media_ids as $media_id){
                if($media_id!=''){
                    $media = Media::find($media_id);
                    $media->data_id = $project->id;
                    $media->model = 'Project';
                    $media->save();
                }
            }
            
            return response()->json(['message' => 'Project enregistré avec succès', 'status' => 'success']);
            

        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION PROJET');

            $project = Project::find($request->id);

            if($project->delete()){
                return response()->json(['message' => 'Project supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }