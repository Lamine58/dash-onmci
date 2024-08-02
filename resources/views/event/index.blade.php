@extends('layouts.app')

@section('title', 'Liste des utilisateurs')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des évenements</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Projets</a></li>
                                    <li class="breadcrumb-item active">Liste des évenements</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th>Administrateur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>{{$event->title}}</td>
                                                <td>{{$event->state}}</td>
                                                <td>{{$event->created_at}}</td>
                                                <td>{{$event->user->first_name}} {{$event->user->last_name}}</td>
                                                <td>
                                                    @if(Auth::user()->permission('EDITION EVENEMENT') || Auth::event()->permission('SUPPRESSION EVENEMENT'))
                                                        <button class="btn btn-soft-secondary btn-sm dropdown"  data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            @if(Auth::user()->permission('EDITION EVENEMENT'))
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route('event.add',[$event->id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                                </li>
                                                            @endif
                                                            @if(Auth::user()->permission('SUPPRESSION EVENEMENT'))
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="deleted('{{$event->id}}','{{route('event.delete')}}')" class="dropdown-item remove-item-btn">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($events->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{$events->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($events->getUrlRange(1,$events->lastPage()) as $page => $url)
                                        @if ($page ==$events->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($events->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{$events->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <br>
                        </div>
                    </div><!--end col-->
                    
                </div><!--end row-->

            </div>
            <!-- container-fluid -->
            
        </div>
        <!-- End Page-content -->


@endsection

@section('script')
    <script>
        new DataTable("#table", {
            dom: "Bfrtip",
            paging:false,
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });
    </script>
@endsection 