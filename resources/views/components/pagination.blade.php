<div>
    <nav>
        <div class="d-flex align-items-center justify-content-between mt-2">
            <div>
                Page <strong>{{ $model->currentPage() }}</strong> of <strong>{{ $model->lastPage() }}</strong>
            </div>
            {{ $model->links() }}
        </div>
    </nav>
</div>