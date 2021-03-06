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
                        {{ 'Import giftcode: ' . $giftcode->name }}
                    </div>

                    <div class="card-body">
                        <table class="table table-striped" id="kt_datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên loại giftcode</th>
                                    <th scope="col">GAME ID</th>
                                    <th scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($giftcodes as $giftcode)
                                    <tr>
                                        <th>{{ $giftcode->id }}</th>
                                        <td>{{ $giftcode->name }}</td>
                                        <td>{{ $giftcode->game_id }}</td>
                                        <td>
                                            @can('show', $giftcode)
                                                <a href="{{ route('giftcodes.show', $giftcode->id) }}"
                                                    class="btn btn-success">Danh
                                                    sách
                                                    giftcode</a>
                                            @endcan
                                            @can('update', $giftcode)
                                                <a href="{{ route('giftcodes.edit', $giftcode->id) }}"
                                                    class="btn btn-warning">{{ __('Sửa') }}</a>
                                            @endcan
                                            @can('import', $giftcode)
                                                <a href="{{ route('giftcodes.records.import.show', $giftcode->id) }}"
                                                    class="btn btn-info">{{ __('Import') }}</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
