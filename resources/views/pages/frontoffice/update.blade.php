@extends('layouts.frontoffice')

@section('title', __("Update terbaru"))

@section('content')
<section class="mt-5">
    <div class="container">
        <div class="row my-5">
            <div class="col-md-12 mb-1 card">
                <div class="card-title mb-0 pt-2">
                    <div class="font-weight-bolder" style="color: #0E594D;">Update Terbaru</div>
                </div>
                <hr class="mt-2"/>

                <div class="card-body" style="max-height: 360px; overflow-y: auto">
                    <div class="row">
                    @forelse($updates as $update)
                        <div class="col-md-3 col-6 col-sm-4">
                            <a href="{{ route('app.'.(@$update->trigger ?? 'video').'.detail', @$update->trigger_id) }}">
                                <img src="{{ asset((@$update->logo === '' || @$update->logo === null) ? 'images/image-placeholder.jpg' : $update->logo) }}" alt="{{ @$update->trigger_name ?? "-" }}" title="{{ @$update->trigger_name ?? "-" }}" width="100%" class="mb-3 rounded" />
                            </a>
                        </div>
                    @empty
                        <div class="col-md-12 mb-4">
                            <div class="wrap-kelas form-inline mt-3">
                                <h4 class="font-weight-bold">Belum ada mata update terbaru.</h4>
                            </div>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
