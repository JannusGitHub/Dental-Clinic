<?php 
    require('connection.php');
    require('../includes/auth_session.php');


    //fetch data from the database of user table and pass the value inside the select tag, where user_role is dentist
    $dentistQuery = "SELECT * FROM user_table WHERE user_role = 'dentist'";
    $dentistResult = $connection->query($dentistQuery);

    //fetch data from the database of patient table and pass the value inside the select tag
    $patientQuery = "SELECT * FROM patient_table";
    $patientResult = $connection->query($patientQuery);

    //pass this value to sidebar.php .nav-item to active the class and highlight
    $page ='view_appointment';
?>

<?php 
    if(!isset($_SESSION['user']))
    {
        $_SESSION['user'] = session_id(); //generate current session_id for the current user
    }
    $session_uid = $_SESSION['user'];  // set session user to session_uid  
    $datetime_string = date('c',time()); 

    $user_id = $_SESSION['user_id'];
    $patientName = $_SESSION['nickname'];
    $patientMobileNumber = $_SESSION['patientMobileNumber'];
    $status = 'Pending'; //default values of Status
    
    if(isset($_POST['action']) or isset($_GET['view'])){
        if(isset($_GET['view'])){
            header('Content-Type: application/json');
            $start = $connection->real_escape_string($_GET["start"]);
            $end = $connection->real_escape_string($_GET["end"]);
            
            $result = $connection->query("SELECT id, title, start_time, end_time FROM appointment_table WHERE (date(start_time) >= '".$start."' AND date(start_time) <= '".$end."') AND session_uid='".$session_uid."'");
            
            while($row = mysqli_fetch_assoc($result)){
                $events[] = $row; 
            }
            echo json_encode($events); 
            exit;
        }
        elseif($_POST['action'] == "add"){
            $doctorName = $connection->real_escape_string($_POST["doctorName"]);
            $connection->query("INSERT INTO appointment_table (
                title,
                start_time,
                end_time,
                patient_name,
                patient_mobile_number,
                status,
                session_uid,
                user_id,
                patient_id
                )
                VALUES (
                '".mysqli_real_escape_string($connection,$_POST["title"])."',
                '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."',
                '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."',
                '".mysqli_real_escape_string($connection,$patientName)."',
                '".mysqli_real_escape_string($connection,$patientMobileNumber)."',
                '".mysqli_real_escape_string($connection,$status)."',
                '".mysqli_real_escape_string($connection,$session_uid)."',
                (SELECT id FROM user_table WHERE full_name = '$doctorName'),
                (SELECT id FROM patient_table WHERE nickname = '$patientName')
                )");
            header('Content-Type: application/json');
            // echo '{"id":"'.mysqli_insert_id($connection).'"}';
            echo "1";
            exit;
        }
        // elseif($_POST['action'] == "update"){
        //     $connection->query("UPDATE appointment_table set 
        //         title = '".mysqli_real_escape_string($connection,$_POST["title"])."', 
        //         start_time = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
        //         end_time = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."',
        //         where session_uid = '".mysqli_real_escape_string($connection,$session_uid)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
        //     exit;
        // }
        elseif($_POST['action'] == "delete"){
            $connection->query("DELETE from appointment_table where session_uid = '".mysqli_real_escape_string($connection,$session_uid)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
            if (mysqli_affected_rows($connection) > 0) {
                echo "1";
            }
            exit;
        }
    }
    
?>


<?php 
    include('../includes/header.php');
    include('../includes/sidebar.php');
?>


    <!--FullCalendar Plugins-->
    <link rel="stylesheet" href="../css/fullcalendar.css">
    
    
    <main>
        <!-- Tabs Starts -->
        <div class="container">
            <div class="patientAppointmentTabs">
                <ul class="nav nav-tabs" id="nav-tabs">
                    <li class="nav-item active">
                        <a href="#new-appointment-tab" class="nav-link active" data-toggle="tab"><i class="far fa-calendar-plus text-primary"></i> New Appointment</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="#cancelled-appointment-tab" class="nav-link" data-toggle="tab"><i class="far fa-calendar-times text-danger"></i> Cancelled Request</a>
                    </li> -->
                </ul>


                <!-- Calendar Starts -->
                <div class="tab-content">
                    <!--New Appointment Tab Start-->
                    <div class="tab-pane fade show active" id="new-appointment-tab">
                        <div class="mb-3"></div>
                        <p class="d-flex align-items-center"><i class="fas fa-info-circle fa-2x icon align-items-center"></i>&nbsp;Note: </p>
                        <p>Select the available Date and Time on the Calendar then select the Appointment Title, Doctor and When, then click Submit button to complete online appointment. If you want to see the Appointment Details, just click the Appointment.</p>

                        <div class="container mt-5">
                            <div class="row px-2">
                                <label class="mb-3" for="calendar"><strong>Choose your appointment slot</strong></label>
                                <div id="calendar">
                                
                                </div>
                                    
                            </div>
                        </div>

                        <!--Modal Content Start-->
                        <div id="createAppointmentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Appointment</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label" for="title"><strong>Select Services</strong></label>
                                            <select name="title" id="title" style="width: 100%; height: 40px;">
                                                <option value="Consultations">Consultations</option>
                                                <option value="Dental Treatments">Dental Treatments</option>
                                                <option value="Periodontal Treatments">Periodontal Treatments</option>
                                                <option value="Cosmetic Dental Treatments">Cosmetic Dental Treatments</option>
                                                <option value="Dentures">Dentures</option>
                                            </select>
                                                <!-- <input type="text" class="form-control" id="title" name="title" placeholder="Appointment Title"> -->
                                        </div>


                                        <div class="form-group">
                                            <label for="mobile-number"><strong>Select doctor</strong></label>
                                            <select name="" id="doctor-name" style="width: 100%; height: 40px;">
                                                <?php while($dentistRow = $dentistResult->fetch_array()):;?>
                                                    <option><?php echo $dentistRow[1]; ?></option>
                                                <?php endwhile;?>
                                            </select>                
                                        </div>
                                        <hr>
                                        
                                        <input type="hidden" id="startTime"/>
                                        <input type="hidden" id="endTime"/>


                                        <!--<input type="hidden" id="patientID"/>-->

                                        <div class="control-group">
                                            <label class="control-label" for="when"><strong>When:</strong></label>
                                            <div class="controls controls-row" id="when" style="margin-top:5px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button type="submit" name="saveBtn" class="btn button" id="submitBtn" >Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="calendarModal" class="modal fade">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Appointment Details</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div id="modalBody" class="modal-body">
                                        <h4 id="modalTitle" class="modal-title"></h4>
                                        <div id="modalWhen" style="margin-top:5px;"></div>
                                    </div>

                                    <input type="hidden" id="eventID"/>
                                    
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button type="submit" class="btn btn-danger" id="deleteBtn">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--Modal Content End-->
                    </div><!--New Appointment Tab End-->

                    <!-- <div class="tab-pane fade" id="cancelled-appointment-tab">
                        <p><i class="fas fa-info-circle icon mt-3"></i> Note: </p>
                        <p>On this tab, you will see the Cancelled Request with your Information and Appointment Details you cancelled in table format for easily viewing of your Cancelled Request history.</p>
                    </div> -->
                </div><!-- Calendar Ends -->
                
            </div>
        </div>
        <!-- Tabs Ends -->
    </main>


    <style>
        .patientAppointmentTabs{
            margin: 5px 0 5px;
            padding: 5px;
        }

        #nav-tabs a{
            color: black;
        }
        
        /* Full Calendar Styling */
        .fc-event, .fc-event-dot {
            background: linear-gradient(#00c6ff, #0072ff);
        }

        .fc-event {
            border: none !important;
        }

        /* .fc-icon-left-single-arrow:after {
            color: black;
        }
        .fc-icon-right-single-arrow:after {
            color: black;
        } */

        /* span{
            color: #fff;
        } */

        #nav-tabs li:active{
            background: #dee2e6;
        }

        .tab-content .tab-pane{
            padding-top: 5px;
            padding-left: 10px;
            border-left: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
        }
        
        .container{
            padding-left: 5px;
        }
    </style>


    <!--Include the script first, before using any jquery script-->
    <?php include('../includes/script.php') ?>

    <script src="../js/moment.min.js"></script>
    <script src="../js/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" crossorigin="anonymous"></script>

    
    <script>
        $(document).ready(function(){
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay'
                },
                defaultView: 'agendaWeek',
                editable: true,
                selectable: true,
                allDaySlot: false,
                selectHelper: true,
                // startTime: "08:00:00",
                // endTime: "05:00:00",
                slotDuration: '00:30:00',
                // scrollTime: '06:00:00',
                events: 'appointment_load.php',

                //show the modal Appointment Details, you can View or Delete
                eventClick: function(event, jsEvent, view){
                    startTime = $.fullCalendar.moment(event.start).format('ddd, MMM Do h:mm A');
                    endTime = $.fullCalendar.moment(event.end).format('ddd, MMM Do h:mm A - YYYY');
                    var when = startTime + ' to ' + endTime;
                    $('#modalTitle').html(event.title);
                    $('#modalWhen').text(when);
                    $('#patientID').text(when);
                    $('#eventID').val(event.id);
                    $('#calendarModal').modal('show');
                },

                //show the modal Add Appointment, you can Add an appointment
                select: function(start, end, jsEvent){
                        startTime = $.fullCalendar.moment(start).format('dddd, MMM Do, h:mm A');
                        endTime = $.fullCalendar.moment(end).format('dddd, MMM Do, h:mm A - YYYY');
                        var when = startTime + ' to ' + endTime;
                        start = moment(start).format();
                        end = moment(end).format();
                        $('#createAppointmentModal #startTime').val(start);
                        $('#createAppointmentModal #endTime').val(end);
                        $('#createAppointmentModal #when').text(when);
                        $('#createAppointmentModal').modal('toggle');
                },
                eventDrop: function(event, delta){
                    var id = event.id;
                    var title = event.title;
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    
                    $.ajax({
                        url:"appointment_update.php",
                        type:"POST",
                        data:{id:id, title:title, start:start, end:end},
                        success:function(){
                            calendar.fullCalendar('refetchEvents');
                            alert('Successfully Updated');
                        }
                    });
                    // $.ajax({
                    //     url: 'patient_appointment.php',
                    //     data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id ,
                    //     type: "POST",
                    //     success: function(json) {
                    //         console.log(json);
                    //     }
                    // });
                },
                eventResize: function(event) {
                    var id = event.id;
                    var title = event.title;
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    
                    $.ajax({
                        url:"appointment_update.php",
                        type:"POST",
                        data:{id:id, title:title, start:start, end:end},
                        success:function(){
                            calendar.fullCalendar('refetchEvents');
                            alert('Successfully Updated');
                        }
                    });
                //     $.ajax({
                //         url: 'patient_appointment.php',
                //         data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id,
                //         type: "POST",
                //         success: function(json) {
                //             console.log(json);
                //         }
                //     });
                }
            });

            $('#submitBtn').on('click', function(e){
                var title = $('#title').val();

                if(title != ""){
                    e.preventDefault();
                    doSubmit();
                    alert("Successfully Inserted");
                }else{
                    alert("Please fill the Appointment Title");
                }
            });
            
            $('#deleteBtn').on('click', function(e){
                // We don't want this to act as a link so cancel the link action
                e.preventDefault();
                doDelete();
            });

            function doDelete(){
                $("#calendarModal").modal('hide');
                var eventID = $('#eventID').val();
                $.ajax({
                    url: 'patient_appointment.php',
                    data: 'action=delete&id='+eventID,
                    type: "POST",
                    success: function(json) {
                        if(json == 1){
                            // var url = "/Dental-Clinic/admin/patient_appointment.php";
                            // $(location).attr('href',url);
                            calendar.fullCalendar('removeEvents',eventID);
                            window.location.href = '/Dental-Clinic/admin/patient_appointment.php';
                            
                        }
                        else
                            return false;
                    }
                });
            }

            function doSubmit(){
                $("#createAppointmentModal").modal('hide');
                var title = $('#title').val();
                var startTime = $('#startTime').val();
                var endTime = $('#endTime').val();
                var doctorName = $('#doctor-name').val();

                $.ajax({
                    url: 'patient_appointment.php',
                    data: 'action=add&title='+title+'&start='+startTime+'&end='+endTime+'&doctorName='+doctorName,
                    type: "POST",
                    success: function(json) {

                        if(json == 1){
                            calendar.fullCalendar('renderEvent',{
                                id: json.id,
                                title: title,
                                start: startTime,
                                end: endTime,
                            }, true);
                        }
                        else{
                            return false;
                        }
                    }
                });
                
            }
        });
    </script>


<!--Include footer-->
<?php
    include('../includes/footer.php');
?>