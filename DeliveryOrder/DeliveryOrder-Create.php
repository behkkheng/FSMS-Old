
@{
    ViewData["Title"] = "New Delivery Oder";
}

<div class="row">
    <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Lean Aik Furniture
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col border-right">
                    From <a href="#" data-toggle="modal" data-target="#modal-edit-personal" class="float-right">Edit Details</a>
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
                    To <a href="#" data-toggle="modal" data-target="#modal-edit-client" class="float-right">Add Client</a>
                    <!--<address>
                            <strong>John Doe</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (555) 539-1037<br>
                            Email: john.doe@example.com
                        </address>-->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Delivery Order #05-002</b><a href="#" data-toggle="modal" data-target="#modal-edit-detail" class="float-right">Edit Details</a><br>
                    <br>
                    <b>Purchase Order:</b> <br>
                    <b>Date:</b> <br>
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
                                <td><input class="form-control w-25" style="text-align: center;" value="1" /></td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>
                            <!-- <tr>
                                <td>1</td>
                                <td>Need for Speed IV</td>
                                <td>247-925-726</td>
                                <td>Wes Anderson umami biodiesel</td>
                                <td>RM 50.00</td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Monsters DVD</td>
                                <td>735-845-642</td>
                                <td>Terry Richardson helvetica tousled street art master</td>
                                <td>RM 10.70</td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Grown Ups Blue Ray</td>
                                <td>422-568-642</td>
                                <td>Tousled lomo letterpress</td>
                                <td>RM 25.99</td>
                                <td><a href="#" class="text-danger"><i class="fas fa fa-trash-alt"></i></a></td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <p><button type="button" class="btn btn-light"><i class="fas fa fa-plus-circle"></i> Add Product</button></p>

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="@Url.Action("Details", new { id= 1 })" class="btn btn-success float-right"><i class="far fa-save"></i> Save D/O</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.invoice -->

<div class="modal fade" id="modal-edit-personal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="personal-name" class="col-sm-2 col-form-label">Name : </label>
                        <div class="col-sm-10"><input id="personal-name" class="form-control" value="Lean Aik Furniture" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="personal-address1" class="col-sm-2 col-form-label">Address : </label>
                        <div class="col-sm-10"><input id="personal-address1" class="form-control" value="4995" /></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2"><input id="personal-address2" class="form-control" value="Jalan New Ferry" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="personal-postcode" class="col-sm-2 col-form-label">Postcode : </label>
                        <div class="col-sm-10"><input id="personal-postcode" class="form-control" value="12100" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="personal-city" class="col-sm-2 col-form-label">City : </label>
                        <div class="col-sm-10"><input id="personal-city" class="form-control" value="Butterworth" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="personal-state" class="col-sm-2 col-form-label">State : </label>
                        <div class="col-sm-10"><input id="personal-state" class="form-control" value="Penang" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="personal-phone" class="col-sm-2 col-form-label">Phone No : </label>
                        <div class="col-sm-10"><input id="personal-phone" class="form-control" value="0124543360" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="personal-email" class="col-sm-2 col-form-label">Email : </label>
                        <div class="col-sm-10"><input id="personal-email" class="form-control" value="info@leanaikfurniture.com" /></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-edit-client">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="client-name" class="col-sm-2 col-form-label">Name : </label>
                        <div class="col-sm-10"><input id="client-name" class="form-control" data-val="true" data-val-required="This field is required." /></div>
                    </div>
                    <div class="form-group row">
                        <label for="client-address1" class="col-sm-2 col-form-label">Address : </label>
                        <div class="col-sm-10"><input id="client-address1" class="form-control" data-val="true" data-val-required="This field is required." /></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2"><input id="client-address2" class="form-control" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="client-postcode" class="col-sm-2 col-form-label">Postcode : </label>
                        <div class="col-sm-10"><input id="client-postcode" class="form-control" data-val="true" data-val-required="This field is required." /></div>
                    </div>
                    <div class="form-group row">
                        <label for="client-city" class="col-sm-2 col-form-label">City : </label>
                        <div class="col-sm-10"><input id="client-city" class="form-control" data-val="true" data-val-required="This field is required." /></div>
                    </div>
                    <div class="form-group row">
                        <label for="client-state" class="col-sm-2 col-form-label">State : </label>
                        <div class="col-sm-10"><input id="client-state" class="form-control" data-val="true" data-val-required="This field is required." /></div>
                    </div>
                    <div class="form-group row">
                        <label for="client-phone" class="col-sm-2 col-form-label">Phone No : </label>
                        <div class="col-sm-10"><input id="client-phone" class="form-control" data-val="true" data-val-required="This field is required." /></div>
                    </div>
                    <div class="form-group row">
                        <label for="client-email" class="col-sm-2 col-form-label">Email : </label>
                        <div class="col-sm-10"><input id="client-email" class="form-control" data-val="true" data-val-required="This field is required." /></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-edit-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Purchase Order : </label>
                        <div class="col-sm-9"><input id="purchase" class="form-control" value="" placeholder="2201-001" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date : </label>
                        <div class="col-sm-9"><input id="date" class="form-control" placeholder="01/01/2021" /></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@section Scripts{
    <script type="text/javascript">
        $("#date").datepicker({ dateFormat: 'dd/mm/yy' });

        $('form').valida
    </script>
}
