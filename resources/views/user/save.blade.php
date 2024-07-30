@extends('layouts.app')

@section('title', $title)

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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Fournisseurs</a></li>
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <form action="{{ route('settings.save') }}" class="add_setting" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $setting->id ?? '' }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="file" name="image_1" class="dropify" data-default-file="{{ isset($setting) && $setting->image_1 ? Storage::url($setting->image_1) : '' }}">
                                            <input type="file" name="image_2" class="dropify" data-default-file="{{ isset($setting) && $setting->image_2 ? Storage::url($setting->image_2) : '' }}">
                                            <input type="file" name="image_3" class="dropify" data-default-file="{{ isset($setting) && $setting->image_3 ? Storage::url($setting->image_3) : '' }}">
                                            <input type="file" name="image_4" class="dropify" data-default-file="{{ isset($setting) && $setting->image_4 ? Storage::url($setting->image_4) : '' }}">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row g-3">
                
                                                <div class="col-lg-6">
                
                                                    <div>
                                                        <label class="form-label">Titre</label>
                                                        <input type="text" name="title" value="{{ $setting->title ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">Sous-titre</label>
                                                        <input type="text" name="subtitle" value="{{ $setting->subtitle ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" value="{{ $setting->email ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">Téléphone</label>
                                                        <input type="text" name="phone" value="{{ $setting->phone ?? '' }}" class="form-control rounded-end phone" />
                                                    </div>
                
                                                </div>
                
                                                <div class="col-lg-6">
                
                                                    <div class="mt-3">
                                                        <label class="form-label">Localisation</label>
                                                        <input type="text" name="location" value="{{ $setting->location ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">Facebook</label>
                                                        <input type="text" name="facebook" value="{{ $setting->facebook ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">Twitter</label>
                                                        <input type="text" name="twitter" value="{{ $setting->twitter ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">Instagram</label>
                                                        <input type="text" name="instagram" value="{{ $setting->instagram ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">YouTube</label>
                                                        <input type="text" name="youtube" value="{{ $setting->youtube ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                    <div class="mt-3">
                                                        <label class="form-label">LinkedIn</label>
                                                        <input type="text" name="linkedin" value="{{ $setting->linkedin ?? '' }}" class="form-control rounded-end" />
                                                    </div>
                
                                                </div>
                
                                                <div class="col-lg-12">
                                                    <button id="add_setting" class="btn btn-primary btn-block" style="width:100%">Enregistrer</button>
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

    <script>

        $('#region_id').on('change',function(){

            var regionId = $(this).val();

            $.ajax({
                url: '/regions/' + regionId + '/departements',
                type: 'GET',
                success: function(response) {

                    $('#departement_id').select2('destroy');

                    var options = '<option value="">Tout</option>';
                    $.each(response, function(index, departement) {
                        options += '<option value="' + departement.id + '">' + departement.name + '</option>';
                    });
                    $('#departement_id').html(options);
                    $('#departement_id').select2();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            
        });


        $('#departement_id').on('change',function(){

            var departementId = $(this).val();

            $.ajax({
                url: '/departements/' + departementId + '/sous-prefectures',
                type: 'GET',
                success: function(response) {

                    $('#sous_prefecture_id').select2('destroy');

                    var options = '<option value="">Tout</option>';
                    $.each(response, function(index, sous_prefecture) {
                        options += '<option value="' + sous_prefecture.id + '">' + sous_prefecture.name + '</option>';
                    });
                    $('#sous_prefecture_id').html(options);
                    $('#sous_prefecture_id').select2();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            
        });

        $('.add_user').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add_user').text();
            var button = $('#add_user');

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

                        window.location='{{route("user.index")}}'
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