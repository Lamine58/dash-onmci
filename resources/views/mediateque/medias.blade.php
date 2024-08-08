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
        z-index: 999;
        border: 1px solid #dcdcdc;
        border-radius: 5px;
        width: 100%;
        height: 150px;
        background-size: cover;
        background-position: center;
        background-color: #f3f3f3;
        position: relative;
        cursor: pointer;
    }
    .delete-icon {
        z-index: 1000;
        position: absolute;
        top: 5px;
        right: 15px;
        color: #dc3545;
        font-size: 24px;
        cursor: pointer;
    }
    .delete-icon:hover {
        color: #c82333;
    }
    .fancy{
        position: absolute;
        z-index: 999;
        width: 100%;
        height: 150px;
        display: block;
        top: 0;
    }
</style>

<div class="row">
    @foreach($medias as $media)
        <div class="col-4 media-item" onclick="addImage('{{ asset('storage/' . $media->file_path) }}')">
            @if($media->type == 'image')
                <div class="media-bg" style="background-image: url('{{ asset('storage/' . $media->file_path) }}');">
                </div>
            @else
                <div class="media-bg text-center">
                    <i class="media-icon {{ $media->icon }}"></i>
                </div>
            @endif
        </div>
    @endforeach
</div>
