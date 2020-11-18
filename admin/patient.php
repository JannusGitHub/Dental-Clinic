<?php
    include('../includes/auth_session.php');
    include('../includes/header.php');
        
        //pass this value to sidebar.php .nav-item to active the class and highlight
    $page ='patient';

    include('../includes/sidebar.php');
?>

    <main class="main">

        <div class="container-fluid text-right my-2">
            <button type="button" class="btn button" id="add" data-toggle="modal" data-target="#patientModal">
                Add Patient
            </button>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="patientForm">
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="username" placeholder="Enter username">                    
                            </div>  
                            <input type="hidden" id="editRowID" value="0">                    
                            <div class="form-group">                                
                                <input type="password" class="form-control" id="password" placeholder="Enter password">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="birthday" placeholder="Enter birthday">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="age" placeholder="Enter age">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="mobile-number" placeholder="Enter mobile number">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="full-address" placeholder="Enter full address">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="gender" placeholder="Enter gender">                    
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="nickname" placeholder="Enter nickname">                    
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="occupation" placeholder="Enter occupation">                    
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
            <table class="table table-hover table-responsive" id="patientTable">
                <thead class="table-head">
                    <tr>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Birthday</th>
                        <th>Age</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Nickname</th>
                        <th>Occupation</th>
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
            $("#patientForm").trigger("reset");

            //change the modal-header BG, modal-title text color, modal-title text & show modal
            $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
            $(".modal-title").css( "color", "white" );
            $(".modal-title").text("Add Patient");
            $('#patientModal').modal('show');	    
        });

    });


      //========================RELOAD/VIEW existing data==============================
    function viewData(){
        $.ajax({
            method: 'POST',
            url: 'server.php',
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
    $('#patientForm').on('submit', function(event){
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
        var username = $('#username');
        var password = $('#password');
        var birthday = $('#birthday');
        var age = $('#age');
        var mobileNumber = $('#mobile-number');
        var fullAddress = $('#full-address');
        var gender = $('#gender');
        var nickname = $('#nickname');
        var occupation = $('#occupation');
        var editRowID = $('#editRowID');

        if(isNotEmpty(username) && isNotEmpty(password) && isNotEmpty(birthday)
        && isNotEmpty(age) && isNotEmpty(mobileNumber) && isNotEmpty(fullAddress) 
        && isNotEmpty(gender) && isNotEmpty(nickname) && isNotEmpty(occupation)){
            $.ajax({
                method: 'POST',
                url: 'server.php',
                dataType: 'text',
                data: {
                    key: key,
                    username: username.val(),
                    password: password.val(),
                    birthday: birthday.val(),
                    age: age.val(),
                    mobileNumber: mobileNumber.val(),
                    fullAddress: fullAddress.val(),
                    gender: gender.val(),
                    nickname: nickname.val(),
                    occupation: occupation.val(),
                    rowID: editRowID.val()
                },
                success: function(data){
                    if(data != "Successfully Inserted"){
                        alert(data);
                        $("#patientModal").modal('show');
                    }
                    else{
                        //close the modal after the insert and reload data
                        $("#patientModal").modal('hide');
                        viewData();
                    }

                }
            });
        }
    }


    //==============================UPDATE DATA==============================
    //UPDATE/getRowData and change the saveBtn onclick to manageData('updateRow')
    function edit(rowID){
        $('#patientModal').modal('show');
        $.ajax({
            method: 'POST',
            url: 'server.php',
            dataType: 'json',
            data: {
                key: 'getRowData',
                rowID: rowID
            },
            success: function(data){
                //catch/retrieve the data in the row
                $('#editRowID').val(rowID);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#birthday').val(data.birthday);
                $('#age').val(data.age);
                $('#mobile-number').val(data.mobileNumber);
                $('#full-address').val(data.fullAddress);
                $('#gender').val(data.gender);
                $('#nickname').val(data.nickname);
                $('#occupation').val(data.occupation);

                //change the modal-header BG, modal-title text color, modal-title text & the saveBtn onclick to update
                $(".modal-header").css( "background", "linear-gradient(#00c6ff, #0072ff)");
                $(".modal-title").css( "color", "white" );
                $(".modal-title").text("Edit Patient");
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
    function deleteRow(rowID){
        if (confirm('Are you sure?')) {
            $.ajax({
                url: 'server.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'deleteRow',
                    rowID: rowID
                }, success: function (response) {
                    $("#username_"+rowID).parent().remove();
                    alert(response);
                    viewData();
                }
            });
        }
        
    }


    // function refresh(){
    //     var user_id, option;
    //     option = 4;      
    //     tableUsers = $('.table').DataTable({  
    //         "ajax":{            
    //             "url": "server.php", 
    //             "method": 'POST', //we use the POST method
    //             "data":{
    //                 option:option
    //             }, //we send option 4 to make a SELECT
    //             "dataType":"json"
    //         },
    //         "columns":[
    //             {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn button btn-sm btnEdit'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnDelete'><i class='fas fa-trash-alt'></i></button></div></div>"},
    //             {"data": "id"},
    //             {"data": "username"},
    //             {"data": "password"},
    //             {"data": "birthday"},
    //             {"data": "age"},
    //             {"data": "mobile_number"},
    //             {"data": "address"},
    //             {"data": "gender"},
    //             {"data": "nickname"},
    //             {"data": "occupation"}
    //         ]
    //     });    
    // }
    
</script>
