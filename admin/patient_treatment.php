<?php
    require('connection.php');
    include('../includes/auth_session.php');
    include('../includes/header.php');
        
    include('../includes/sidebar.php');
    //pass this value to sidebar.php .nav-item to active the class and highlight
    $page = 'patient_treatment';
    
    //fetch data from the database of patient table and pass the value inside the select tag
    $patientQuery = "SELECT * FROM patient_table";
    $patientResult = $connection->query($patientQuery);
?>


    <main class="main">
        <div class="container-fluid text-right my-2">
            <button type="button" class="btn button" id="add" data-toggle="modal" data-target="#patientTreatmentModal">
                Add Patient Treatment
            </button>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="patientTreatmentModal" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="patientTreatmentForm">
                            <div class="form-group">                                
                                <select name="" id="patient-name" style="width: 100%; height: 40px;">
                                    <?php while($patientRow = $patientResult->fetch_array()):;?>
                                        <option><?php echo $patientRow['nickname']; ?></option>
                                    <?php endwhile;?>
                                </select>    
                            </div>  
                            <input type="hidden" id="editRowID" value="0">                    
                            <div class="form-group">                                
                                <input type="date" class="form-control" id="treatment-date" placeholder="Treatment Date">                    
                            </div>
                            <div class="form-group">                                
                                <input type="number" class="form-control" id="tooth-number" placeholder="Tooth Number">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="findings" placeholder="Findings">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="procedures" placeholder="Procedures">                    
                            </div>
                            <div class="form-group">                                
                                <textarea class="form-control" id="description" cols="30" rows="2" placeholder="Description"></textarea>               
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
            <table class="table table-hover table-responsive" id="patientTable">
                <thead class="table-head">
                    <tr>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Treatment Date</th>
                        <th>Tooth Number</th>
                        <th style="width: 160px;">Findings</th>
                        <th style="width: 160px;">Procedures</th>
                        <th style="width: 200px;">Description</th>
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
            $("#patientTreatmentForm").trigger("reset");

            //change the modal-header BG, modal-title text color, modal-title text & show modal
            $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
            $(".modal-title").css( "color", "white" );
            $(".modal-title").text("Add Patient Treatment");
            $('#patientTreatmentModal').modal('show');	    
        });
    });


    //========================RELOAD/VIEW existing data==============================
    function viewData(){
        $.ajax({
            method: 'POST',
            url: 'patient_treatment_server.php',
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
    $('#patientTreatmentForm').on('submit', function(event){
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

            $('#patientForm').on('submit', function(event){
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
        var treatmentDate = $('#treatment-date');
        var toothNumber = $('#tooth-number');
        var findings = $('#findings');
        var procedures = $('#procedures');
        var description = $('#description');
        var editRowID = $('#editRowID');

        if(isNotEmpty(treatmentDate) && isNotEmpty(toothNumber) && isNotEmpty(findings)
        && isNotEmpty(procedures) && isNotEmpty(description)){
            $.ajax({
                method: 'POST',
                url: 'patient_treatment_server.php',
                dataType: 'text',
                data: {
                    key: key,
                    patientName: patientName.val(),
                    treatmentDate: treatmentDate.val(),
                    toothNumber: toothNumber.val(),
                    findings: findings.val(),
                    procedures: procedures.val(),
                    description: description.val(),
                    rowID: editRowID.val()
                },
                success: function(data){
                    if(data != "Successfully Inserted"){
                        alert(data);
                        $("#patientTreatmentModal").modal('show');
                    }
                    else{
                        //close the modal after the insert and reload data
                        $("#patientTreatmentModal").modal('hide');
                        viewData();
                    }
                }
            });
        }
    }


    //==============================UPDATE DATA==============================
    //UPDATE/getRowData and change the saveBtn onclick to manageData('updateRow')
    function edit(rowID){
        $('#patientTreatmentModal').modal('show');
        
        //change the modal-header BG, modal-title text color, modal-title text & the saveBtn onclick to update
        $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
        $(".modal-title").css( "color", "white" );
        $(".modal-title").text("Edit Patient Treatment");
        $('.saveBtn').val('Update').attr('onclick', "manageData('updateRow')");
        $.ajax({
            method: 'POST',
            url: 'patient_treatment_server.php',
            dataType: 'json',
            data: {
                key: 'getRowData',
                rowID: rowID
            },
            success: function(data){
                //catch/retrieve the data in the row
                $('#editRowID').val(rowID);
                $('#patient-name').val(data.patientName);
                $('#treatment-date').val(data.treatmentDate);
                $('#tooth-number').val(data.toothNumber);
                $('#findings').val(data.findings);
                $('#procedures').val(data.procedures);
                $('#description').val(data.description);


                //after the update submission, close the modal
                $('.saveBtn').attr("onclick", "manageData('updateRow')").on('click', function(){
                    setTimeout(() => {
                        $('#patientTreatmentModal').modal('hide');
                    }, 400);
                });
            }
        });
        
    }


    //==============================DELETE DATA ROW==============================
    function deleteRow(rowID){
        if (confirm('Are you sure?')) {
            $.ajax({
                url: 'patient_treatment_server.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'deleteRow',
                    rowID: rowID
                }, success: function (response) {
                    $("#treatment_date"+rowID).parent().remove();
                    alert(response);
                    viewData();
                }
            });
        }
        
    }
</script>