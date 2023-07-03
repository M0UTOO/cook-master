<!-- Modal -->
<div class="modal fade" id="eventOptionsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="chooseOptionsTitle">What do you want to do ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-around">
                <a class="btn blue-btn mb-3" href="<?= base_url('event/create')?>">Create an event</a>
                <a class="btn blue-btn mb-3" href="<?= base_url('eventGroup/add')?>">Add an event to a formation</a>
                <a class="btn blue-btn mb-3" href="<?= base_url('eventContractor/add')?>">Assign a contractor to an event</a>
                <a class="btn blue-btn mb-3" href="<?= base_url('eventSpace/add')?>">Select a cooking space for the event</a>
            </div>
        </div>
    </div>
</div>

