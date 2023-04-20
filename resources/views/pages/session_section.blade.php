@if(session()->has("success"))
<div x-data="{open:true}" x-init="setTimeout(()=>open=false,6000)" x-show="open" class="alert alert-success session-message margin-center">
    {{session("success")}}
</div>
@elseif(session()->has("danger"))
<div x-data="{open:true}" x-init="setTimeout(()=>open=false,6000)" x-show="open" class="alert alert-danger session-message margin-center">
    {{session("danger")}}
</div>
@endif
