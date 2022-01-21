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
                    {{ __('Danh sách Giftcode ' . $category->name) }}
                    <a class="btn btn-warning float-right"
                        href="{{ route(config('giftcode_reward.routes.get_import_giftcode'), $category->id) }}">Import</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Used At</th>
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
