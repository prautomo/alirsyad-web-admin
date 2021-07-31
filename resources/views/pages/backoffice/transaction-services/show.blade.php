<x-page.show :title="__('Transaction Detail')">
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab" aria-controls="transaction" aria-selected="true">Transaction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="false">Customer</a>
                </li>
                @if($data->paymentDetail)
                <li class="nav-item">
                    <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                </li>
                @endif
                @if($data->jasaUser)
                <li class="nav-item">
                    <a class="nav-link" id="mitra-tab" data-toggle="tab" href="#mitra" role="tab" aria-controls="mitra" aria-selected="false">Mitra</a>
                </li>
                @endif
            </ul>
            
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                    <div class="card-body">
                        <x-textView :label="__('Transaction Status')" :value="$data->status_transaksi" />
                        <x-textView :label="__('Transaction Code')" :value="$data->kode_transaksi" />
                        <x-textView :label="__('Shipping Fee')" :value="$data->ongkos_kirim" />
                        <x-textView :label="__('Admin Fee')" :value="$data->biaya_admin" />
                        @if($data->promo)
                        <x-textView :label="__('Promo')" :value="$data->promo ? $data->promo->name : __('-')" />
                        @endif
                        <x-textView :label="__('Discount')" :value="$data->diskon" />
                        <x-textView :label="__('Price Per Day')" :value="$data->harga_perhari" />
                        <x-textView :label="__('Total Day')" :value="$data->jumlah_hari" />
                        <x-textView :label="__('Transaction Total')" :value="$data->total_transaksi" />
                        <x-textView :label="__('Project Date')" :value="$data->waktu_pengerjaan" />
                        @if($data->note)
                        <x-textView :label="__('Note')" :value="$data->note" />
                        @endif

                    </div>
                </div>
                <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                    <div class="card-body">
                        <x-textView :label="__('Name')" :value="$data->customer ? $data->customer->name : __('Unknown')" />
                        <x-textView :label="__('Phone')" :value="$data->customer ? $data->customer->phone : __('-')" />
                        
                        <x-textView :label="__('Receive Name')" :value="$data->nama_penerima ? $data->nama_penerima : __('Unknown')" />
                        <x-textView :label="__('Receive Phone')" :value="$data->telp_penerima ? $data->telp_penerima : __('-')" />
                        <x-textView :label="__('Receive Address')" :value="$data->alamat_penerima ? $data->alamat_penerima : __('-')" />
                    </div>
                </div>
                @if($data->paymentDetail)
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    <div class="card-body">
                    
                        <x-textView :label="__('Payment Method')" :value="$data->paymentDetail->paymentMethod ? $data->paymentDetail->paymentMethod->name : __('Unknown')" />
                        <x-textView :label="__('Payment Number')" :value="$data->paymentDetail->payment_number ? $data->paymentDetail->payment_number : __('-')" />
                        <x-textView :label="__('Payment Status')" :value="$data->paymentDetail->status_transaksi ? $data->paymentDetail->status_transaksi : __('Unknown')" />

                    </div>
                </div>
                @endif
                @if($data->jasaUser)
                <div class="tab-pane fade" id="mitra" role="tabpanel" aria-labelledby="mitra-tab">
                    <div class="card-body">
                    
                        <x-textView :label="__('Name')" :value="$data->jasaUser->name ? $data->jasaUser->name : __('Unknown')" />
                        <x-textView :label="__('Phone')" :value="$data->jasaUser->phone ? $data->jasaUser->phone : __('Unknown')" />

                    </div>
                </div>
                @endif
            </div>

            
        </div>

    </div>
</x-page.show>