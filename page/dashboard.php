<?php
 include '../process/session.php';
 include '../modals/logout-modal.php';
 include '../modals/new_data.php';
 include '../modals/modal-edit.php';
  include '../modals/modal-view.php';
  include '../modals/upload_productlist.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My | System</title>
     <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="../node_modules/materialize-css/dist/css/materialize.min.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<body>

  <nav>
    <div class="nav-wrapper #006064 cyan darken-3">
      <a href="dashboard.php" class="brand-logo "><?php echo$name;?></a>

      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">


<li><a href="#"class="modal-trigger" data-target="create-plan" onclick="create_plan()">Create Product</a></li>

        <li> <a href="#"id="exportBtn" onclick="export_plan('product_list')">Export</li></a>
        <li><a href="#" class="modal-trigger" data-target="modal-upload-master"  >Upload</li></a>
        

        <li><a href="#" data-target="modal-logout" class="modal-trigger">Logout</a></li>
      </ul>
    </div>
  </nav>

  
  <ul class="sidenav" id="mobile-demo">
      

<li><a href="#"class="modal-trigger" data-target="create-plan" onclick="create_plan()">Create Product</a></li>

        <li> <a href="#"id="exportBtn" onclick="export_plan('product_list')">Export</li></a>
        <li><a href="#" class="modal-trigger" data-target="modal-upload-master"  >Upload</li></a>
        

        <li><a href="#" data-target="modal-logout" class="modal-trigger">Logout</a></li>
  </ul>

<br>
<div class="row">
    <div class="col m12">
         <div class="input-field col m3 ">
                    <input type="text" name="" id="date_from" class="datepicker" placeholder="Date From" value="<?=$server_date_only;?>">
                </div>

                <div class="input-field col m3 ">
                    <input type="text" name="" id="date_to" class="datepicker" placeholder="Date To" value="<?=$server_date_only;?>">
                </div>

                <div class="input-field col m3 ">
                  <input type="text" name="" id="product_namesearch" placeholder="Search Product" size="30" > 
                </div>
                <!-- SEARCH BTN -->
                <div class="input-field col m3 ">
                    <button class="btn col s12 btn #607d8b blue-grey" onclick="load_plan_list()" id="search-plan" style="border-radius:30px;"> Search</button>
                </div>
    </div>
</div>

  <div class="container">
    <fieldset  style="border:3px solid teal;">
        <legend>
            
            <h4>
            Product Table
        </h4>
        </legend>

      <div class="collection">

    <table border="1" id="product_list" class="responsive-table centered striped"> 
        <thead>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Description</th>
            
            <th colspan="3">Control</th>
        </thead>
        <tbody id="product_data"></tbody>
    </table>
   
                   
</div>    
</fieldset>         
</div>
</body>
<script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="../node_modules/materialize-css/dist/js/materialize.min.js">
</script>
<script type="text/javascript">
      $(document).ready(function(){
        $('.modal').modal({
            inDuration: 300,
            outDuration: 200
        });
       $('.sidenav').sidenav();
       load_list();
        $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoClose: true
    });
});


//new data modal
const create_plan =()=>{
    $('#render_modal').load('../Forms/modal-new-data.php');
}
    function save() {
            var product_name = $('#product_name').val();
            var product_price = $('#product_price').val();
            var product_description = $('#product_description').val();
        

        $.ajax({
            url: '../process/processor.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'save',
                product_name: product_name,
                product_price: product_price,
                product_description: product_description
            },success:function(response){
                // console.log(response);
                if(response == 'success') {
                    swal('SUCCESS', 'Data Saved', 'success');
                    load_list();
                    $('.modal').modal('close','#create-plan');
                }else{
                    swal('FAILED', 'Data Not Saved', 'error');
                }
            }
        });
}

    // SELECT
        function load_list(){
            $.ajax({
                url: '../process/processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_list'
                },success:function(response){
                    // console.log(response);
                    document.getElementById('product_data').innerHTML = response;
                    // document.querySelector('#task_data').innerHTML = response;
                    // $('#task_data').html(response);
                }
            });
        }
//delete
    function get_id(x){
            // console.log(x);
            $.ajax({
                url: '../process/processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'delete',
                    id:x
                },success:function(response){
                    // console.log(response);
                    if(response == 'deleted'){
                        swal('deleted!','','info');
                        load_list();
                    }else{
                        swal('FAILED!','FAILED!','error');
                    }
                }
            });
        }     
         function get_id_view(param){
            // GETTING VALUES FROM SQL QUERY
            // CONCATENATION OF VALUES

            var string = param.split('~!~');
            var id = string[0];
            var product_name = string[1];
            var product_price = string[2];
            var product_description = string[3];

            // DISTRIBUTION OF VALUES TO HTML FORMS
            document.getElementById('viewID').value = id;
            document.getElementById('viewProductname').value = product_name;
            document.getElementById('viewProductprice').value = product_price;
             document.getElementById('viewProductdescription').value = product_description;
            console.log(product_name);

        }

    function get_id_edit(param){
            // GETTING VALUES FROM SQL QUERY
            // CONCATENATION OF VALUES

            var string = param.split('~!~');
            var id = string[0];
            var product_name = string[1];
            var product_price = string[2];
            var product_description = string[3];

            // DISTRIBUTION OF VALUES TO HTML FORMS
            document.getElementById('editID').value = id;
            document.getElementById('editProductname').value = product_name;
            document.getElementById('editProductprice').value = product_price;
             document.getElementById('editProductdescription').value = product_description;
            console.log(product_name);
        }
//update
        function update_value(){
            var id = document.getElementById('editID').value;
            var newProductname = document.getElementById('editProductname').value;
            var newProductprice = document.getElementById('editProductprice').value;
            var newProductdescription = document.getElementById('editProductdescription').value;
            $.ajax({
                url: '../process/processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'update_product',
                    id:id,
                    newProductname:newProductname,
                    newProductprice:newProductprice,
                    newProductdescription: newProductdescription
                },success:function(response){
                    console.log(response);
                    if(response == 'updated'){
                        // MODAL CLOSE
                        $('.modal').modal('close','#modal_edit');
                        // LOAD LIST OR REFRESH
                        load_list();
                        // SHOW ALERT
                        swal('SUCCESS!','PRODUCT UPDATED!','success');
                    }else{
                        swal('FAILED!','FAILED!','error');
                    }
                }
            });
        }
//export
function export_plan(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'Product_List'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
//search
  const load_plan_list =()=>{
        var dateFrom = document.getElementById('date_from').value;
        var dateTo = document.getElementById('date_to').value;
        // var partsCode = document.getElementById('partscode_search').value;
        // var shiftCode = document.getElementById('shift_search').value;

            var product_name = document.getElementById('product_namesearch').value;
           

            $.ajax({
                url:'../process/admin_function.php',
                type: 'POST',
                cache:false,
                data:{
                    method:'displayProductList',
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    // partsCode:partsCode,
                    // shiftCode:shiftCode
                    product_name:product_name

                },success:function(response){
                    $('#product_data').html(response);
                }
            });
    }

</script>

</html>