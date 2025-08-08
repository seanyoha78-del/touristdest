<?php include '../nav/admin_header.php' ?>

<?php
$conn = mysqli_connect("localhost", "root", "", "admin_db"); // Replace with your DB name
$result = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY date_sent DESC");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM contact_messages WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 'success';
    } else {
        echo 'error';
    }

    mysqli_stmt_close($stmt);
}
?>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" style="margin-left: 30px;">
                <h1 class="h2">Inquiry/Message</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        This week
                    </button>
                </div>
            </div>
            <h2 style="margin-left: 30px;">List of Inquiry</h2>
            <div class="row justify-content-between" style="margin-left: 30px;">
                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto">
                    <div class="dt-length">
                        <select aria-controls="table1" class="custom-select custom-select-sm form-control form-control-sm" id="dt-length-0">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label for="dt-length-0"> entries per page</label>
                    </div>
                </div>
                <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ml-auto">
                    <div class="dt-search">
                        <label for="dt-search-0">Search:</label>
                        <input type="search" class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="table1">
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <div class="table-responsive">
                    <table id="inquiryTable" class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                                <tr 
                                    data-name="<?= htmlspecialchars($row['name']) ?>"
                                    data-email="<?= htmlspecialchars($row['email']) ?>"
                                    data-contact="<?= htmlspecialchars($row['contact']) ?>"
                                    data-message="<?= htmlspecialchars($row['message']) ?>"
                                    data-date="<?= date("F d, Y h:i:s A", strtotime($row['date_sent'])) ?>"
                                >
                                    <td><?= $counter++ ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= date("F d, Y h:i:s A", strtotime($row['date_sent'])) ?></td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-info btn-sm text-white view-btn" data-bs-toggle="modal" data-bs-target="#messageModal">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm text-white delete-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MESSAGE MODAL -->
            <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">From: <span id="modalName"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="modalMessage" class="mb-3"></p>
                            <hr>
                            <p>Email: <span id="modalEmail"></span></p>
                            <p>Contact Number: <span id="modalContact"></span></p>
                            <p>Date: <span id="modalDate"></span></p>
                        </div>
                    </div>
                </div>
            </div>
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#inquiryTable').DataTable({
                "dom": 't<"d-flex justify-content-between p-2"ip>', // Only show table (t), pagination (p), and info (i)
                "pagingType": "simple_numbers"
            });

            $('.view-btn').on('click', function () {
                const row = $(this).closest('tr');
                $('#modalName').text(row.data('name'));
                $('#modalEmail').text(row.data('email'));
                $('#modalContact').text(row.data('contact'));
                $('#modalMessage').text(row.data('message'));
                $('#modalDate').text(row.data('date'));
            });
        });
        $('.delete-btn').on('click', function () {
            const row = $(this).closest('tr');
            const messageId = row.data('id');

            if (confirm('Are you sure you want to delete this message?')) {
                $.ajax({
                    url: 'inquiry.php', // Change the path if needed
                    type: 'POST',
                    data: { id: messageId },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            row.remove(); // Remove row from table
                        } else {
                            alert('Failed to delete the message.');
                        }
                    },
                    error: function() {
                        alert('Error occurred while deleting.');
                    }
                });
            }
        });

    </script>


