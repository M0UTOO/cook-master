<!-- Modal -->
<div class="modal fade" id="userTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="chooseUserTypeTitle"><?= lang('Common.userTypeQuestion')?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-around">
                <a class="btn btn-outline-primary" href="<?= base_url('contractors/create?type=Manager')?>"><?=lang('Common.userType.manager')?></a>
                <a class="btn btn-outline-primary" href="<?= base_url('contractors/create?type=Contractor')?>"><?=lang('Common.userType.contractor')?></a>
            </div>
        </div>
    </div>
</div>
