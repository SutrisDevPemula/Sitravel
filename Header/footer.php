<!--footer-->
<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h6 class="font-italic" style="color: #d4d4d4;">
                    Copyright © Sitravel v1.0 2020 | All Right Reserved
                </h6>
            </div>
            <div class="col">

            </div>
            <div class="col">
                <h6 class="font-italic" style="color: #d4d4d4;">
                    Made with by Sutrisno
                </h6>
            </div>
        </div>
    </div>
</div>
<!--last footer-->


<!-- jquery or js with bootstrap -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>-->


<script src="asset/js/jquery-3.3.1.slim.min.js"></script>
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/sweetalert2.js"></script>
<script src="asset/js/script.js"></script>
<script>
    function swalEror() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href>Why do I have this issue?</a>'
        })
    }
</script>

<script>
    $(document).ready(function () {
        $("#Div2").hide();
        $("#Div3").hide();
        // $("#mdl1").show();
        $("#btn1").click(function () {
            $("#Div1").slideDown("slow");
            $("#Div2").hide();
            $("#Div3").hide()
        });

        $("#btn2").click(function () {
            $("#Div2").slideDown("slow");
            $("#Div1").hide();
            $("#Div3").hide()
        });

        $("#btn3").click(function () {
            $("#Div3").slideDown("slow");
            $("#Div1").hide();
            $("#Div2").hide()
        });
    });
</script>

</body>

</html>