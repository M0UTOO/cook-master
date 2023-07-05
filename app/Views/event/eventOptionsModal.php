<!-- Modal -->
<div class="modal fade" id="eventOptionsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="chooseOptionsTitle"><?=lang('Common.eventsActions')?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-around">
                <a class="btn blue-btn mb-3" href="<?= base_url('event/create')?>"><?=lang('Common.create_events')?></a>
                <a class="btn blue-btn mb-3" href="<?= base_url('eventGroup/add')?>"> <?=lang('Common.addToFormation')?></a>
                <a class="btn blue-btn mb-3" href="<?= base_url('eventContractor/add')?>"> <?=lang('Common.assignContractorsEvents')?></a>
                <a class="btn blue-btn mb-3" href="<?= base_url('eventSpace/add')?>"> <?=lang('Common.assignCookingSpacesEvents')?></a>
            </div>
        </div>
    </div>
</div>

