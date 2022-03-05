<x-page.form :title="__('Edit Akses Modul')">
    <form action="{{route("backoffice::manage-external-users.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.manage-external-user.form', ['data' => $data])
    </form>
</x-page.form>