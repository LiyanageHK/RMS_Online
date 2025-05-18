@component('mail::message')
# Low Stock Alert

**Item Name:** {{ $item->name }}  
**Current Stock:** {{ $currentStock }}  
**Alert Level:** {{ $item->alert_level }}  

@if($additionalMessage)
**Additional Notes:**  
{{ $additionalMessage }}
@endif

@component('mail::button', ['url' => route('admin.inventory.show', $item->id)])
View Item Details
@endcomponent

**Urgency:**  
<span style="color: #dc3545; font-weight: bold;">Immediate attention required</span>

Thanks,  
{{ config('app.name') }}
@endcomponent