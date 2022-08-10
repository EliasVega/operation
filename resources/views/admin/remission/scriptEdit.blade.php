<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#user_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('#operation_id').select2({
                theme: "classic",
                width: "100%",
            });
        });
    });

    $(document).ready(function(){
        $("#add").click(function(){
            add();
        });
    });

    var cont=0;
    total=0;
    subtotal=[];
    $("#save").hide();

    $("#operation_id").change(operationValue);

    function operationValue(){
        dataOperation = document.getElementById('operation_id').value.split('_');
        $("#price").val(dataOperation[1]);
        dataOperation = document.getElementById('operation_id').value.split('_');
        $("#quantity").val(dataOperation[2]);
    }

    function add(){

        dataOperation = document.getElementById('operation_id').value.split('_');
        operation_id= dataOperation[0];
        operation= $("#operation_id option:selected").text();
        quantity= $("#quantity").val();
        price= $("#price").val();



        if(operation_id !="" && quantity!="" && quantity>0  && price!=""){

            subtotal[cont]= parseFloat(quantity) * parseFloat(price);
            total= total+subtotal[cont];

            var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="idP[]" value="'+operation_id+'">'+operation_id+'</td>  <td><input type="hidden" name="operation_id[]" value="'+operation_id+'">'+operation+'</td> <td><input type="hidden" id="quantity" name="quantity[]" value="'+quantity+'">'+quantity+'</td> <td><input type="hidden" id="price" name="price[]" value="'+parseFloat(price).toFixed(2)+'">'+price+'</td> <td> $'+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
            cont++;

            totals();
            /*
            $("#total").html("$ " + total.toFixed(2));
            $("#total_venta").val(total.toFixed(2));*/
            assess();
            $('#details').append(fila);
            $('#operation_id option:selected').remove();
            clean();


        }else{
            //alert("Rellene todos los campos del detalle de la venta");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'Rellene todos los campos del detalle de la venta',
            })
        }
    }


    function clean(){
        $("#operation_id").val("");
        $("#quantity").val("");
        $("#pricerice").val("");

    }

    function totals(){

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));
    }


    function assess(){

        if(total>0){

        $("#save").show();

        } else{
            $("#save").hide();
        }
    }

    function eliminar(index){

        total = total-subtotal[index];

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#fila" + index).remove();
        assess();
    }
</script>
