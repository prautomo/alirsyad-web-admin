<x-page.form :title="__('Edit External User')">
    <form action="{{route("backoffice::external-users.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.external-user.form', ['data' => $data])
    </form>
</x-page.form>