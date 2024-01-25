<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <title>LifeFlow-Hub</title>
</head>

<body>

    @include('layouts.navbar')

    <section id="content">
        @include('layouts.header')
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Pengurus Perbelanjaan</h1>
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berjaya!',
                                text: 'Berjaya cipta transaksi',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Spending Tracker</a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3>RM 3000</h3>
                        <p>Pendapatan</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3>RM 2500</h3>
                        <p>Perbelanjaan</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3>RM 300</h3>
                        <p>Baki</p>
                    </span>
                </li>
            </ul>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Sejarah Perbelanjaan</h3>
                        <div class="float-end">
                            <!-- Button to trigger the modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                Tambah
                            </button>
                            @include('modal.new_spending')
                            @include('modal.edit_spending')
                        </div>
                    </div>
                    <table id="example" class="table table-striped dt-responsive" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tarikh</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Nota</th>
                                <th style="text-align: center;">Tindakan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </main>
    </section>

    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            load_data();

            function load_data() {
                $('#example').DataTable({
                    scrollX: true,
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    info: true,
                    autoWidth: false,
                    ajax: {
                        url: "{{ route('index.spending') }}"
                    },
                    columns: [{
                            data: 'no'
                        },
                        {
                            data: 'date',
                        },
                        {
                            data: 'type'
                        },
                        {
                            data: 'category'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'note'
                        },
                        {
                            data: 'action'
                        }
                    ]
                });
            }
        });
    </script>

    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Anda pasti?',
                text: 'Teruskan padam transaksi?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, teruskan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                Swal.fire({
                                    title: 'Berjaya!',
                                    text: 'Berjaya padam maklumat',
                                    icon: 'success'
                                }).then(() => {
                                    window.location.href = '/spending';
                                })
                            } else {
                                Swal.fire({
                                    title: 'Ralat!',
                                    text: data.error,
                                    icon: 'error'
                                })
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        }
    </script>

    <script>
        var expensesCategories = @json($expenses_category);
        var incomeCategories = @json($income_category);

        function openEditModal(id) {
            $.ajax({
                url: '/spending/' + id,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#editId').val(response.id);
                    $('#editDate').val(response.date);
                    $('#editAmount').val(response.amount);
                    $('#editNote').val(response.note);

                    $('#editType').val(response.type);

                    $('#editCategory').val(response.category);

                    $('#editModal').modal('show');
                }
            });
        }

        function saveChanges() {
            var id = document.getElementById('editId').value;
            var formData = {
                date: $('#editDate').val(),
                type: $('#editType').val(),
                amount: $('#editAmount').val(),
                note: $('#editNote').val(),
            };

            Swal.fire({
                title: 'Anda pasti?',
                text: 'Teruskan kemaskini transaksi?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, teruskan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/spending/update/' + id,
                        type: 'POST',
                        data: formData,
                        success: function(data) {
                            if (data.message) {
                                Swal.fire({
                                    title: 'Berjaya!',
                                    text: 'Berjaya kemaskini maklumat',
                                    icon: 'success'
                                }).then(() => {
                                    window.location.href = '/spending';
                                })
                            } else {
                                Swal.fire({
                                    title: 'Ralat!',
                                    text: data.error,
                                    icon: 'error'
                                })
                            }
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>
