<div class="modal fade" id="{{ $id }}">
    <div class="modal-dialog {{ $size ?? 'modal-lg' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $body }}
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <div>{{ $button ?? '' }}</div>
            </div>
        </div>
    </div>
</div>
