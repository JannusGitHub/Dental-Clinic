<?php
    include('../includes/header.php');
    include('../includes/auth_session.php');
    
    include('../includes/sidebar.php');

    //pass this value to sidebar.php .nav-item to active the class and highlight
    $page ='patient_appointment';

    include('connection.php');

    //fetch data from the database of user table and pass the value inside the select tag, where user_role is dentist
    $dentistQuery = "SELECT * FROM user_table WHERE user_role = 'dentist'";
    $dentistResult = $connection->query($dentistQuery);

    //fetch data from the database of patient table and pass the value inside the select tag
    $patientQuery = "SELECT * FROM patient_table";
    $patientResult = $connection->query($patientQuery);
?>

    <main>
        <!-- <div class="container-fluid text-right my-2">
            <button type="button" class="btn button" id="add" data-toggle="modal" data-target="#patientAppointmentModal">
                Add Appointment
            </button>
        </div> -->

        <!-- Add Modal -->
        <div class="modal fade" id="patientAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Appointment Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="patientAppointmentForm">
                            <h5>Appointment Information</h5>

                            <input type="hidden" id="editRowID" value="0"> 

                            <div class="form-group">     
                                <input type="text" id="doctor-name" class="form-control" style="width: 100%; height: 40px;" required>
                                <!-- <select name="" id="doctor-name" style="width: 100%; height: 40px;">
                                        <option></option>
                                </select>                 -->
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="title" required>                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="start-time" required>                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="end-time" required>                    
                            </div>
                            <hr>
                            <h5>Patient Information</h5>
                            <div class="form-group">
                                <input type="text" id="patient-name" class="form-control" style="width: 100%; height: 40px;" required>
                                <!-- <select name="" id="patient-name" style="width: 100%; height: 40px;">
                                        <option value=""></option>
                                </select> -->
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="mobile-number">                    
                            </div>
                            <div class="form-group">                                
                                <select id="status" style="width: 100%; height: 40px;">
                                    <option value="Appointment Approved">Appointment Approved</option>
                                    <option value="Appointment Disapproved">Appointment Disapproved</option>
                                </select>                    
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="saveBtn" class="btn button saveBtn" id="saveBtn" onclick="saveData()" value="Save">
                        <button type="button" name="closeBtn" id="closeBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- Modal ends -->

        <!-- Table starts -->
        <div class="container-fluid mt-4">
            <table class="table table-hover table-responsive" id="patientAppointmentTable">
                <thead class="table-head">
                    <tr>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Appointment Title</th>
                        <th>Appointment Start</th>
                        <th>Appointment End</th>
                        <th>Patient Name</th>
                        <th>Patient Mobile</th> 
                        <th >Status</th>
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

        
        // $('#add').on('click', function(){
            //if Add Appointment button is clicked, then change the saveBtn value to Save
            //and change the onclick function to manageData('addNew') to add new data
            // $(".saveBtn").val('Save').attr('onclick', "manageData('addNew')");

            //reset the fields value
            // $("#patientAppointmentForm").trigger("reset");

        //remove disabled when add appointment button is clicked
            // $('#patient-name').attr('disabled', false);

            //change the modal-header BG, modal-title text color, modal-title text & show modal
        //     $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
        //     $(".modal-title").css( "color", "white" );
        //     $(".modal-title").text("Add Appointment");
        //     $('#patientAppointmentModal').modal('show');	    
        // });

    });


    //========================RELOAD/VIEW existing data==============================
    function viewData(){
        $.ajax({
            method: 'POST',
            url: 'view_appointment_server.php',
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
            $('#patientAppointmentModal').modal('hide');
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

        } else{
            caller.css('border', '');
            return true;
        }

    }
    // function isNotDate(caller) {
    //     if (Date.parse(caller) == '') {
    //         caller.css('border', '1px solid red');
    //         alert("Please fill all the required fields");
            
    //         $('#patientAppointmentForm').on('submit', function(event){
    //             event.preventDefault();
    //         });

    //         return false;
    //     } else{
    //         caller.css('border', '');
    //         return true;
    //     }
        

    // }
    // //==============================INSERT DATA==============================
    function manageData(key){
        // var doctorName = $('#doctor-name');
        // var appointmentDate = $('#appointment-date');
        // var timeslot = $('#timeslot');
        // var patientName = $('#patient-name');
        // var mobileNumber = $('#mobile-number');
        var status = $('#status');
        var editRowID = $('#editRowID');

        if(isNotEmpty(status)){
            $.ajax({
                method: 'POST',
                url: 'view_appointment_server.php',
                dataType: 'text',
                data: {
                    key: key,
                    // doctorName: doctorName.val(),
                    // appointmentDate: appointmentDate.val(),
                    // timeslot: timeslot.val(),
                    // patientName: patientName.val(),
                    // mobileNumber: mobileNumber.val(),
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
    function saveData(rowID){
        //remove disabled when add appointment button is clicked
        $('#doctor-name').attr('disabled', true);
        $('#title').attr('disabled', true);
        $('#start-time').attr('disabled', true);
        $('#end-time').attr('disabled', true);
        $('#patient-name').attr('disabled', true);
        $('#mobile-number').attr('disabled', true);
        $('#patientAppointmentModal').modal('show');
        // var rowID = $('#editRowID').val();
        $.ajax({
            method: 'POST',
            url: 'view_appointment_server.php',
            dataType: 'json',
            data: {
                key: 'getRowData',
                rowID: rowID
            },
            success: function(data){
                //catch/retrieve the data in the row
                $('#editRowID').val(rowID);
                $('#doctor-name').val(data.fullName);
                $('#title').val(data.title);
                $('#start-time').val(data.startTime);
                $('#end-time').val(data.endTime);
                $('#patient-name').val(data.patientName);
                $('#mobile-number').val(data.mobileNumber);
                $('#status').val(data.status);

                //change the modal-header BG, modal-title text color, modal-title text & the saveBtn onclick to update
                $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
                $(".modal-title").css( "color", "white" );
                $('#patientAppointmentModal').modal('show');
                $('.saveBtn').val('Update').attr('onclick', "manageData('updateRow')");

                //after the update submission, close the modal
                $('.saveBtn').attr("onclick", "manageData('updateRow')").on('click', function(){
                    setTimeout(() => {
                        $('#patientModal').modal('hide');
                    }, 400);
                });

                

                


            }
        });
        
    }


    //==============================DELETE DATA ROW==============================
    // function deleteRow(rowID){
    //     if (confirm('Are you sure?')) {
    //         $.ajax({
    //             url: 'view_appointment_server.php',
    //             method: 'POST',
    //             dataType: 'text',
    //             data: {
    //                 key: 'deleteRow',
    //                 rowID: rowID
    //             }, success: function (response) {
    //                 $("#full_name"+rowID).parent().remove();
    //                 alert(response);
    //                 viewData();
    //             }
    //         });
    //     }
    // }
</script>