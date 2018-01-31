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
                {data: 'email'},
                {data: 'first_name'},
                {data: 'last_name'},
                {data: 'phone'},
                {data: 'active', searchable: false},
                {data: 'action', searchable: false, orderable: false, width: '15%'},
            ],
            order: [[ 1, "desc" ]]
        });
    });
</script>