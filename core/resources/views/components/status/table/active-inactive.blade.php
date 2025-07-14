<style>
    .alert-success {
        border-color: #f2f2f2;
        border-left: 5px solid #319a31;
        background-color: #f2f2f2;
        color: #333;
        border-radius: 0;
        padding: 5px;
    }
    .alert-danger {
        border-color: #f2f2f2;
        border-left: 5px solid #c69500;
        background-color: #f2f2f2;
        color: #333;
        border-radius: 0;
        padding: 5px;
    }
</style>

@if($status === 0)
    <span class="badge bg-danger" >{{__('Inactive')}}</span>
@elseif($status === 1)
    <span class="badge bg-primary" >{{__('Active')}}</span>
@elseif($status === 'complete')
    <span class="badge bg-primary" >{{__('Complete')}}</span>
@elseif($status === 'close')
    <span class="badge bg-danger" >{{__('Close')}}</span>
@elseif($status === 'draft')
    <span class="badge bg-danger" >{{__('Draft')}}</span>
@elseif($status === 'in_progress')
    <span class="badge bg-info" >{{__('In Progress')}}</span>
@elseif($status === 'archive')
    <span class="badge bg-info" >{{__('Archive')}}</span>
@elseif($status === 'schedule')
    <span class="badge bg-warning" >{{__('Schedule')}}</span>
@elseif($status === 'publish')
    <span class="badge bg-primary" >{{__('Published')}}</span>
@elseif($status === 'confirm')
    <span class="badge bg-primary" >{{__('Confirm')}}</span>
@elseif($status === 'yes')
    <span class="badge bg-primary" >{{__('Yes')}}</span>
@elseif($status === 'no')
    <span class="badge bg-danger" >{{__('No')}}</span>
@elseif($status === 'cancel')
    <span class="badge bg-danger" >{{__('Cancel')}}</span>
@endif
