    <footer>@BlackDemo 2019 IES Joan Ramis i Ramis</footer>
    <!--
        Script to put a class into the iinputs 
        to aplicate the css effect form 
    -->
    <script type="text/javascript">
        $(".txtb input").on("focus",function() {
            $(this).addClass("focus");
        });

        $(".txtb input").on("blur",function() {
            if($(this).val() == "")
                $(this).removeClass("focus");
        })
    </script>
    
</body>
