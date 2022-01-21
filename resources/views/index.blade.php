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
                    {{ __('Danh sách loại Giftcode') }}
                    <a class="btn btn-warning float-right"
                        href="{{ route(config('giftcode_reward.routes.get_store_giftcode')) }}">Thêm
                        mới</a>
                </div>

                <div class="card-body">
                    <div class="col-md-6 my-2 px-0">
                        <div class="input-icon">
                            <input name="name" type="text" class="form-control" placeholder="Tìm kiếm..."
                                id="kt_datatable_search_input">
                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                        </div>
                    </div>
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
                            @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->game_id }}</td>
                                    <td>
                                        <a href="{{ route(config('giftcode_reward.routes.get_list_giftcode_record'), $category->id) }}"
                                            class="btn btn-success">Danh sách giftcode</a>
                                        <a href="{{ route(config('giftcode_reward.routes.get_update_giftcode'), $category->id) }}"
                                            class="btn btn-success">{{ __('Sửa') }}</a>
                                        <a href="{{ route(config('giftcode_reward.routes.get_import_giftcode'), $category->id) }}"
                                            class="btn btn-success">{{ __('Import') }}</a>
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
