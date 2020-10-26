<?php include __DIR__ . '/../header.php'; ?>

    <script type="text/javascript">
        $(document).ready(request());

        function request() {
            var thisUser = '<?= $user?$user->getId():'null' ?>';
            $.ajax({
                method: "GET",
                url: "api/getComments.php",
                data: {controllerName: "Comment", methodName: "findAll", User: thisUser},
                success: function (html) {
                        $("#divText").html(html);
                }
                });
            };
    </script>
    <div style="width: 100%; background-color: azure; padding:0 20px" id="divText">

    </div>
    <!--    <hr>-->
<?php include __DIR__ . '/../footer.php'; ?>