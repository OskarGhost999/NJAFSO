<?php
include_once('navbar.php');
$search = "";
$sort = " lastname DESC";
if(isset($_POST["search"])){
    $search = $_POST["search"];
    $sort = $_POST["sort"];
}
  ?>

<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: regular;
    margin-right: 10px;
    font-size: 40px;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
    } 

    h4 {
        padding-left: 10px;
    }

    body {
        background-color: black;
    }
  </style>

	<header>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	</head>
	<style>
		table{
			//border: #004060 3px solid;
		}
		th, td{
			padding: 8px;
			border-width: 2px;
		}
        th {
            padding: 12px;
            background-color: rgb(140, 226, 255);
            border-bottom: #004060 2px solid;
            //border-right: #004060 1px solid; 
        }

        td {
            //border-right: #004060 1px solid;  //not feeling it
        }
        
        tr:nth-child(odd) {
            background-color: rgb(218, 237, 255);
        }

        tr:hover {
            background-color: rgb(140, 226, 255);
            font-weight: 600;
        }

        tr:last-of-type {
            border-bottom: 2px solid #004060;
        }

	</style>

</body>
</html>
<nav class="navbar navbar-expand-sm navbar-light bg-light justify-content-between" style="background-color: #36096d; background-image: linear-gradient(315deg, rgb(0,75,114), rgb(0,118,181), rgb(0,75,114));">
    <a class="navbar-brand text-white"></a>
    <form class="form-inline" method="POST">
        <input class="form-control form-control-sm mr-sm-2" name="search" type="search"
               placeholder="search records" aria-label="Search" value="<?php echo $search;?>">
        <select class="form-control form-control-sm mr-sm-2" name="sort">
            <option value="lastname ASC">Alphabetical A-Z</option>
            <option value="lastname DESC">Alphabetical Z-A</option>
            <option value="programstartdate DESC">Newest</option>
            <option value="programstartdate ASC">Oldest</option>
        </select>
        <input type="submit" class="btn btn-sm btn-outline-light btn-dark my-2 my-sm-0" value="Search"/>
    </form>
</nav>
<split>
<br><bh>Family Records</bh>
<br><br>

<?php
$intake_records = array();
if (isset($search)) {
    $result = DBL::get_all_family_intake_records($search, $sort);
    $_intake_records = Common::get($result, "data", false);
    if($_intake_records){
        $intake_records = $_intake_records;
    } else {
        echo "<h4> No records found. Try searching again.</h4>";
        exit();
    }
}

$intake_records_table = Common::build_table($intake_records);
echo $intake_records_table;

?>

