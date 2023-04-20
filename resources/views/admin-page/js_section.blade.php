    <script src="admin-files/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="admin-files/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin-files/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin-files/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin-files/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin-files/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="admin-files/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin-files/assets/js/off-canvas.js"></script>
    <script src="admin-files/assets/js/hoverable-collapse.js"></script>
    <script src="admin-files/assets/js/misc.js"></script>
    <script src="admin-files/assets/js/settings.js"></script>
    <script src="admin-files/assets/js/todolist.js"></script>
    <script src="admin-files/assets/js/chart.js"></script>

    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin-files/assets/js/dashboard.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- sidebar_section --}}
    <script>
        function changePhoto(){
          var popupWindow = window.open('view_upload_photo','Profile Photo','options');
        }
    </script>

    {{-- view_upload_photo --}}
    <script>
        function display(){
            var profile_image = document.getElementById("profile_image");
            var fReader = new FileReader();
            fReader.readAsDataURL(profile_image.files[0]);
            fReader.onloadend = function(event){
                var img = document.getElementById("image");
                img.src = event.target.result; 
            }
        }
        window.onunload = refreshParent;
        function refreshParent() {
            window.opener.location.reload();
        }
    </script>

{{-- all_messages --}}
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    function reply(caller){
       var contactId = $(caller).attr('data-contactId');
       var replyBox = document.getElementById('contact_id');
       replyBox.value=contactId;
       $('.replyClass').insertAfter($(caller));
       $('.replyClass').show();
    }

    function close_reply(caller){
       $('.replyClass').hide();
    }
 </script>