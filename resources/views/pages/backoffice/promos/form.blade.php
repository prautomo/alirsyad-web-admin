@csrf
<div class="row">
    <x-input.text :label="__('Code')" name="code" :data="$data" required />
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />
    <x-input.images :label="__('Image')" name="cover_image" :data="$data" required />

    <x-input.text :label="__('Date Period')" name="date_period" required />
    
    <x-input.text :label="__('Potongan Nominal')" type="number" name="potongan_nominal" :data="$data" />
    <x-input.text :label="__('Potongan Persen')" type="number" step="0.01" name="potongan_persen" :data="$data" />
    
    <x-input.select :label="__('Mitra')" name="mitra_id" :data="$data" :sources="$mitras" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::promos.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>

@once
@push('plugin_css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('plugin_script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endpush
@endonce

@push('script')
<script>
$(function() {
  $('input[name="date_period"]').daterangepicker({
    timePicker: false,
    startDate: {!! $data ? "moment('".$data->start_date."', 'YYYY/MM/DD')" : "moment().startOf('hour')" !!},
    endDate: {!! $data ? "moment('".$data->end_date."', 'YYYY/MM/DD')" : "moment().startOf('hour').add(5, 'day')" !!},
    locale: {
      format: 'YYYY/MM/DD'
    }
  });
});
</script>
@endpush