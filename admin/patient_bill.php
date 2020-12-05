<?php
    require('connection.php');
    include('../includes/auth_session.php');
    include('../includes/header.php');
        
    include('../includes/sidebar.php');
    //pass this value to sidebar.php .nav-item to active the class and highlight
    $page = 'patient_bill';
    
    //fetch data of nickname from the database of patient table and pass the value inside the select tag
    $patientQuery = "SELECT * FROM patient_table";
    $patientResult = $connection->query($patientQuery);
?>


    <main class="main">
        <div class="container-fluid text-right my-2">
            <button type="button" class="btn button" id="add" data-toggle="modal" data-target="#patientBillModal">
                Add Patient Bill
            </button>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="patientBillModal" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="patientBillForm">
                            <div class="form-group">                                
                                <select name="" id="patient-name" style="width: 100%; height: 40px;">
                                    <?php while($patientRow = $patientResult->fetch_array()):;?>
                                        <option><?php echo $patientRow['nickname']; ?></option>
                                    <?php endwhile;?>
                                </select>    
                            </div>  
                            <input type="hidden" id="editRowID" value="0">                    
                            <div class="form-group">                                
                                <input type="date" class="form-control" id="bill-date" placeholder="Bill Date">                    
                            </div>
                            <div class="form-group">
                                <select name="" id="bill-type" style="width: 100%; height: 40px;">
                                    <option value="Treatment">Treatment</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Appointment">Appointment</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="payment-mode" placeholder="Payment Mode">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="amount-charge" placeholder="Amount Charge">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="amount-paid" placeholder="Amout Paid">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="balance" placeholder="Balance">                    
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="saveBtn" class="btn button saveBtn" id="manageBtn" onclick="manageData('addNew')" value="Save">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> <!-- Modal ends -->

        <!-- Table starts -->
        <div class="container-fluid">
            <table class="table" id="patientTable">
                <thead class="table-head">
                    <tr>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Bill Date</th>
                        <th>Bill Type</th>
                        <th>Payment Mode</th>
                        <th>Amount Charge</th>
                        <th>Amout Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead>

                <tbody class="tbody">
                </tbody>
            </table>
        </div>
        <!-- Table ends -->
    </main>


<!--Include the script first, before using any jquery script-->
<?php include('../includes/script.php') ?>


<!--Include footer-->
<?php
    include('../includes/footer.php');
?>


<script>
    $(document).ready(function() {
        //execute the viewData() function to reload data asynchronously when document is ready
        viewData();
        

        $('#add').on('click', function(){
            //if Add Patient button is clicked, then change the saveBtn value to Save
            //and change the onclick function to manageData('addNew') to add new data
            $(".saveBtn").val('Save').attr('onclick', "manageData('addNew')");

            //reset the fields value
            $("#patientBillForm").trigger("reset");

            //remove disabled when add appointment button is clicked
            $('#patient-name').attr('disabled', false);

            //change the modal-header BG, modal-title text color, modal-title text & show modal
            $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
            $(".modal-title").css( "color", "white" );
            $(".modal-title").text("Add Patient Bill");
            $('#patientBillModal').modal('show');	    
        });
    });


    //========================RELOAD/VIEW existing data==============================
    function viewData(){
        $.ajax({
            method: 'POST',
            url: 'patient_bill_server.php',
            dataType: 'text',
            data: {
                key: 'viewData'
            },
            success: function(response){
                $('.tbody').html(response);
                $(".table").DataTable();
            }
        });
    }


    //Solves my problem using setTimeout <3
    //cancel the default submission of the form & execute the viewData() function to reload data asynchronously
    $('#patientBillForm').on('submit', function(event){
        event.preventDefault();
        setTimeout(() => {
            viewData();
        }, 1000);
    });


    //==========================VALIDATION==============================
    function isNotEmpty(caller) {
        if (caller.val() == '') {
            caller.css('border', '1px solid red');
            alert("Please fill all the required fields");

            $('#patientBillForm').on('submit', function(event){
                event.preventDefault();
            });

            return false;

        } else
            caller.css('border', '');

        return true;
    }
    function isNotDate(caller) {
        if (Date.parse(caller) == '') {
            caller.css('border', '1px solid red');
            return false;
        } else
        
            caller.css('border', '');

        return true;
    }
    //==============================INSERT DATA==============================
    function manageData(key){
        var patientName = $('#patient-name');
        var billDate = $('#bill-date');
        var billType = $('#bill-type');
        var paymentMode = $('#payment-mode');
        var amountCharge = $('#amount-charge');
        var amountPaid = $('#amount-paid');
        var balance = $('#balance');
        var editRowID = $('#editRowID');

        if(isNotEmpty(billDate) && isNotEmpty(billType) && isNotEmpty(paymentMode)
        && isNotEmpty(amountCharge) && isNotEmpty(amountPaid) && isNotEmpty(balance)){
            $.ajax({
                method: 'POST',
                url: 'patient_bill_server.php',
                dataType: 'text',
                data: {
                    key: key,
                    patientName: patientName.val(),
                    billDate: billDate.val(),
                    billType: billType.val(),
                    paymentMode: paymentMode.val(),
                    amountCharge: amountCharge.val(),
                    amountPaid: amountPaid.val(),
                    balance: balance.val(),
                    rowID: editRowID.val()
                },
                success: function(data){
                    if(data != "Successfully Inserted"){
                        alert(data);
                        $("#patientBillModal").modal('show');
                    }
                    else{
                        //close the modal after the insert and reload data
                        $("#patientBillModal").modal('hide');
                        viewData();
                    }
                }
            });
        }
    }


    //==============================UPDATE DATA==============================
    //UPDATE/getRowData and change the saveBtn onclick to manageData('updateRow')
    function edit(rowID){
        $('#patientBillModal').modal('show');
        //remove disabled when add appointment button is clicked
        $('#patient-name').attr('disabled', true);
        
        //change the modal-header BG, modal-title text color, modal-title text & the saveBtn onclick to update
        $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
        $(".modal-title").css( "color", "white" );
        $(".modal-title").text("Edit Patient Bill");
        $('.saveBtn').val('Update').attr('onclick', "manageData('updateRow')");
        $.ajax({
            method: 'POST',
            url: 'patient_bill_server.php',
            dataType: 'json',
            data: {
                key: 'getRowData',
                rowID: rowID
            },
            success: function(data){
                //catch/retrieve the data in the row
                $('#editRowID').val(rowID);
                $('#patient-name').val(data.patientName);
                $('#bill-date').val(data.billDate);
                $('#bill-type').val(data.billType);
                $('#payment-mode').val(data.paymentMode);
                $('#amount-charge').val(data.amountCharge);
                $('#amount-paid').val(data.amountPaid);
                $('#balance').val(data.balance);


                //after the update submission, close the modal
                $('.saveBtn').attr("onclick", "manageData('updateRow')").on('click', function(){
                    setTimeout(() => {
                        $('#patientBillModal').modal('hide');
                    }, 400);
                });
            }
        });
    }


    //==============================DELETE DATA ROW==============================
    function deleteRow(rowID){
        if (confirm('Are you sure?')) {
            $.ajax({
                url: 'patient_bill_server.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'deleteRow',
                    rowID: rowID
                }, success: function (response) {
                    $("#bill_date"+rowID).parent().remove();
                    alert(response);
                    viewData();
                }
            });
        }
    }
</script>