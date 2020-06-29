<div class="card">
    <div class="card-body">
        <a data-toggle="modal" href="#tallModal" class="btn btn-primary">Wide, Tall Content</a>
        <div id="tallModal" class="modal modal-wide fade">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <form action="{{route('InstructorQuestions.store')}}" method="POST" enctype="multipart/form-data" id="question-form">
                            @csrf            
                        <div id="cover-spin"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit-form" 
                        class="btn btn-primary"
                        onclick="setTimeout(()=>{$('#cover-spin').show(0)})"
                        >Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>

@push('js')
    <script>
        $(()=>{
            
        $.ajax({
                type:'GET',
                url:"{{url('instructor/allquestions')}}",
                success:(response)=>{
                    $.each(response, function(key,value){
                        $('#question-form').append(`<div class="form-group">
                            <label for="question-${value.id}">${value.question_en}</label>
                                <select class="form-control" data-target ="${value.id}"  id="question-${value.id}" name="answer_id">
                                    <option>Choose Answer</option>
                                    ${value.answer.map(item => `<option  value="${item.id}">${item.answer_en}</option>`).join('')}
                                </select>
                            </div>`);
                    });
                    }
                });
                    
                    function onlyUnique(value, index, self) { 
                    return self.indexOf(value) === index;}

                    // Array.prototype.insert = function ( index, item ) {
                    //     this.splice( index, 1, item );};
                    
                    //     function remove(array, element) {
                    //     const index = array.indexOf(element);
                    //     array.splice(index, 1);}

                    // var items = [];
                    // var unique;

                    var arr = [];
                    var previousDataTarget = null;
                        $(document).on('change', 'select[name="answer_id"]',function (e) {
                        e.preventDefault;
                        var select =  e.currentTarget;
                        
                        $.each(select,function(k,v){
                            if(k > 0){
                                if(parseInt(select['value']) !== "" && parseInt(select[k].value) !== "")
                                {
                                    for (let index = 1; index < k; index++)
                                    {                                       
                                        if(arr.length < 2)
                                        {
                                            if(parseInt(select.attributes['data-target'].value)-1 === previousDataTarget)
                                            {
                                                arr.pop();
                                                arr.push([parseInt(select.attributes['data-target'].value),
                                                parseInt(select['value'])]);
                                            }else{
                                                arr.push([parseInt(select.attributes['data-target'].value),
                                                parseInt(select['value'])]);
                                            }

                                            previousDataTarget = parseInt(select.attributes['data-target'].value)-1;
                                            
                                        }else{
                                            $.each(arr,function(key,value){
                                                if(parseInt(select.attributes['data-target'].value)-1 === key && !isNaN(parseInt(select['value'])) )
                                                {   
                                                        arr[parseInt(select.attributes['data-target'].value)-1] = 
                                                        [parseInt(select.attributes['data-target'].value),
                                                        parseInt(select['value'])];
                                                }
                                            });
                                        }
                                        // console.log(arr);
                                    }

                                }
                            }
                        });

                    });


                    $('#submit-form').on('click',function(e){
                    for (let x = 0; x < arr.length; x++) {
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });                        
                        $.ajax({
                            type:'POST',
                            url:"{{url('/instructor')}}",
                            dataType:'json',
                            data:{
                                'question_id':parseInt(arr[x][0]),
                                'answer_id':parseInt(arr[x][1]),
                                'instructor_id':{{ auth()->guard('instructor')->id() }} 
                                },
                            success:function(response){
                            setTimeout(()=>{
                                $('#cover-spin').hide(0);
                                $('#tallModal').modal('toggle');
                                },2000)
                                // console.log('success');
                                // console.log(response);
                            },
                            error:function(error){
                                setTimeout(()=>{$('#cover-spin').hide(0)},2000)
                                // console.log('error');
                                // console.log(error);
                                // console.log(error.responseJSON.errors);
                            },
                        });
                    }
                });
        });
               
    </script>
    
@endpush