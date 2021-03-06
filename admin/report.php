<?php
    include('../includes/auth_session.php');
    include('../includes/header.php');
        
    include('../includes/sidebar.php');
    include('connection.php');
    //pass this value to sidebar.php .nav-item to active the class and highlight
    $page = 'report';


    $query = "SELECT * FROM patient_table ORDER BY id asc";  
    $result = mysqli_query($connection, $query); 
?>


    <main>
        <div class="container">
            <h2 class="mt-1">Patient Reports</h2>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <span>Date From</span>
                    <input type="date" name="from-date" id="from-date">
                </div>
                <div class="col-lg-3 col-md-4">
                    <span>Date To</span>
                    <input type="date" name="to-date" id="to-date">
                </div>
                <div class="col-lg-3 col-md-4">
                    <button style="margin-top: 28px;" id="search" name="search" class="btn button px-5">Search</button>
                </div>
            </div>
            <br>
        </div>


        <!-- Table starts -->
        <div class="container-fluid">
            <table class="table table-hover" id="table">
                <thead class="table-head">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <?php  
                    while($row = mysqli_fetch_array($result)){  
                ?>  
                    <tbody class="tbody">
                        <tr>  
                            <td><?php echo $row["id"]; ?></td>  
                            <td><?php echo $row["nickname"]; ?></td>  
                            <td><?php echo $row["created_at"]; ?></td>  
                        </tr>  
                    </tbody>

                <?php  
                    }  
                ?>
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

        $('.table').DataTable({
            "searching": false
        });
        
        $('#search').click(function(){
            $('.table').DataTable();
            var fromDate = $('#from-date').val();
            var toDate = $('#to-date').val();
            if(fromDate != '' && toDate !=''){
                $.ajax ({
                    url:"report_server.php",
                    method:"POST",
                    data:{
                        fromDate:fromDate, toDate:toDate
                    },
                    success:function(data){
                        $(".table").html(data);
                    }
                });
            }else{
                alert("Both Date is Required");
            }
        }); 
    });

    

</script>