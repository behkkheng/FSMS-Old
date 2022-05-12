<!--Delete Modal-->
                <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Warning!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span>Are you sure you want to delete <?php 
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "fsms";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                // Check connection
                                if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT name FROM employee WHERE employeeID = $id";
                                $result = $conn->query($sql);
                                
                                ?>?</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" id="ok-btn" class="btn btn-danger" onclick="" data-dismiss="modal">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>


                <button type="button" class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#DeleteModal" value="<?php echo $row['employeeID'] ?>"><i class="fas fa-trash"></i> Delete</button>



                <?php
                $connection = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($connection, 'phpcrud');

                $query = "SELECT * FROM student";
                $query_run = mysqli_query($connection, $query);
            ?>
                    <table id="datatableid" class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th scope="col"> ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name </th>
                                <th scope="col"> Course </th>
                                <th scope="col"> Contact </th>
                                <th scope="col"> VIEW </th>
                                <th scope="col"> EDIT </th>
                                <th scope="col"> DELETE </th>
                            </tr>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['fname']; ?> </td>
                                <td> <?php echo $row['lname']; ?> </td>
                                <td> <?php echo $row['course']; ?> </td>
                                <td> <?php echo $row['contact']; ?> </td>
                                <td>
                                    <button type="button" class="btn btn-info viewbtn"> VIEW </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td>
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>


<div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Username
                                            </th>
                                            <th>
                                                Role
                                            </th>
                                            <th class="no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <!--Show all data-->
                                    <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "fsms";

                                        // Create connection
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        // Check connection
                                        if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT name,username,role FROM employee";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr><td>".$row["name"]."</td><td>".$row["username"]."</td><td>".$row["role"]."</td>";
                                            echo '<td class="text-right">';
                                            ?>

                                            <!--View Button-->
                                            <form action="User-Detail.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['employeeID'] ?>">
                                                <a type="submit" class="btn btn-primary btn-sm m-1" value="<?php echo $row['employeeID'] ?>" id="view-btn"><i class="fas fa-folder"></i> View</a>
                                            </form>
                                            
                                            <!--Edit Button-->
                                            <form action="User-Edit.html" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['employeeID'] ?>">
                                                <a type="submit" class="btn btn-info btn-sm m-1" value="<?php echo $row['employeeID'] ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            </form>
                                            
                                            <!--Delete Button-->
                                            <button type="button" class="btn btn-danger deletebtn btn-sm m-1"><i class="fas fa-trash"></i> Delete</button>
                                        
                                        </td></tr>
                                        <?php
                                        }
                                        echo "</table>";
                                        } else {
                                        echo "0 results";
                                        }
                                        $conn->close();
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>