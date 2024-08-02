<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Event;
    use App\Models\Media;
    use Illuminate\Support\Facades\Auth;

    class EventController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE EVENEMENT');
            $events = Event::paginate(100);
            
            return view('event.index',compact('events'));
        }

        public function add($id)
        {
            $event = Event::find($id);

            if(!is_null($event)){
                $title = "Modifier $event->title";
                Auth::user()->access('EDITION EVENEMENT');
            }else{
                $event = new Event;
                $title = 'Ajouter un evènement';
                Auth::user()->access('AJOUT EVENEMENT');
            }
            
            return view('event.save',compact('event','title'));
        }

        public function save(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION EVENEMENT');
            }else{
                Auth::user()->access('AJOUT EVENEMENT');
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

            $event = Event::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            $media_ids = explode(',',$request->media_ids);

            foreach($media_ids as $media_id){
                if($media_id!=''){
                    $media = Media::find($media_id);
                    $media->data_id = $event->id;
                    $media->model = 'Event';
                    $media->save();
                }
            }
            
            return response()->json(['message' => 'Event enregistré avec succès', 'status' => 'success']);
            

        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION EVENEMENT');

            $event = Event::find($request->id);

            if($event->delete()){
                return response()->json(['message' => 'Event supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }