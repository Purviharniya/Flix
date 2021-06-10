<?php
include "includes/header.php"
?>

<div class="container textboxContainer py-5">
    <input type="text" class="form-control searchbar" placeholder='Search for something...'>
</div>
<div class="results"></div>



<script>
$(function() {

    var username = '<?php echo $username ?>';
    var timer;

    $('.searchbar').on("keyup", function() {
        clearTimeout(timer);

        timer = setTimeout(function() {
            var val = $(".searchbar").val();
            // console.log(val);
            if (val != "") {
                $.post("ajax/getSearchResults.php", {
                    term: val,
                    username: username
                }, function(data) {
                    $(".results").html(data);
                })
            } else {
                $(".results").html("No results found");
            }
        }, 500);
    });

});
</script>