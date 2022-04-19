<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Calendar</h3>
            </div>
            <div class="block-content block-content-full">
                <x-calendar :data=$appointments />
            </div>
        </div>
    </div>
</x-layout.backend>