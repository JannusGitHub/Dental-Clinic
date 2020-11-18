<?php
    include('../includes/header.php');
    include('../includes/auth_session.php');
    
    //pass this value to sidebar.php .nav-item to active the class and highlight
    $page ='patient_appointment';

    include('../includes/sidebar.php');

    include('connection.php');

    //fetch data from the database of user table and pass the value inside the select tag, where user_role is dentist
    $dentistQuery = "SELECT * FROM user_table WHERE user_role = 'dentist'";
    $dentistResult = $connection->query($dentistQuery);

    //fetch data from the database of patient table and pass the value inside the select tag
    $patientQuery = "SELECT * FROM patient_table";
    $patientResult = $connection->query($patientQuery);
?>

    <main>
        <div class="container-fluid text-right my-2">
            <button type="button" class="btn button" id="add" data-toggle="modal" data-target="#patientAppointmentModal">
                Add Appointment
            </button>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="patientAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="patientAppointmentForm">
                            <h5>Doctor Information</h5>
                            <div class="form-group">                             
                                <select name="" id="doctor-name" style="width: 100%; height: 40px;">
                                    <?php while($dentistRow = $dentistResult->fetch_array()):;?>
                                        <option><?php echo $dentistRow[1]; ?></option>
                                    <?php endwhile;?>
                                </select>                
                            </div>  
                            <input type="hidden" id="editRowID" value="0">                    
                            <div class="form-group">                                
                                <input type="date" class="form-control" id="appointment-date" placeholder="Appointment Date" required>                    
                            </div>
                            <div class="form-group">                                
                                <input type="time" class="form-control" id="timeslot" placeholder="Timeslot" required>                    
                            </div>
                            <hr>
                            <h5>Patient Information</h5>
                            <div class="form-group">                                
                                <select name="" id="patient-name" style="width: 100%; height: 40px;">
                                    <?php while($patientRow = $patientResult->fetch_array()):;?>
                                        <option value="<?php echo $patientRow['nickname']; ?>"><?php echo $patientRow['nickname']; ?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="mobile-number" placeholder="Mobile #">                    
                            </div>
                            <div class="form-group">                                
                                <select id="status" style="width: 100%; height: 40px;">
                                    <option value="Appointment Approved">Appointment Approved</option>
                                    <option value="Appointment Disapproved">Appointment Disapproved</option>
                                </select>                    
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="saveBtn" class="btn button saveBtn" id="manageBtn" onclick="manageData('addNew')" value="Save">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form> <!-- This solves my problem -->
                </div>
            </div>
        </div> <!-- Modal ends -->

        <!-- Table starts -->
        <div class="container-fluid">
            <table class="table table-hover table-responsive" id="patientAppointmentTable">
                <thead class="table-head">
                    <tr>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Dentist</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Patient Name</th>
                        <th>Patient Mobile</th>
                        <th style="max-width: 200px; width: 200px;">Status</th>
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
            //if Add Appointment button is clicked, then change the saveBtn value to Save
            //and change the onclick function to manageData('addNew') to add new data
            $(".saveBtn").val('Save').attr('onclick', "manageData('addNew')");

            //reset the fields value
            $("#patientAppointmentForm").trigger("reset");

            //change the modal-header BG, modal-title text color, modal-title text & show modal
            $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
            $(".modal-title").css( "color", "white" );
            $(".modal-title").text("Add Appointment");
            $('#patientAppointmentModal').modal('show');	    
        });

    });


    //========================RELOAD/VIEW existing data==============================
    function viewData(){
        $.ajax({
            method: 'POST',
            url: 'appointment_server.php',
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
    $('#patientAppointmentForm').on('submit', function(event){
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

            $('#patientAppointmentForm').on('submit', function(event){
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
        var doctorName = $('#doctor-name');
        var appointmentDate = $('#appointment-date');
        var timeslot = $('#timeslot');
        var patientName = $('#patient-name');
        var mobileNumber = $('#mobile-number');
        var status = $('#status');
        var editRowID = $('#editRowID');

        if(isNotEmpty(doctorName) && isNotDate(appointmentDate) && isNotEmpty(patientName) && isNotEmpty(mobileNumber) && isNotEmpty(status)){
            $.ajax({
                method: 'POST',
                url: 'appointment_server.php',
                dataType: 'text',
                data: {
                    key: key,
                    doctorName: doctorName.val(),
                    appointmentDate: appointmentDate.val(),
                    timeslot: timeslot.val(),
                    patientName: patientName.val(),
                    mobileNumber: mobileNumber.val(),
                    status: status.val(),
                    rowID: editRowID.val()
                },
                success: function(data){
                    if(data != "Successfully Inserted"){
                        alert(data);
                        $("#patientAppointmentModal").modal('show');
                    }
                    else{
                        //close the modal after the insert and reload data
                        $("#patientAppointmentModal").modal('hide');
                        viewData();
                    }

                }
            });
        }
    }


    //==============================UPDATE DATA==============================
    //UPDATE/getRowData and change the saveBtn onclick to manageData('updateRow')
    function edit(rowID){
        $('#patientAppointmentModal').modal('show');
        $.ajax({
            method: 'POST',
            url: 'appointment_server.php',
            dataType: 'json',
            data: {
                key: 'getRowData',
                rowID: rowID
            },
            success: function(data){
                //catch/retrieve the data in the row
                $('#editRowID').val(rowID);
                $('#doctor-name').val(data.fullName);
                $('#appointment-date').val(data.appointmentDate);
                $('#timeslot').val(data.timeslot);
                $('#patient-name').val(data.patientName);
                $('#mobile-number').val(data.mobileNumber);
                $('#status').val(data.status);

                //change the modal-header BG, modal-title text color, modal-title text & the saveBtn onclick to update
                $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
                $(".modal-title").css( "color", "white" );
                $(".modal-title").text("Edit Appointment");
                $('.saveBtn').val('Update').attr('onclick', "manageData('updateRow')");

                //after the update submission, close the modal
                $('.saveBtn').attr("onclick", "manageData('updateRow')").on('click', function(){
                    setTimeout(() => {
                        $('#patientAppointmentModal').modal('hide');
                    }, 400);
                });
            }
        });
        
    }


    //==============================DELETE DATA ROW==============================
    function deleteRow(rowID){
    if (confirm('Are you sure?')) {
        $.ajax({
            url: 'appointment_server.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID
            }, success: function (response) {
                $("#full_name"+rowID).parent().remove();
                alert(response);
                viewData();
            }
        });
    }
        
    }
</script>