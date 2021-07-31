<x-page.form :title="__('Edit Payment Method')">
    <form action="{{route("backoffice::payment-methods.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.payment-method.form', ['data' => $data])
    </form>
</x-page.form>
