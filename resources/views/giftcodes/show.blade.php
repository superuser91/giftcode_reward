@extends(config('vgplay.giftcodes.layout'))

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-custom alert-success alert-shadow gutter-b w-100 mx-4" role="alert">
                    <div class="alert-icon">
                        <i class="fas fa-torii-gate"></i>
                    </div>
                    <div class="alert-text">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Danh sách Giftcode ' . $giftcode->name) }}
                        @can('import', $giftcode)
                            <a class="btn btn-warning float-right"
                                href="{{ route('giftcodes.records.import.show', $giftcode->id) }}">Import</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Claimed At</th>
                                    <th scope="col">VGPID</th>
                                    <th scope="col">Code chung</th>
                                    <th scope="col">Import At</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $('#datatable').DataTable({
            "searching": true,
            "responsive": true,
            "autoWidth": false,
            "language": {
                "processing": "Đang xử lý...",
                "infoFiltered": "(được lọc từ _MAX_ mục)",
                "emptyTable": "Không có dữ liệu",
                "info": "Hiển thị _START_ tới _END_ của _TOTAL_ bản ghi",
                "infoEmpty": "Hiển thị 0 tới 0 của 0 bản ghi",
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "loadingRecords": "Đang tải...",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối cùng",
                    "next": "Sau",
                    "previous": "Trước"
                },
                "search": "Tìm kiếm:",
                "zeroRecords": "Không tìm thấy kết quả"
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'Tất cả']
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "{{ url()->current() }}",
            columns: [{
                data: 'code',
            }, {
                data: 'claimed_at',
                render: function(data, type, row) {
                    return data ? (new Date(data)).toLocaleString() : '';
                },
            }, {
                data: 'user_id',
            }, {
                data: 'is_shared',
                render: function(data, type, row) {
                    return data ? 'X' : '';
                },
            }, {
                data: 'created_at',
                render: function(data, type, row) {
                    return data ? (new Date(data)).toLocaleString() : '';
                },
            }]
        })
    </script>
@endpush
