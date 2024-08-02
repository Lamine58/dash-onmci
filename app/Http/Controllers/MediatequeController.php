<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Media;
    use Illuminate\Support\Facades\Storage;

    class MediatequeController extends Controller
    {

        public function index()
        {
            Auth::user()->access('MEDIATHEQUE');

            $title = "Médiatèques";
            $medias = Media::paginate(10);
            return view('mediateque.index',compact('title','medias'));
        }

        public function upload(Request $request)
        {
            $request->validate([
                'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,mp4,avi,doc,docx|max:20480',
            ]);

            $file = $request->file('file');

            if ($file) {

                $filePath = $file->storeAs('public/mediateque', $file->hashName());

                $filePath = str_replace('public/', '', $filePath);

                $mimeType = $file->getClientMimeType();
                if (strstr($mimeType, "image/")) {
                    $type = 'image';
                } elseif (strstr($mimeType, "video/")) {
                    $type = 'video';
                } elseif (strstr($mimeType, "application/pdf")) {
                    $type = 'pdf';
                } elseif (strstr($mimeType, "application/msword") || strstr($mimeType, "application/vnd.openxmlformats-officedocument.wordprocessingml.document")) {
                    $type = 'docx';
                } else {
                    $type = 'other';
                }

                $media = new Media();
                $media->type = $type;
                $media->file_path = $filePath;
                $media->file_name = $file->getClientOriginalName();
                $media->mime_type = $mimeType;
                $media->save();

                return response()->json(['success' => 'Fichier téléchargé avec succès', 'media' => $media]);
            }

            return response()->json(['error' => 'Aucun fichier téléchargé'], 400);
        }

        public function delete(Request $request){
            
            Auth::user()->access('SUPPRESSION MEDIATHEQUE');

            $media = Media::find($request->id);

            Storage::delete('public/' . $media->file_path);

            if($media->delete()){
                return response()->json(['message' => 'Media supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }
