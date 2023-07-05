<?php

echo $this->include('layouts/head') ;

echo '<body>';
echo $this->include('layouts/header') ;

echo "<h2>" . $title ."</h2>";

echo $this->include('cookingSpace/form') ;

echo '</main>';
echo $this->include('layouts/footer')
?>

</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
