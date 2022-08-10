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
            $('#bank_origin_id').select2({
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

    $("#user_id").change(userValue);

    function userValue(){
        dataUser = document.getElementById('user_id').value.split('_');
        $("#reference").val(dataUser[1]);

    }

    function add(){
        dataUser = document.getElementById('user_id').value.split('_');
        user_id = dataUser[0];
        user = $("#user_id option:selected").text();
        payment_method_id = $("#payment_method_id").val();
        payment_method = $("#payment_method_id option:selected").text();
        bank_origin_id = $("#bank_origin_id").val();
        bank_origin = $("#bank_origin_id option:selected").text();
        bank_id = $("#bank_id").val();
        bank = $("#bank_id option:selected").text();
        reference = $("#reference").val();



        if(user_id != "" && payment_method_id != "" && bank_origin_id != "" && bank_id != "" && reference != ""){

            var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="user_id[]" value="'+user_id+'">'+user+'</td>  <td><input type="hidden" name="payment_method_id[]" value="'+payment_method_id+'">'+payment_method+'</td> <td><input type="hidden" name="bank_origin_id[]" value="'+bank_origin_id+'">'+bank_origin+'</td> <td><input type="hidden" name="bank_id[]" value="'+bank_id+'">'+bank+'</td> <td><input type="hidden" name="reference[]" value="'+reference+'">'+reference+'</td> </tr>';
            cont++;
            /*
            $("#total").html("$ " + total.toFixed(2));
            $("#total_venta").val(total.toFixed(2));*/
            $('#details').append(fila);
            $('#user_id option:selected').remove();
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
        $("#user_id").val("");
        /*
        $("#payment_method_id").val("");
        $("#bank_origin_id").val("");
        $("#bank_id").val("");*/
        $("#reference").val("");
    }
    function eliminar(index){
        $("#fila" + index).remove();
    }
</script>
