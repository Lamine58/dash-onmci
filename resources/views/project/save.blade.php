@extends('layouts.app')

@section('title', $title)

<style>
    .dropify-wrapper {
        height: 250px;
    }
</style>
<style>
    .dropify-wrapper {
        margin-bottom: 7px;
    }
    .media-item {
        margin-bottom: 20px;
        position: relative;
    }
    .media-icon {
        font-size: 50px;
        text-align: center;
        line-height: 150px;
        margin-top: 47px;
        color: #007bff; 
    }
    .media-bg {
        border: 1px solid #dcdcdc;
        border-radius: 5px;
        width: 100%;
        height: 100px;
        background-size: cover;
        background-position: center;
        background-color: #f3f3f3;
        position: relative;
    }
    .delete-icon {
        position: absolute;
        top: 5px;
        right: 5px;
        color: #dc3545;
        font-size: 24px;
        cursor: pointer;
    }
    .delete-icon:hover {
        color: #c82333;
    }
</style>

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">{{$title}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Projet</a></li>
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <form action="{{route('project.save')}}" class="add_project">
                    @csrf
                    <input type="hidden" name="id" value="{{$project->id}}">
                    <input type="hidden" value="" id="media_id" name="media_ids">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="file" name="image" class="dropify" data-default-file="{{$project->image!=null ? Storage::url($project->image) : ''}}">
                                            <br>
                                            <div action='{{route('mediateque.upload')}}?_token={{csrf_token()}}' id="dropzone" class="dropzone">@csrf</div>
                                            <br>
                                            <div class="row">
                                                @foreach($project->medias as $media)
                                                    <div class="col-2 media-item">
                                                        @if($media->type == 'image')
                                                            <div class="media-bg" style="background-image: url('{{ asset('storage/' . $media->file_path) }}');">
                                                                @if(Auth::user()->permission('SUPPRESSION MEDIATHEQUE'))
                                                                    <i class="ri-close-circle-fill delete-icon" onclick="deleted('{{$media->id}}','{{route('mediateque.delete')}}')"></i>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div class="media-bg text-center">
                                                                @if(Auth::user()->permission('SUPPRESSION MEDIATHEQUE'))
                                                                    <i class="ri-close-circle-fill delete-icon" onclick="deleted('{{$media->id}}','{{route('mediateque.delete')}}')"></i>
                                                                @endif
                                                                <i class="media-icon {{ $media->icon }}"></i>
                                                            </div>
                                                        @endif
                                                        <small>{{$media->file_name}}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row g-3">
    
                                                <div class="col-lg-12">
                                            
                                                    <div>
                                                        <select name="state" required  class="form-control rounded-end">
                                                            <option {{$project->title=='Publier' ? 'selected' : ''}}>Publier</option>
                                                            <option {{$project->title=='Brouillon' ? 'selected' : ''}}>Brouillon</option>
                                                        </select>
                                                    </div>

                                                    <div class="mt-3">
                                                        <label class="form-label">Titre</label>
                                                        <input type="text" name="title" value="{{$project->title}}" class="form-control rounded-end" required />
                                                    </div>

                                                    <div class="mt-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="summernote" name="description" >{!!$project->description!!}</textarea>
                                                    </div>
        
                                                </div>
                                                <div class="col-lg-12">
                                                    <button id="add_project" class="btn btn-primary btn-block" style="width:100%">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                </form>


            </div>
            <!-- container-fluid -->
        </div>
        

@endsection

@section('css-link')
    
@endsection

@section('script')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <style>
        .dropzone {
            min-height: 150px;
            border: 2px dashed rgb(160 160 160 / 30%);
            background: white;
            padding: 0px 14px;
        }
        .dropzone .dz-message .dz-button {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            font-size: 13px;
            cursor: pointer;
            outline: inherit;
            padding: 11px;
        }
    </style>

    <script>

        $(document).ready(function() {

            $('.summernote').summernote({height:400});
            
        });


        $("#dropzone").dropzone({
            dictDefaultMessage: "Déposez vos fichiers ici ou cliquez pour télécharger.",
            dictFallbackMessage: "Votre navigateur ne prend pas en charge le glisser-déposer de fichiers.",
            dictFallbackText: "Veuillez utiliser le formulaire de secours ci-dessous pour télécharger vos fichiers comme avant.",
            dictFileTooBig: "Le fichier est trop volumineux ",
            dictInvalidFileType: "Vous ne pouvez pas télécharger des fichiers de ce type.",
            dictResponseError: "Le serveur a répondu.",
            dictCancelUpload: "Annuler le téléchargement",
            dictCancelUploadConfirmation: "Êtes-vous sûr de vouloir annuler ce téléchargement ?",
            dictRemoveFile: "Supprimer le fichier",
            dictMaxFilesExceeded: "Vous ne pouvez pas télécharger plus de fichiers.",
            init: function() {
                this.on("success", function(file, response) {
                    console.log("Fichier téléchargé avec succès");
                    $("#media_id").val($("#media_id").val()+response.media.id+',');
                });
                this.on("error", function(file, response) {
                    console.log("Erreur lors du téléchargement du fichier");
                });
            }
        });

      
        $('.add_project').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add_project').text();
            var button = $('#add_project');

            button.attr('disabled',true);
            button.text('Veuillez patienter ...');

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: form,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result){

                    button.attr('disabled',false);
                    button.text(buttonDefault);

                    if(result.status=="success"){

                        Toastify({
                            text: result.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "#4CAF50", // green
                        }).showToast();

                        window.location='{{route("project.index")}}'
                    }else{
                        Toastify({
                            text: result.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }
                    
                },
                error: function(result){

                    button.attr('disabled',false);
                    button.text(buttonDefault);

                    if(result.responseJSON.message){
                        Toastify({
                            text: result.responseJSON.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }else{
                        Toastify({
                            text: "Une erreur c'est produite",
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }

                }
            });
        });

    </script>
   
@endsection