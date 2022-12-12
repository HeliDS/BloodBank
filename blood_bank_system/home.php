<?php 
require_once('connection.php'); 
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Coustard">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Blood Bank</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand text-light" id="nv-txt">Blood Bank System</a>

        
        <form class="form-inline" method="post" id="filter-fm">
            <!-- <div class="form-group"> -->
            <div class=" align-self-center">

                <select class="form-control" name="filter_b_grp" >
                    <option disabled selected>ලේ වර්ගය</option>
                    <!-- added php to keep selected value after submit the form also-->
                    <option value="A+" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'A+') {echo "selected='selected'"; } ?> >A+</option>
                    <option value="A-" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'A-') {echo "selected='selected'"; } ?> >A-</option>
                    <option value="B+" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'B+') {echo "selected='selected'"; } ?> >B+</option>
                    <option value="B-" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'B-') {echo "selected='selected'"; } ?> >B-</option>
                    <option value="O+" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'O+') {echo "selected='selected'"; } ?> >O+</option>
                    <option value="O-" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'O-') {echo "selected='selected'"; } ?> >O-</option>
                    <option value="AB+" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'AB+') {echo "selected='selected'"; } ?> >AB+</option>
                    <option value="AB-" <?php if(isset($_POST['filter_b_grp']) && $_POST['filter_b_grp'] == 'AB-') {echo "selected='selected'"; } ?> >AB-</option>
                </select>

                
            </div>
            <button type="submit" name="search-btn" class="btn btn-warning">Filter</button>
            <button type="submit" name="reset-search-btn" class="btn btn-danger mr-5">Reset</button>
            <a class="navbar-brand text-light ml-5" id="">Hi, <?php echo $_SESSION["login_user"];?>..</a>
            <button type="submit" name="logout-btn" class="btn btn-info">Logout</button>
        </form>
        
        <?php
            if (isset($_POST['reset-search-btn'])) {
                header("Refresh:0"); //refresh page to cleare selected blood type from filter
            }


            if (isset($_POST['logout-btn'])) {
                header("Location:logout.php"); //refresh page to cleare selected blood type from filter
                exit();
            }
        ?>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">දායකයාගේ විස්තර</li>
                    </ol>
                </nav>
                <form method="post" id="detail-fm">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="නම ලබා දෙන්න ">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="ලිපිනය (නගරය රහිත) ">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" placeholder="නගරය ">
                    </div>
                    <div class="form-group">
                        <label>NIC</label>
                        <input type="text" class="form-control" name="nic" placeholder="හැඳුනුම්පත් අංකය ">
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" class="form-control" name="contact" placeholder="දුරකතන අංකය ">
                    </div>
                    <div class="form-group">
                        <label>Blood Group</label>
                        <select class="form-control" name="b_grp">
                            <option disabled selected>ලේ වර්ගය</option>
                            <option>A+</option>
                            <option>A-</option>
                            <option>B+</option>
                            <option>B-</option>
                            <option>O+</option>
                            <option>O-</option>
                            <option>AB+</option>
                            <option>AB-</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-block" name="add_donor"><i class="fas fa-sign-in-alt"></i> එක් කරන්න </button>
                </form>
                <?php
                if ( isset($_POST['add_donor'])){
                    $name=$_POST['name'];
                    $address=$_POST['address'];
                    $city=$_POST['city'];
                    $nic=$_POST['nic'];
                    $contact=$_POST['contact'];
					$b_grp = isset($_POST['b_grp']) ? $_POST['b_grp'] : ''; //prevent Notice: Undefined index
                    // $b_grp=$_POST['b_grp'];

                    $sql="INSERT INTO patient(name,address,city,nic,contact,b_group) VALUES ('{$name}','{$address}','{$city}','{$nic}','{$contact}','{$b_grp}')";

                    if ($conn->query($sql)){
                        echo"
                        <div class='alert alert-success mt-3' role='alert'>
                        ඔබ විසින් සාර්ථකව දායකයා එක් කරන ලදි 
                        </div>
                        ";
                    }
                    else{
                        echo"
                        <div class='alert alert-danger mt-3' role='alert'>
                        එක් කිරීම අසාර්ථකයි 
                        </div>
                        ";
                    }

                }
                ?>

            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="card-deck justify-content-center col-md-12 pt-3">
                            <div class="card col-md-4 flex-fill text-white bg-success mb-3 text-center" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Number of Donors </h5>
                                    <h3 class="card-text">
                                        <?php 
                                            $readTable = "SELECT COUNT(id) AS patent_count FROM patient";
                                            $readData = $conn->query($readTable);
                                            $row = $readData->fetch_assoc();
                                            echo ($row["patent_count"]);
                                        ?>
                                    </h3>
                                </div>
                            </div>

                            <div class="card col-md-4 flex-fill text-white bg-warning mb-3 text-center" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Number of Universal Donors (O negative) </h5>
                                    <h3 class="card-text">
                                    <?php 
                                        $readTable = "SELECT COUNT(id) AS patent_count FROM patient WHERE b_group = 'O-'";
                                        $readData = $conn->query($readTable);
                                        $row = $readData->fetch_assoc();
                                        echo ($row["patent_count"]);
                                    ?>
                                    </h3>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="row">
                    
                        <?php 
                        $readTable = "SELECT * FROM patient";
                        $readData = $conn->query($readTable);
                        if ($readData->num_rows > 0){
                            echo"
                            <table class='table ml-3 mr-4 mt-3 table-striped table-responsive-sm table-light'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th scope='col'>නම</th>
                                        <th scope='col'>ලිපිනය</th>
                                        <th scope='col'>දුරකතන අංකය</th>
                                        <th scope='col'>ලේ වර්ගය</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ";

                            if (isset($_POST['search-btn'])) { //dispaly table result according to filter value
                                $find_b_grp=$_POST['filter_b_grp'];

                                $filterTable = "SELECT * FROM patient WHERE b_group ='" . "" . trim($find_b_grp) ."'";
                                // echo $filterTable;
                                
                                $filterData = $conn->query($filterTable);
                                if ($filterData->num_rows > 0){

                                    while($filtered_row = $filterData->fetch_assoc()){
                                
                                        echo "
                                        <tr>
                                            <th scope='row'>{$filtered_row['name']}</th>
                                            <td>{$filtered_row['address']},s{$filtered_row['city']}.</td>
                                            <td>{$filtered_row['contact']}</td>
                                            <td>{$filtered_row['b_group']}</td>
                                        </tr>
                                        ";
                                    }

                                }

                                
                            } else{ //dispaly all details in table (when filtering not selected)  
                                while($row = $readData->fetch_assoc()){

                                    echo "
                                    <tr>
                                        <th scope='row'>{$row['name']}</th>
                                        <td>{$row['address']},s{$row['city']}.</td>
                                        <td>{$row['contact']}</td>
                                        <td>{$row['b_group']}</td>
                                    </tr>
                                    ";
                                }

                            }
  
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>