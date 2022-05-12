
@{
    ViewData["Title"] = "Details";
}


<div class="row">
    <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row d-print-none">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Lean Aik Furniture
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <div class="row justify-content-center d-none d-print-block">
                <div class="col-auto">
                    <h4 class="text-center"><b>LEAN AIK FURNITURE</b></h4>
                    <h6 class="text-center">4995,TINGKAT BAWAH, JALAN NEW FERRY</h6>
                    <h6 class="text-center">12100 BUTTERWORTH, P. PINANG</h6>
                    <h6 class="text-center">Tel: (60) 12-454 3360, Fax: 04-1234567</h6>
                    <h6 class="text-center">Email:  info@leanaikfurniture.com</h6>
                </div>
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col border-right">
                    From
                    <address>
                        <strong>Lean Aik Furniture</strong><br>
                        4995<br />
                        Jalan New Ferry<br />
                        12100 Butterworth<br />
                        Penang<br />
                        Phone: (60) 12-454 3360<br>
                        Email: info@leanaikfurniture.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col border-right">
                    To
                    <address>
                        <strong>Micron Memory Malaysia Sdn. Bhd</strong><br>
                        1063, Tingkat Perusahaan 6<br>
                        Kawasan Perusahaan Bebas Perai<br>
                        13600 Perai<br>
                        Pulau Pinang<br>
                        Phone: (60) 4-377 0500<br>
                        Email: purchase@micron.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Delivery Order #05-001</b><br>
                    <br>
                    <b>Purchase Order:</b> 2201-001<br>
                    <b>Date:</b> 30/06/2021<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <br />
            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Serial #</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>455-981-221</td>
                                <td>Office Table</td>
                                <td>3"x4" Table</td>
                                <td>1</td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td>247-925-726</td>
                                <td>Small Cabinet</td>
                                <td>3-layer cabinet</td>
                                <td>1</td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td>735-845-642</td>
                                <td>Ergonomics Chair</td>
                                <td>Ergonomic chair with 5 rolls</td>
                                <td>1</td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td>422-568-642</td>
                                <td>Cupboard</td>
                                <td>3x3 cupborad</td>
                                <td>1</td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <br />
            <br />
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <button type="button" class="btn btn-default" onclick="printPage()"><i class="fas fa-print"></i> Print</button>
                    <a href="@Url.Action("Edit")" class="btn btn-warning"><i class="far fa-edit"></i> Edit D/O</a>
                    <button data-toggle="modal" data-target="#CompleteModal" class="btn btn-success float-right">
                        <i class="far fa-credit-card"></i> Complete Delivery
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.invoice -->

<div class="modal fade" id="CompleteModal" tabindex="-1" role="dialog" aria-labelledby="CompleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Are you sure the delivery is completed?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" id="ok-btn" class="btn btn-danger" onclick="SuccessAlert();" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>

@section Scripts{
    <script>
        $(function () {

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
                title: 'Delivery Order status updated successfully.'
            })
        }
    </script>
}