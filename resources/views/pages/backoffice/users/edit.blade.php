<x-page.form :title="__('Edit User')">
    <form action="{{route("backoffice::users.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.users.form', ['data' => $data])
    </form>
</x-page.form>