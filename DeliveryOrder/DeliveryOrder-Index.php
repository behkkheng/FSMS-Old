
@{
    ViewData["Title"] = "Delivery Order";
}
@section Styles{
    <!-- DataTables -->
    <link rel="stylesheet" href="~/lib/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="~/lib/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="~/lib/datatables-buttons/css/buttons.bootstrap4.min.css">
}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        @Html.ActionLink("New Delivery Order", "Create", "DeliveryOrder", null, new { @class = "float-right btn btn-primary" })
                    </div>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                D/O. No.
                            </th>
                            <th>
                                Customer Name
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Status
                            </th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                D/O05-001
                            </td>
                            <td>
                                Micron Memory Malaysia Sdn. Bhd
                            </td>
                            <td>
                                2021-06-30
                            </td>
                            <td>
                                <span class="badge badge-warning">Delivering</span>
                            </td>
                            <td class="text-right">
                                <a class="btn btn-primary btn-sm" href="@Url.Action("Details")">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="@Url.Action("Edit")">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#DeleteModal">
                                    <i class="fas fa-trash">
                                    </i>
                                    Cancel
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Are you sure you want to cancel D/O05-001?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" id="ok-btn" class="btn btn-danger" onclick="SuccessAlert();" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>

@section Scripts{
    <!-- DataTables  & Plugins -->
    <script src="~/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="~/lib/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="~/lib/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="~/lib/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="~/lib/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="~/lib/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="~/lib/jszip/jszip.min.js"></script>
    <script src="~/lib/pdfmake/pdfmake.min.js"></script>
    <script src="~/lib/pdfmake/vfs_fonts.js"></script>
    <script src="~/lib/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="~/lib/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="~/lib/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            $("table").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "columnDefs": [
                    {
                        "targets": 4,
                        "className": 'noVis',
                        "orderable": 'false'
                    }
                ],
            }).buttons().container().appendTo('#DataTables_Table_0_wrapper .col-md-6:eq(0)');

            @{
                if (TempData["Edit"] != null)
                {
                    @:Toast.fire({
                        @:icon: 'success',
                        @:title: 'Delivery Order updated successfully.'
                    @:})
                }

                if (TempData["Create"] != null)
                {
                    @:Toast.fire({
                        @:icon: 'success',
                        @:title: 'Delivery Order created successfully.'
                    @:})
                }
            }
        })

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        function SuccessAlert() {
            Toast.fire({
                icon: 'success',
                title: 'Delivery Order canceled successfully.'
            })
        }
    </script>
}