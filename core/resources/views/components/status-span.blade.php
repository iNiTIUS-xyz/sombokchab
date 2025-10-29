@if($status === 'draft')
    <span class="badge bg-warning">{{__('Unpublish')}}</span>
@elseif($status === 'archive')
    <span class="badge bg-warning">{{__('Archive')}}</span>
@elseif($status === 'pending')
    <span class="badge bg-warning">{{__('Pending')}}</span>
@elseif($status === 'Active')
    <span class="badge bg-primary">{{__('Active')}}</span>
@elseif($status === 'In-Active' || $status === 'Inactive')
    <span class="badge bg-danger">{{__('In Active')}}</span>
@elseif($status === 'complete' || $status === 'completed')
    <span class="badge bg-primary">{{__('Complete')}}</span>
@elseif($status === 'close')
    <span class="badge bg-danger">{{__('Close')}}</span>
@elseif($status === 'in_progress' || $status === 'processing')
    <span class="badge bg-info">{{__('In Progress')}}</span>
@elseif($status === 'publish')
    <span class="badge bg-primary">{{__('Publish')}}</span>
@elseif($status === 'approved')
    <span class="badge bg-primary">{{__('Approved')}}</span>
@elseif($status === 'confirm')
    <span class="badge bg-primary">{{__('Confirm')}}</span>
@elseif($status === 'yes')
    <span class="badge bg-primary">{{__('Yes')}}</span>
@elseif($status === 'no')
    <span class="badge bg-danger">{{__('No')}}</span>
@elseif($status === 'cancel' || $status === 'cancelled')
    <span class="badge bg-danger">{{__('Cancel')}}</span>
@elseif($status === 'failed')
    <span class="badge bg-danger">{{__('Failed')}}</span>
@elseif($status === 'refunded')
    <span class="badge bg-warning">{{__('Refunded')}}</span>
@endif