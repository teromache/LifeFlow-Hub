<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Transaksi Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.spending') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Tarikh</label>
                        <input type="date" name="date" class="form-control mb-2" required>
                        <label for="">Jenis</label>
                        <select id="type" name="type" class="form-control mb-2" onchange="updateCategories()"
                            required>
                            <option value="">-- Sila Pilih --</option>
                            <option value="Pendapatan">Pendapatan</option>
                            <option value="Perbelanjaan">Perbelanjaan</option>
                        </select>
                        <label for="">Kategori</label>
                        <select id="category" name="category" class="form-control mb-2" required>
                            <option value="">-- Sila Pilih --</option>
                        </select>
                        <label for="">Amaun (RM)</label>
                        <input type="number" name="amount" class="form-control mb-2" required>
                        <label for="">Nota</label>
                        <textarea name="note" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var expensesCategories = @json($expenses_category);
    var incomeCategories = @json($income_category);

    function updateCategories() {
        var typeSelect = document.getElementById('type');
        var categorySelect = document.getElementById('category');

        categorySelect.innerHTML = "<option value=''>-- Sila Pilih --</option>";

        var selectedType = typeSelect.value;

        if (selectedType == 'Pendapatan') {
            populateOptions(expensesCategories);
        } else if (selectedType == 'Perbelanjaan') {
            populateOptions(incomeCategories);
        }

        function populateOptions(categories) {
            categories.forEach(function(category) {
                categorySelect.innerHTML += "<option value='" + category.id + "'>" + category.name +
                    "</option>";
            });
        }
    }
</script>
