<?php
 include '../process/conn.php';

 //search
$method = $_POST['method'];
    if($method == 'displayProductList'){
        $from = $_POST['dateFrom'];
        $to = $_POST['dateTo'];
        // $partsCode = $_POST['partsCode'];
        // $shiftCode = $_POST['shiftCode'];


            $product_name = $_POST['product_name'];
             


        // QUERY
        // $qry = "SELECT *FROM tb_order WHERE order_date >='$from 00:00:00' AND order_date <= '$to 23:59:59' AND parts_code LIKE '$partsCode%' AND shift LIKE '$shiftCode%'";

            $q = "SELECT *FROM product Where order_date >='$from 00:00:00' AND order_date <= '$to 23:59:59' AND product_name LIKE '$product_name%'";
        $stmt = $conn->prepare($q);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $c = 0;
            foreach($stmt->fetchALL() as $x){
                $c++;
                // echo '<tr style="cursor:pointer;" class="modal-trigger" data-target="plan_menu_admin" onclick="get_plan_del(&quot;'.$x['parts_code'].'~!~'.$x['order_code'].'~!~'.$x['plan_code'].'~!~'.$x['in_charge'].'~!~'.$x['plan_qty'].'~!~'.$x['parts_name'].'&quot;)">';


                // echo '<td>'.$c.'</td>';
                // echo '<td>'.$x['parts_name'].'</td>';
                // echo '<td>'.$x['parts_code'].'</td>';
                // echo '<td>'.$x['length'].'</td>';
                // echo '<td>'.$x['plan_qty'].'</td>';
                // echo '<td>'.$x['in_charge'].'</td>';
                // echo '<td>'.$x['shift'].'</td>';
                // echo '<td>'.$x['machine_number'].'</td>';
                // echo '<td>'.$x['setup_number'].'</td>';
                // echo '<td>'.$x['order_code'].'</td>';
                // echo '<td>'.$x['order_date'].'</td>';

                echo '<tr>';
                echo '<td>'.$c.'</td>';
                echo '<td>'.$x['product_name'].'</td>';
                echo '<td>'.$x['product_price'].'</td>';
                echo '<td>'.$x['product_description'].'</td>';
                echo '<td><button class="btn blue modal-trigger" data-target="modal_edit" onclick="get_id_edit(&quot;'.$x['id'].'~!~'.$x['product_name'].'~!~'.$x['product_price'].'~!~'.$x['product_description'].'&quot;)">edit</button></td>';
                echo '<td><button class="btn red" onclick="get_id('.$x['id'].')">delete</button></td>';
                echo '</tr>';
            }
        }else{
            echo '<tr>';
            echo '<td colspan="10">NO DATA</td>';
            echo '</tr>';
        }
    }

?>