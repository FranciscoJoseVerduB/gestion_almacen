
@if(session('status'))


<div class="alert alert-primary alert-dimissible fade show" role="alert"> 

    {{session('status')}}

    <button type="button"
        class="close"  
        data-dismiss="modal"
        aria-label="Close"
        >
        <span aria-hidden="true">
            &times;
        </span>
    </button> 
</div>

 

@endif 