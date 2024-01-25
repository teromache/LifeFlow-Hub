<!-- Add this modal structure to your HTML/Blade file -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form goes here -->
                <form id="editForm">
                    <!-- Add your form fields here -->
                    <input type="text" id="editId" hidden>
                    <div class="form-group">
                        <label for="editDate">Tarikh</label>
                        <input type="text" class="form-control mb-2" id="editDate" name="date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Amaun (RM)</label>
                        <input type="number" class="form-control mb-2" id="editAmount" name="amount">
                    </div>
                    <div class="form-group">
                        <label for="">Nota</label>
                        <textarea class="form-control" name="note" id="editNote" cols="30" rows="10"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-info" onclick="saveChanges()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
