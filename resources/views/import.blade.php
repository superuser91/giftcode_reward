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
                    {{ 'Import giftcode: ' . $category->name }}
                </div>

                <div class="card-body">
                    <form method="post"
                        action="{{ route(config('giftcode_reward.routes.post_import_giftcode'), $category->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">File danh sách code</label>
                            <input type="file" id="file" name="file"
                                class="form-control @error('file')is-invalid @enderror" />
                            <small class="form-text text-muted">File danh sách code, lưu ý mỗi code một dòng.</small>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
