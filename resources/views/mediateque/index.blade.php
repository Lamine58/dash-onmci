@extends('layouts.app')

@section('title', $title)
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
        height: 150px;
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
            
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">{{$title}}</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Configuration</a></li>
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{route('mediateque.upload')}}" class="dropzone" id="my-dropzone">@csrf</form>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($medias as $media)
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
                </div>

                <div>
                    <ul class="pagination pagination-separated justify-content-center mb-0">
                        @if ($medias->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $medias->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                            </li>
                        @endif
            
                        @foreach ($medias->getUrlRange(1, $medias->lastPage()) as $page => $url)
                            @if ($page == $medias->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
            
                        @if ($medias->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $medias->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-link')
@endsection

@section('script')
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
            padding: 20px 20px;
        }
    </style>
    <script>
        $("#my-dropzone").dropzone({
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
                });
                this.on("error", function(file, response) {
                    console.log("Erreur lors du téléchargement du fichier");
                });
            }
        });
    </script>
@endsection
