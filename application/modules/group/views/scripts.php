<script type="application/javascript">
    $(document).ready(function() {
        $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url($slug . '/datatables');?>",
                type: "POST"
            },
            columns: [
                {data: 'no', searchable: false, orderable: false, width: '5%'},
                {data: 'name'},
                {data: 'description'},
                {data: 'action', searchable: false, orderable: false, width: '15%'},
            ],
            order: [[ 1, "desc" ]]
        });
    });

    $(document).on('click', '.primary', function(){
        var checkbox = $(this).parents('ul.action').find('input[type="checkbox"]');
        if ($(this).is(':checked')) {
            $(checkbox).prop('checked', true);
            $(checkbox).not(this).attr('disabled', false);
        } else {
            $(checkbox).prop('checked', false);
            $(checkbox).not(this).attr('disabled', true);
        }
    });

    $(document).on('click', '.check_all', function(){
        var checkbox = $(this).parents('.list-group-item').next('.children').find('input[type="checkbox"]');
        if ($(this).is(':checked')) {
            $(checkbox).prop('checked', true);
            $(checkbox).not('.primary').not('.check_all').attr('disabled', false);
        } else {
            $(checkbox).prop('checked', false);
            $(checkbox).not('.primary').not('.check_all').attr('disabled', true);
        }
    });
</script>