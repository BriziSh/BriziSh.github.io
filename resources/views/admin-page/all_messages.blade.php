<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <title>Send Email</title>
    <!-- plugins:css -->
    @include('admin-page.css_section')
  </head>
  <body>
    <!-- container-scroller starts -->
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      @include('admin-page.sidebar_section')

      <!-- page-body-wrapper starts -->
      <div class="container-fluid page-body-wrapper">

        <!-- partial:partials/_navbar.html -->
        @include('admin-page.header_section')
        
        <!-- main-panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                @include('admin-page.session_section')
        
                <div> 
                    <?php $counter=0; ?>
                    
                    @forelse($contacts as $contact)
                    <?php $counter++;?>
                    <div class="card">
                        <div class="card-body">
                        <div id="box{{$counter}}" data-contactId="{{$contact->id}}">
                            <label><strong>From:</strong></label> {{$contact->email}}<br>
                            <label><strong>Time:</strong></label> {{$contact->created_at}}<br>
                            <label><strong>Subject:</strong></label> {{$contact->subject}}<br>
                            <label><strong>Description:</strong></label> {{$contact->description}}<br>
                            <label><strong>Oder Number:</strong></label>  
                            @if($contact->numorder!=null){{$contact->numorder}}
                            @else none
                            @endif
                            <span class="reply-options"><a href="delete_message/{{$contact->id}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a></span>
                            <span class="reply-options" id="after"><a href="javascript::void(0);" onclick="reply(document.getElementById('box{{$counter}}'))">Reply</a></span>
                        </div>
                    </div>
                </div>
                <br>
                    @empty
                    <p>No messages</p>
                    @endforelse
                    
                    @if($counter)
                    <!-- Reply textbox -->
                    <div style="display:none;" class="replyClass">
                        <form action="send_message" method="POST">
                        @csrf
                        <input type="hidden" name="contact_id" id="contact_id" value="{{$contact->id}}">
                        <input type="hidden" name="greeting" value="Hi there!">
                        <input type="hidden" name="firstline" value="We have reached your issue with Famms.">
                        <input type="hidden" name="button" value="Click here to go to Famms">
                        <input type="hidden" name="url" value="http://localhost/e-commerce/public/">
                        <input type="hidden" name="lastline" value="We are always here for you!">

                        <textarea name="body" placeholder="Write Something Here" class="reply-textbox"></textarea><br>
                        <button type="submit" class="btn btn-secondary">Reply</button> 
                        <a href="javascript::void(0);" class="btn" onclick="close_reply(this)">Close</a>
                        </form>
                    </div>
                    @endif
                </div>

                <div class="d-flex align-items-center justify-content-center">
                    <div class="p-1" >
                        {{$contacts->links("vendor.pagination.bootstrap-4")}}
                    </div>
                </div>
            </div>
                    <!-- plugins:js -->
            @include('admin-page.footer_section')
            <!-- End custom js for this page -->
        </div>
               
      </div>
      <!-- page-body-wrapper ends -->

    </div>
    <!-- container-scroller ends -->

 
    <!-- plugins:js -->
    @include('admin-page.js_section')
    <!-- End custom js for this page -->
  </body>
</html>