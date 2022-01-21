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
                    {{ __('Thông tin Giftcode') }}
                </div>
                <div class="card-body">
                    <form action="{{ route(config('giftcode_reward.routes.put_update_giftcode'), $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên Giftcode</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" aria-describedby="name" placeholder="Tên"
                                value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="game_id">GAME ID</label>
                            <input type="text" class="form-control @error('game_id') is-invalid @enderror" id="game_id"
                                name="game_id" aria-describedby="game_id" placeholder="GAME ID"
                                value="{{ old('game_id', $category->game_id) }}" required>
                            @error('game_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stats">Chỉ số</label>
                            <div id="stats">
                                <textarea name="stats" class="form-control"
                                    rows="10">{{ json_encode(old('stats', $category->stats)) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success">Lưu lại</button>
                            <a data-action="{{ route(config('giftcode_reward.routes.delete_giftcode'), $category->id) }}"
                                class="btn btn-danger btn-delete float-right">
                                <i class="fas fa-trash"></i>
                                Xoá</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" id="form-delete">
    @csrf
    @method('DELETE')
</form>
