<x-page.form :title="__('Edit Simulasi')">
    <form action="{{route("backoffice::simulasis.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.simulasis.form', ['data' => $data])
    </form>
</x-page.form>