@extends('layouts.app')

@section('title', 'Progress Master List')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($progressMasters as $item)
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ route('workorderprogressmaster.edit', $item->id) }}" class="text-decoration-none">
                        <div class="card border-0 rounded-25 mb-4 hover-effect">
                            <div class="card-body d-flex flex-column justify-content-center px-6 py-5">
                                <h2 class="fw-bold text-dark mb-0">{{ $item->name }}</h2>

                                @if ($item->description)
                                    <p class="text-dark mb-0"><strong>Description:</strong>
                                        {{ $item->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            @php
                $canCreate =
                    collect(session('user_permissions', []))->firstWhere('route_name', 'workorderprogressmaster')[
                        'can_create'
                    ] ?? false;
            @endphp
            @if ($canCreate)
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ route('workorderprogressmaster.create') }}" class="text-decoration-none">
                        <div class="card border-0 rounded-25 mb-4 hover-effect h-125px">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                <i class="fas fa-plus-circle text-primary" style="font-size: 3rem;"></i>
                                <h3 class="mt-3 text-dark fw-bold">Add New Progress</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

        </div>
    </div>

@endsection
