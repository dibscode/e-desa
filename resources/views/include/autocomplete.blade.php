<!-- autocomplete -->
<script>
    $(function () {
        $("#user_name").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('user.autocomplete') }}",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $('#user_id').val(ui.item.id); // simpan id ke input hidden
                $('#user_name').val(ui.item.value); // tampilkan nama
                return false;
            }
        });
    });
</script>