<script src="/vendor/admin-lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/vendor/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/vendor/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="/vendor/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" href="/vendor/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/vendor/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
