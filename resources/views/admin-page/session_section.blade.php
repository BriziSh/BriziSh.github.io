@if(session()->has("success"))
<div x-data="{open:true}" x-init="setTimeout(()=>open=false,3000)" x-show="open" class="alert alert-success">
    {{session("success")}}
</div>
@elseif(session()->has("danger"))
<div x-data="{open:true}" x-init="setTimeout(()=>open=false,3000)" x-show="open" class="alert alert-danger">
    {{session("danger")}}
</div>
@endif
