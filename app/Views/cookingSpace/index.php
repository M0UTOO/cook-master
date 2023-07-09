<?php

echo $this->include('layouts/head') ;


echo '<body>';
echo $this->include('layouts/header') ;
helper('form');

echo "<h1 class='mb-3'>" . lang('Common.title-cookingSpace') . "<img alt='logo' class='ms-3' src=" . base_url("assets/images/svg/moon-icon.svg") . " /></h1>";


if (isManager()){
//go to dashboard link
}

echo "<nav class='navbar navbar-light'>";
echo "<div class='container-fluid mb-4'>";
$action = base_url('cookingSpace');
echo "<form class='d-flex' action=" . $action . " method='post'>";
echo "<input class='form-control me-2 form-cookmaster' type='search' placeholder=" . lang('Common.search') . " aria-label='Search' name='search'>";
echo form_submit('', lang('Common.search'), 'class="btn blue-btn form-control"');
echo "</form>";
echo "</div>";
echo "</nav>";

echo "<div class='row grid-events' id='event-container'>"; //MAKE IT A GRID

if (isset($cookingSpaces) && is_array($cookingSpaces) && count($cookingSpaces) > 0){
    $ads = 0;
    foreach ($cookingSpaces as $cookingSpace){
        $ads++;

        $subscription = getSubscription();
        #DISPLAY ADS
        if (!isContractor() && !isManager()){
            if ((isset($subscription) && $subscription['price'] == 0) || !isLoggedIn()) {
                if (($ads % 10) == 0) {
                    $ad = rand(3, 4);
                    echo "<div class='ads-card col mb-3'>";
                    echo "<div class='ads-container'>";
                    echo "<a href=" . base_url("checkout?subscription=3") ."><img src=" . base_url("assets/images/ads/" . $ad . ".png") . " alt='Sample Ad' /></a>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }

        echo "<div class='event-card col-3 mb-5'>";
        if (!isLoggedIn()){
            $redirection = base_url("signIn");
        } else {
            $redirection = base_url("cookingSpace/" . $cookingSpace->idCookingSpace);
        }

        echo "<a href=".$redirection.">";
        echo "<div class='card mb-3'>";
        echo "<img alt='cooking space picture' class='card-img-top' height='250vh' src=" . base_url("assets/images/cookingSpaces/" . $cookingSpace->picture) . " />";
        echo "<div class='card-body'>";
            echo "<h2>" . $cookingSpace->name . "</h2>";
            echo "<p class='card-text'>" . lang('Common.price') . " : $cookingSpace->pricePerHour " . lang('Common.money') ."</p>";
            echo "<p class='card-text'>$cookingSpace->size<img class='ms-2 icons' src='assets/images/svg/user-checked-green.svg'></p>";

        // TO DO : ADD REAL ADS
        echo "</div>";
        echo "<div class='event-card-body-right'>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
    }


} else {
    echo "<p>".lang('Common.notFound.cookingSpaces')."</p>";
}
echo "</div>";

if (!isset($search)) {
    echo "<nav aria-label='Page navigation example'>";
    echo "<ul class='pagination'>";
    echo "<li class='page-item'>";
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $before = $page == 1 ? 1 : $page-1;
    $after = $page == $totalPages ? $totalPages : $page+1;
    echo "<a class='page-link' href='" . base_url("cookingSpace?page=" . $before . "") . "' aria-label='Previous'>";
    echo "<span aria-hidden='true'>&laquo;</span>";
    echo "</a>";
    echo "</li>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<li class='page-item'><a class='page-link pagination-link' href='" . base_url("cookingSpace?page=" . $i . "") . "' data-page='" . $i . "'>" . $i . "</a></li>";
    }
    echo "<a class='page-link' href='" . base_url("cookingSpace?page=" . $after . "") . "' aria-label='Next'>";
    echo "<span aria-hidden='true'>&raquo;</span>";
    echo "</a>";
    echo "</li>";
    echo "</ul>";
    echo "</nav>";
}

echo "</div>";

echo '</main>';

echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
<script>
    function displayEvents(page) {

        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: { page: page },
            success: function (response) {
                $('#event-container').html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    // Handle pagination link clicks
    $('.pagination-link').on('click', function (event) {
        event.preventDefault();
        const page = $(this).data('page'); // Get the page number from the data attribute
        displayEvents(page);
    });

    // Initially display the cookingSpace for the first page
    displayEvents(1);
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5567240416427109"
        crossorigin="anonymous"></script>
</html>
