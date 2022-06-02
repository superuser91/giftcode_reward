@extends(config('vgplay.giftcodes.layout'))

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                {{ __('Thông tin Giftcode') }}
            </div>
            <div class="card-body">
                <form action="{{ route('giftcodes.update', $giftcode->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Tên Giftcode</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            aria-describedby="name" placeholder="Tên" value="{{ old('name', $giftcode->name) }}" required>
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
                            value="{{ old('game_id', $giftcode->game_id) }}" required>
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
                                rows="10">{{ json_encode(old('stats', $giftcode->stats)) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success">Lưu lại</button>
                        <a data-action="{{ route('giftcodes.destroy', $giftcode->id) }}"
                            class="btn btn-danger btn-delete float-right">
                            <i class="fas fa-trash"></i>
                            Xoá</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form method="POST" id="form-delete">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        $('#btn-add-stat').click(function(e) {
            $('#stats').append(`
          <div class="stat row mb-3">
              <div class="col">
                  <input type="text" name="stats[name][]" class="form-control" placeholder="Tên chỉ số">
              </div>
              <div class="col">
                  <input type="text" name="stats[value][]" class="form-control" placeholder="Giá trị chỉ số">
              </div>
              <div class="col-1">
                  <span class="btn text-danger btn-remove-stat"><i class="fas fa-times"></i></span>
              </div>
          </div>
      `);
        })

        $(document).on('click', '.btn-remove-stat', function() {
            $(this).closest('.stat').remove();
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let action = $(this).data('action');
            let confirmed = confirm("Bạn có chắc chắc muốn xoá?");
            if (confirmed) {
                $('#form-delete').attr('action', action);
                $('#form-delete').submit();
            }
        });
    </script>
@endpush
