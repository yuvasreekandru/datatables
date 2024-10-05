<!-- resources/views/users/index.blade.php -->
{{-- normal search datatables --}}
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Laravel DataTables Example</title>
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Laravel DataTables Example</h2>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
    </table>
</div>

<!-- jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('users') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' }
        ]
    });
});
</script>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel DataTables with Dropdown Filters</title>
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Laravel DataTables with Dropdown Filters</h2>

    <!-- Dropdown filters -->
    <div class="row mb-3">
        <div class="col-md-4">
            <select id="filter-name" class="form-control">
                <option value="">Select Name</option>
                <!-- These options will be dynamically populated -->
            </select>
        </div>

        <div class="col-md-4">
            <select id="filter-email" class="form-control">
                <option value="">Select Email</option>
                <!-- These options will be dynamically populated -->
            </select>
        </div>
    </div>

    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize the DataTable with server-side processing
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url('users') }}',
            data: function (d) {
                d.name = $('#filter-name').val();   // Send name filter to server
                d.email = $('#filter-email').val(); // Send email filter to server
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' }
        ]
    });

    // Fetch unique names and emails for the dropdowns (optional - dynamic filter options)
    $.getJSON('{{ url('users/filters') }}', function(data) {
        $.each(data.names, function(key, value) {
            $('#filter-name').append('<option value="'+value+'">'+value+'</option>');
        });

        $.each(data.emails, function(key, value) {
            $('#filter-email').append('<option value="'+value+'">'+value+'</option>');
        });
    });

    // Trigger DataTable redraw on filter change
    $('#filter-name, #filter-email').change(function() {
        table.draw();
    });
});
</script>

</body>
</html>
