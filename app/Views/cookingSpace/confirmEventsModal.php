<!-- Modal -->
<div class="modal fade" id="confirmEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<?php
if(isLoggedIn() && isClient()){
?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmEventsTitle">Confirm reservation information:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-around">
                <form action="<?=base_url('client/book')?>" method="post" class="d-flex flex-column">
                    <input hidden="hidden" name="idCookingSpace" value="<?=$cookingSpace['idCookingSpace']?>" />
                    <input hidden="hidden" name="pricePerHour" value="<?=$cookingSpace['pricePerHour']?>">

                    <label for="date">Date:</label>
                    <input type="date" name="date" id="book-date" value="" min="<?=date('Y-m-d')?>" max="<?=date('Y-m-d', strtotime('+1 month'))?>" required/>

                    <label for="starttime">Start time:</label>
                    <select name="starttime" id="book-start-time">
                        <?php
                        for ($i = 8; $i < 21; $i++) {
                            echo "<option value='$i:00:00'>$i:00</option>";
                        }
                        ?>
                    </select>

                    <label for="endtime">End time:</label>
                    <select name="endtime" id="book-end-time">
                        <?php
                        for ($i = 9; $i < 21; $i++) {
                            echo "<option value='$i:00:00'>$i:00</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="mt-4 btn blue-btn">Book the room</button>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
