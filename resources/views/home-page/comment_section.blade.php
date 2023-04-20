<section>
 <!--Comment textbox -->
 <div class="center-align">
  
    <h3><strong>Comments</strong></h3>
    <form action='add_comment' method='POST'>
       @csrf
       <input type="hidden" name="prod_id" value="{{$product->id}}">
       <textarea placeholder='Comment Something Here' class='textarea-box' name='comment' required></textarea><br>
       <input type='submit' value='Comment'>
    </form>
 </div>

 {{-- Sometimes, you do not want a link to navigate to another page or reload a page. 
 Using javascript:, you can run code that does not change the current page.
 This, used with void(0) means, do nothing - don't reload, don't navigate, do not 
 run any code. --}}
 {{-- <h4 style="font-family:'Times New Roman', Times, serif; text-align:center;">All Comments</h4> --}}
 <div class='comment-div'>
   <?php $comments = $product->comments; ?>
    <!--All Comments -->
    @forelse ($comments as $comment)
    <?php  $userId=(auth()->user()!=null)?auth()->user()->id:0; ?>
      <div class="comment-box">
         <strong>{{$comment->user->name}}</strong><br>
         <span>{{$comment->comment}}</span><br>
         <a href="javascript::void(0);" data-commentId="{{$comment->id}}" onclick="reply(this)" class="price">Reply</a>&nbsp;
         @if($userId==$comment->user_id)
         <a href="delete_comment/{{$comment->id}}" onclick="return confirm('Are you sure you want to delete this comment?')" class="discount" >Delete</a>
         @endif
      </div>
      <!--All Replies for each comment-->
      <?php $replies=$comment->replies ?>
      @foreach ($replies as $reply)
         <div class="reply-box">
            <strong>{{$reply->user->name}}</strong><br>
            <span>{{$reply->reply}}</span><br>
            <a href="javascript::void(0);" data-commentId="{{$comment->id}}" onclick="reply(this)" class="price">Reply</a>
            @if($userId==$reply->user_id)
            <a href="delete_reply/{{$reply->id}}" onclick="return confirm('Are you sure you want to delete this comment?')" class="discount" >Delete</a>
         </div>
         @endif
      @endforeach
   @empty
   <br><br>
   <p class="center-align"><strong>No comments</strong></p>
   @endforelse

    <!-- Reply textbox -->
    <div style="display:none;" class="replyClass">
      <form action="add_reply" method="POST">
         @csrf
         <input type="hidden" name="comment_id" id="comment_id">
         <textarea name="reply" placeholder="Write Something Here"  class="textarea-box" required></textarea><br>
         <button type="submit" class="btn btn-secondary">Reply</button> 
         <a href="javascript::void(0);" class="btn" onclick="close_reply(this)">Close</a>
      </form>
   </div>
</div> 

</section>

    {{-- <!--All Comments -->
    @forelse ($comments as $comment)
   
       <div style="background-color:#f2f2f2; padding:3px; margin-bottom:3px; margin-top:20px;">
          <strong>{{$comment->user->name}}</strong><br>
          <span>{{$comment->comment}}</span><br>
          <a href="javascript::void(0);" data-commentId="{{$comment->id}}" onclick="reply(this)" >Reply</a>&nbsp;
          @if($userId==$comment->user_id)
          <a href="delete_comment/{{$comment->id}}" onclick="return confirm('Are you sure you want to delete this comment?')" style="color:#cc0000;" >Delete</a>
          @endif
       </div>
       <!--All Replies for each comment-->
       @foreach ($replies as $reply)
          @if ($comment->id==$reply->comment_id)
          <div style="margin-left:3%; margin-bottom:3px; background-color:#f2f2f2;">
             <strong>{{$reply->user->name}}</strong><br>
             <span>{{$reply->reply}}</span><br>
             <a href="javascript::void(0);" data-commentId="{{$comment->id}}" onclick="reply(this)">Reply</a>
             @if($userId==$comment->user_id)
             <a href="delete_reply/{{$reply->id}}" onclick="return confirm('Are you sure you want to delete this comment?')" style="color:#cc0000;" >Delete</a>
             @endif
          </div>
          @endif
       @endforeach
    @empty
    <p style="text-align: center;padding-top:15px;">No comments</p>
    @endforelse --}}
 
