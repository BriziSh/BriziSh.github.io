@if(session()->has("success"))
<div x-data="{open:true}" x-init="setTimeout(()=>open=false,5000)" x-show="open" class="alert alert-success session-home">
    {{session("success")}}
</div>
@elseif(session()->has("danger"))
<div x-data="{open:true}" x-init="setTimeout(()=>open=false,5000)" x-show="open" class="alert alert-danger session-home">
   {{session("danger")}}
</div>
@endif 

